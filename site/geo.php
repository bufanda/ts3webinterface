<?php
if(!defined("SECURECHECK")) {die("Access denied");}

// Create cache directory if it doesn't exist
$cache_file = TS3WI_DIR . DS . 'cache' . DS . 'geoip.json';
$cache_dir = dirname($cache_file);
if (!file_exists($cache_dir)) {
    @mkdir($cache_dir, 0777, true);
}

// Load existing cache
$geo_cache = [];
if (file_exists($cache_file)) {
    $geo_cache = json_decode(file_get_contents($cache_file), true) ?: [];
}

$clients_to_map = [];
$ips_to_fetch = [];

if ($hoststatus === true) {
    // Admin sees all servers
    $serverlist = $ts3->getElement('data', $ts3->serverList());
    if (!empty($serverlist)) {
        foreach ($serverlist as $svr) {
            if ($svr['virtualserver_status'] == "online") {
                $ts3->selectServer($svr['virtualserver_port'], 'port', true);
                $clientlist = $ts3->getElement('data', $ts3->clientList("-ip"));
                if (!empty($clientlist)) {
                    foreach ($clientlist as $client) {
                        if (isset($client['client_type']) && $client['client_type'] == 0 && !empty($client['connection_client_ip'])) {
                            $clients_to_map[] = [
                                'ip' => $client['connection_client_ip'],
                                'label' => $client['client_nickname'] . ':' . $svr['virtualserver_port']
                            ];
                        }
                    }
                }
            }
        }
        // Deselect server just in case
        $ts3->selectServer(0, 'serverId', true);
    }
} else {
    // Normal user, sees only current server ($sid must be set and selected)
    if (isset($sid) && $sid) {
        $clientlist = $ts3->getElement('data', $ts3->clientList("-ip"));
        if (!empty($clientlist)) {
            foreach ($clientlist as $client) {
                if (isset($client['client_type']) && $client['client_type'] == 0 && !empty($client['connection_client_ip'])) {
                    $clients_to_map[] = [
                        'ip' => $client['connection_client_ip'],
                        'label' => $client['client_nickname']
                    ];
                }
            }
        }
    }
}

// Process IPs and check cache
$mapped_data = [];
$ips_to_query = [];
$ip_hash_map = [];

foreach ($clients_to_map as $client) {
    $ip = $client['ip'];
    // Skip localhost and private LAN IPs as they cannot be geolocated by public APIs
    if ($ip == '127.0.0.1' || $ip == '::1' || preg_match('/^192\.168\.|^10\.|^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ip)) {
        continue;
    }
    
    // DSGVO / Privacy: We only store a hash of the IP in the cache
    $ip_hash = hash('sha256', $ip);
    
    if (isset($geo_cache[$ip_hash])) {
        // Cache hit
        if ($geo_cache[$ip_hash] !== false) {
            $mapped_data[] = [
                'lat' => $geo_cache[$ip_hash]['lat'],
                'lon' => $geo_cache[$ip_hash]['lon'],
                'label' => $client['label']
            ];
        }
    } else {
        // Need to fetch
        $ips_to_query[$ip] = $ip_hash;
        // Keep a reference to assign it later
        $ip_hash_map[$ip][] = $client['label'];
    }
}

// Fetch missing IPs via IP-API.com batch endpoint
if (!empty($ips_to_query)) {
    // ip-api.com batch allows up to 100 IPs per request
    $chunks = array_chunk(array_keys($ips_to_query), 100);
    $cache_updated = false;
    
    foreach ($chunks as $chunk) {
        $ch = curl_init('http://ip-api.com/batch');
        $postData = json_encode($chunk);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); // 3 seconds timeout
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        if ($response) {
            $results = json_decode($response, true);
            if ($results && is_array($results)) {
                foreach ($results as $res) {
                    if (isset($res['query']) && $res['status'] === 'success') {
                        $ip = $res['query'];
                        $hash = $ips_to_query[$ip];
                        $geo_cache[$hash] = [
                            'lat' => $res['lat'],
                            'lon' => $res['lon']
                        ];
                        
                        // Add to mapped data
                        if (isset($ip_hash_map[$ip])) {
                            foreach ($ip_hash_map[$ip] as $label) {
                                $mapped_data[] = [
                                    'lat' => $res['lat'],
                                    'lon' => $res['lon'],
                                    'label' => $label
                                ];
                            }
                        }
                        $cache_updated = true;
                    } elseif (isset($res['query']) && $res['status'] === 'fail') {
                        // Mark as failed in cache to avoid re-querying
                        $ip = $res['query'];
                        $hash = $ips_to_query[$ip];
                        $geo_cache[$hash] = false;
                        $cache_updated = true;
                    }
                }
            }
        }
    }
    
    // Save updated cache
    if ($cache_updated) {
        @file_put_contents($cache_file, json_encode($geo_cache));
    }
}

// Pass JSON encoded data to Smarty
$smarty->assign("geo_clients_json", json_encode($mapped_data));
?>
