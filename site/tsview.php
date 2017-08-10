<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}

function create_tree($pid, $place, $alldata, $port)
	{
	foreach($alldata['channel'] AS $key=>$value)
		{
		if ($pid==$value['pid'])
			{
			$chan_img='';
			if($value['channel_flag_default']==1)
				{
				$chan_img.="<div class=\"default\">&nbsp</div>";
				}
			if($value['channel_icon_id']!=0)
				{
				if($value['channel_icon_id']<0)
					{
					$value['channel_icon_id']=sprintf('%u', $value['channel_icon_id'] & 0xffffffff);
					}
				$chan_img.="<div style=\"float:left;width:20px\"><img src=\"site/showfile.php?name=icon_".$value['channel_icon_id']."\" /></div>";
				}
				
			if($value['channel_flag_password']==1)
				{
				echo "<div class='channel'>".$place."<div class='pwchanimg'>&nbsp;</div><div class='channame'>".$value['channel_name']."&nbsp;</div><div class='pwimg'></div><div class=\"password\"></div>".$chan_img."<div class='clear'></div></div>\n";
				}
			else
				{
				echo "<div class='channel'>".$place."<div class='chanimg'>&nbsp;</div><div class='channame'>".$value['channel_name']."&nbsp;</div>".$chan_img."<div class='clear'></div></div>\n";
				}
			if($value['total_clients']>=1)
				{
				if(!empty($alldata['clients']))
					{
					foreach($alldata['clients'] AS $u_key=>$u_value)
						{
						if($value['cid'] == $u_value['cid'] AND $u_value['client_type']!="1")
							{
							
							$u_away_msg="";
							if($u_value['client_away']=="1")
								{
								$u_status="away";
								if(!empty($u_value['client_away_message']))	
									{
									$u_away_msg="<div class='away_msg'>(".$u_value['client_away_message'].")</div>";
									}
								}
							elseif($u_value['client_output_hardware']=="0")
								{
								$u_status="hwhead";
								}
							elseif($u_value['client_input_hardware']=="0")
								{
								$u_status="hwmic";
								}
							elseif($u_value['client_output_muted']=="1")
								{
								$u_status="head";
								}
							elseif($u_value['client_input_muted']=="1")
								{
								$u_status="mic";
								}
							elseif($u_value['client_flag_talking']=="1")
								{
								$u_status="player_on";
								}
							else
								{
								$u_status="player";
								}
							$g_img='';
							
							foreach($alldata['cgroups'] AS $key=>$cg_value)
								{
								if($cg_value['cgid']==$u_value['client_channel_group_id'])
									{
									$iconid=$cg_value['iconid'];
									if($iconid<0)
										{
										$iconid=sprintf('%u', $iconid & 0xffffffff);
										}
									if($iconid!=0)
										{
										$g_img.="<div style=\"float:left;width:20px\"><img src=\"site/showfile.php?name=icon_".$iconid."\" /></div>";
										}
									}
								}
						
							$getsgroups=explode(',', trim($u_value['client_servergroups']));
							foreach($alldata['sgroups'] AS $key=>$sg_value)
								{
								if(in_array($sg_value['sgid'], $getsgroups))
									{
									$iconid=$sg_value['iconid'];
									if($iconid<0)
										{
										$iconid=sprintf('%u', $iconid & 0xffffffff);
										}
									if($iconid!=0)
										{
										$g_img.="<div style=\"float:left;width:20px\"><img src=\"site/showfile.php?name=icon_".$iconid."\" /></div>";
										}
									}
								}
							
							if($u_value['client_icon_id']!=0)
								{
								if($u_value['client_icon_id']<0)
									{
									$u_value['client_icon_id']=sprintf('%u', $u_value['client_icon_id'] & 0xffffffff);
									}
								$g_img.="<div style=\"float:left;width:20px\"><img src=\"site/showfile.php?name=icon_".$u_value['client_icon_id']."\" /></div>";
								}
						
							echo "<div class='client'>".$place,
								 "<div class='place'>&nbsp;</div>",
								 "<div class='".$u_status."_img'>&nbsp;</div>",
								 "<div class='clientnick'><a href=\"javascript:oeffnefenster('site/interactive.php?port=".$port."&amp;clid=".$u_value['clid']."&amp;nick=".addslashes($u_value['client_nickname'])."&amp;action=action');\">".$u_value['client_nickname']."</a>&nbsp;</div>",
								 $g_img.$u_away_msg,
								 "<div style='clear:both'></div></div>\n";
							}
						}
					}
				}
			create_tree($value['cid'], $place."<div class='place'>&nbsp;</div>", $alldata, $port);
			}
		}
	}

include("site/filetransfer.php");
$alldata=array();
$alldata['server']=$ts3->serverInfo();
$alldata['channel']=$ts3->channelList("-flags");
foreach($alldata['channel'] AS $key => $value)
	{
	$channelinfo=$ts3->channelInfo($alldata['channel'][$key]['cid']);
	$alldata['channel'][$key]['channel_icon_id']=$channelinfo['channel_icon_id'];
	}
$alldata['clients']=$ts3->clientList("-away -voice -groups");
foreach($alldata['clients'] AS $key => $value)
	{
	$clientinfo=$ts3->clientInfo($alldata['clients'][$key]['clid']);
	$alldata['clients'][$key]['client_icon_id']=$clientinfo['client_icon_id'];
	}
$alldata['sgroups']=$ts3->serverGroupList();
$alldata['cgroups']=$ts3->channelGroupList();
?>

<div class='content'>
<div class='server_img'></div><div class='servername'><?php echo $alldata['server']['virtualserver_name']; ?>&nbsp;</div><div style="float:left;width:20px"><?php if($alldata['server']['virtualserver_icon_id']!=0) {?><img src="site/showfile.php?name=icon_<?php echo $alldata['server']['virtualserver_icon_id']; ?>" /><?php } ?></div><div class='clear'></div>
<?php create_tree(0, "<div class='place'>&nbsp;</div>", $alldata, $port); ?>
</div>
