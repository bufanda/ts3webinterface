<?php
if(!defined("SECURECHECK")) {die("Access denied");}

if($hoststatus === true) {
    $cache_dir = TS3WI_DIR . DS . 'templates_c';
    $files = glob($cache_dir . DS . '*');
    $success = true;
    
    if($files !== false) {
        foreach($files as $file) {
            if(is_file($file)) {
                if(!@unlink($file)) {
                    $success = false;
                }
            }
        }
    }
    
    // Redirect back to the page the user came from
    if(!empty($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: index.php?site=server");
    }
    exit();
} else {
    die("Access denied - Admin only");
}
?>
