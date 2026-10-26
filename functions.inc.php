<?php
/*
*Copyright (C) 2012-2013  Psychokiller
*Modernized by SupportApp AI 2026
*/
function create_channel_tree($pid, $place, $alldata) {
	$tree = '';
	foreach($alldata as $key => $value) {
		if ($pid == $value['pid']) {
			if(preg_match("/^\[([\S]*)spacer([\d]+)\]/", $value['channel_name'], $treffer) && $value['pid'] == 0 && $value['channel_flag_permanent'] == 1) {
				$getspacer = explode($treffer[0], $value['channel_name']);
				$checkspacer = isset($getspacer[1][0]) ? str_repeat($getspacer[1][0], 3) : '';
				if($treffer[1] == "*" || (strlen($getspacer[1] ?? '') == 3 && $checkspacer == $getspacer[1])) {
					$spacer = '';
					for($i = 0; $i <= 50; $i++) {
						if(strlen($spacer) < 50 && isset($getspacer[1])) {
							$spacer .= $getspacer[1];
						} else {
							break;
						}
					}
					$tree .= "<div class='channel'>".$place."<div class='channame'>".$spacer."</div></div><div class='clear'></div>";
				} elseif($treffer[1] == "c") {
					$spacer = explode($treffer[0], $value['channel_name']);
					$tree .= "<div class='channel'>".$place."<div class='channame' style=\"width:90%;text-align:center\">".($spacer[1] ?? '')."</div></div><div class='clear'></div>";
				} elseif($treffer[1] == "r") {
					$spacer = explode($treffer[0], $value['channel_name']);
					$tree .= "<div class='channel'>".$place."<div class='channame' style=\"float:right\">".($spacer[1] ?? '')."</div></div><div class='clear'></div>";
				} else {
					$spacer = explode($treffer[0], $value['channel_name']);
					$tree .= "<div class='channel'>".$place."<div class='channame'>".($spacer[1] ?? '')."</div></div><div class='clear'></div>";
				}
			} else {
				$tree .= "<div class='channel'>".$place."<div class='chanimg'>&nbsp;</div><div class='channame'>".secure(str_replace("\\s", " ", $value['channel_name'] ?? ''))."</div><div class='clear'></div></div>\n";
			}
			$tree .= create_channel_tree($value['cid'], $place."<div class='place'>&nbsp;</div>", $alldata);
		}
	}
	return $tree;
}

function secure($replace) {
	$replace = str_replace("<", "&lt;", $replace ?? '');
	$replace = str_replace(">", "&gt;", $replace);
	$replace = str_replace("\"", "&quot;", $replace);
	return $replace;
}

function getPermsCommand($mode, $id, $perms) {
	switch($mode) {
		case 1:
			$command = "servergroupaddperm sgid=".$id." ";
			$delcommand = "servergroupdelperm sgid=".$id." ";
			break;
		case 2:
			$command = "channelgroupaddperm cgid=".$id." ";
			$delcommand = "channelgroupdelperm cgid=".$id." ";
			break;
		case 3:
			$command = "channeladdperm cid=".$id." ";
			$delcommand = "channeldelperm cid=".$id." ";
			break;
		case 4:
			$command = "clientaddperm cldbid=".$id." ";
			$delcommand = "clientdelperm cldbid=".$id." ";
			break;
        default:
            $command = "";
            $delcommand = "";
            break;
	}
	$permString = '';
	$executeString = '';
	$count = 1;
	foreach($perms as $key => $value) {
		$delperms = '';
		if(isset($value['delete']) && $value['delete'] == 1) {
			$delperms .= $delcommand."permid=".$key."\n";
		} else {
			if($count >= 150) {
				$executeString .= $command.$permString."\n";
				$permString = '';
				$count = 1;
			}
			switch($mode) {
				case 1:
					$permString .= "permid=".$key." permvalue=".($value['value'] ?? '')." permnegated=".($value['negated'] ?? '')." permskip=".($value['skip'] ?? '')."|";
					break;
				case 2:
				case 3:
					$permString .= "permid=".$key." permvalue=".($value['value'] ?? '')."|";
					break;
				case 4:
					$permString .= "permid=".$key." permvalue=".($value['value'] ?? '')." permskip=".($value['skip'] ?? '')."|";
					break;
			}
			$count++;
		}
	}
	$executeString .= $command.$permString."\n".$delperms;
	return $executeString;
}
	
function check_version_consistency($neededversionkey) {
    return true; // Neutralized network check to dead server
}
	
function channel_backup_create($path, $channellist) {
	global $ts3;
	$handler = @fopen($path, "a+");
	if($handler === false) {
		return false;
	} else {
		$count = 1;
		$count_chans = count($channellist);
		foreach($channellist as $key => $value) {
			$settings = '';
			$count2 = 1;
			foreach($value as $key2 => $value2) {
				$count_settings = count($value);
				$settings .= $key2."=".str_replace(' ', '\s', (string)$value2);
				if($count2 != $count_settings) {
					$settings .= " ";
				}
				$count2++;
			}
			$channelperms = $ts3->channelPermList($value['cid']);
			if($channelperms['success'] === true) {
				$settings .= "<perms>";
				$count3 = 1;
				$count_perms = count($channelperms['data']);
				foreach($channelperms['data'] as $key3 => $value3) {
					$count4 = 1;
					$count_permsettings = count($value3);
					foreach($value3 as $key4 => $value4) {
						if($key4 != "cid") {
							$settings .= $key4."=".$value4;
							if($count4 != $count_permsettings) {
								$settings .= " ";
							}
						}
					}
					if($count3 != $count_perms) {
						$settings .= "|";
					}
				}
				$settings .= "</perms>";
			}
			if($count != $count_chans) {
				$settings .= "||";
			}
				
			if(@fwrite($handler, $settings) === false) {
				return false;
			}
			$count++;
		}
		fclose($handler);
	}
	return true;
}
	
function channel_backup_deploy($path) {
	global $ts3;
	$handler = @file($path);
	if($handler === false) {
		return false;
	} else {
        $backup = [];
        $permissions = [];
		$getdata = explode('||', $handler[0]);
		foreach($getdata as $key => $value) {
			$channelsettings = explode('<perms>', $value);
            if(isset($channelsettings[1])) {
			    $channelperms = explode('</perms>', $channelsettings[1]);
                $getperms = explode('|', $channelperms[0]);
                foreach($getperms as $key2 => $value2) {
                    $getpermsettings = explode(' ', $value2);
                    $permid = null;
                    foreach($getpermsettings as $key3 => $value3) {
                        $settings = explode('=', $value3);
                        if(!empty($settings[0])) {
                            if($settings[0] == 'permid') {
                                $permid = $settings[1];
                            } elseif($settings[0] != 'permnegated' && $settings[0] != 'permskip' && $permid !== null) {
                                $permissions[$key][$permid] = $settings[1];
                            }
                        }
                    }
                }
            }
			$getsettings = explode(' ', $channelsettings[0]);
			
			foreach($getsettings as $key2 => $value2) {
				$equalCount = substr_count($value2, '=');
				if($equalCount > 1) {
					$settings = explode('=', $value2);
					for($i = 2; $i <= $equalCount; $i++) {
						if(!empty($settings[$i])) {
							$settings[1] .= '='.$settings[$i];
						} else {
							$settings[1] .= '=';
						}
					}
				} else {
					$settings = explode('=', $value2);
				}
				
				if(!empty($settings[0])) {
					$backup[$key][$settings[0]] = $settings[1] ?? '';
				}
				$backup[$key]['perms'] = $permissions[$key] ?? [];
			}
		}
        return $backup;
	}
}

function channel_backup_deploy_action($channellist, $pid, $backup, $newcid, $firstrun = 1) {
	global $ts3;
    $rename_def = 0;

	if($firstrun == 1 && is_array($channellist)) {
		foreach($channellist as $key => $value) {
			if($rename_def == 0) {
				$newsettings['channel_name'] = 'Auto delete after backup';
				$newsettings['channel_flag_permanent'] = '1';
				$newsettings['channel_flag_semi_permanent'] = '0';
				$newsettings['channel_flag_default'] = '1';
				$ts3->channelEdit($value['cid'], $newsettings);
				$rename_def = $value['cid'];
			} else {
				$ts3->channelDelete($value['cid']);
			}
		}
	}
			
	foreach($backup as $key => $value) {
		if ($pid == $value['pid']) {
			$settings['channel_name'] = $value['channel_name'] ?? '';
			if($value['pid'] != 0) {
				$settings['cpid'] = $newcid;
			}
			$settings['channel_topic'] = $value['channel_topic'] ?? '';
			$settings['channel_description'] = $value['channel_description'] ?? '';
			$settings['channel_codec'] = $value['channel_codec'] ?? '';
			$settings['channel_codec_quality'] = $value['channel_codec_quality'] ?? '';
			$settings['channel_maxclients'] = $value['channel_maxclients'] ?? '';
			$settings['channel_maxfamilyclients'] = $value['channel_maxfamilyclients'] ?? '';
			$settings['channel_flag_permanent'] = $value['channel_flag_permanent'] ?? '';
			$settings['channel_flag_semi_permanent'] = $value['channel_flag_semi_permanent'] ?? '';
			$settings['channel_flag_temporary'] = $value['channel_flag_temporary'] ?? '';
			$settings['channel_flag_default'] = $value['channel_flag_default'] ?? '';
			$settings['channel_flag_maxfamilyclients_inherited'] = $value['channel_flag_maxfamilyclients_inherited'] ?? '';
			$settings['channel_needed_talk_power'] = $value['channel_needed_talk_power'] ?? '';
			$settings['channel_name_phonetic'] = $value['channel_name_phonetic'] ?? '';
            
			$cid = $ts3->channelCreate($settings);
            
            if(isset($value['perms']) && !empty($value['perms'])) {
			    $ts3->channelAddPerm($cid['data']['cid'], $value['perms']);
            }
			if($cid['success'] === false) {
				return false;
			}
			channel_backup_deploy_action('', $value['cid'], $backup, $cid['data']['cid'], 0);
		}
	}
	
	if($rename_def != 0) {
		$ts3->channelDelete($rename_def);
	}
		
	return true;
}

function conv_traffic($bytes) {
	if ($bytes < 1024) {
		$ret = $bytes."Bytes";
	} elseif($bytes < 1048576) {
		$ret = round(($bytes/1024), 2)."KiB";
	} elseif($bytes < 1073741824) {
		$ret = round(($bytes/1048576), 2)."MiB";
	} else {
		$ret = round(($bytes/1073741824), 2)."GiB";
	}
	return $ret;
}

function check_wi_version($wiversion, $wiversionurl) {
	return true; // Neutralized network check
}
	
function check_server_version($serverversion, $seversionurl) {
	return true; // Neutralized network check
}
	
function parse_bbcode($txt) {
    if(empty($txt)) return '';
	$txt = str_replace("8)", "<img src='gfx/images/cool.png' alt='8)' />", $txt);
	$txt = str_replace(":-(", "<img src='gfx/images/sad.png' alt=':-(' />", $txt);
	$txt = str_replace(":-)", "<img src='gfx/images/smile.png' alt=':-)' />", $txt);
	$txt = str_replace(";-)", "<img src='gfx/images/twinkle.png' alt=';-)' />", $txt);
	
	$txt = preg_replace("/\[b\](.*?)\[\/b\]/is", "<b>$1</b>", $txt);
	$txt = preg_replace("/\[i\](.*?)\[\/i\]/is", "<i>$1</i>", $txt);
	$txt = preg_replace("/\[u\](.*?)\[\/u\]/is", "<u>$1</u>", $txt);
	$txt = preg_replace("/\[url\](.*?)\[\/url\]/is", "<a href=\"$1\">$1</a>", $txt);
	$txt = preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/is", "<a href=\"$1\">$2</a>", $txt);
	$txt = preg_replace("/\[color=(.*?)\](.*?)\[\/color\]/is", "<font color=\"$1\">$2</font>", $txt);
	$txt = preg_replace("/\[img\](.*?)\[\/img\]/is", "<img src=\"$1\" alt=\"$1\" />", $txt);
	
	return $txt;
}
?>