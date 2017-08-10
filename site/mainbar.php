<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
if($loginstatus===true)
			{?>
<td style="width:100px" >
<table style="width:100px" class="border" cellpadding="1" cellspacing="0">
		<?php
			echo "<tr><td style=\"width:100px\" class=\"maincat\">".$lang['server']."</td></tr>";
			if($hoststatus===true OR $serverhost==false)
				{
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=server\">".$lang['serverlist']."</a></td></tr>";
				}
			if(!isset($port) AND $hoststatus===true or !isset($port) AND $serverhost==false)
				{
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=createserver\">".$lang['createserver']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=servertraffic\">".$lang['instancetraffic']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=instanceedit\">".$lang['instanceedit']."</a></td></tr>";
				}
			if(isset($port))
				{
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=serverview&amp;port=".$port."\">".$lang['serverview']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=servertraffic&amp;port=".$port."\">".$lang['virtualtraffic']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=serveredit&amp;port=".$port."\">".$lang['serveredit']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=fileupload&amp;port=".$port."\">Icon Upload</a></td></tr>";
				echo "<tr><td class=\"maincat\">".$lang['channel']."</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=channel&amp;port=".$port."\">".$lang['channellist']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=createchannel&amp;port=".$port."\">".$lang['createchannel']."</a></td></tr>";
				if(isset($cid))
					{
					echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=channelview&amp;port=".$port."&amp;cid=".$cid."\">".$lang['channelview']."</a></td></tr>";
					echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=channeledit&amp;port=".$port."&amp;cid=".$cid."\">".$lang['channeledit']."</a></td></tr>";
					}
				
				echo "<tr><td class=\"maincat\">".$lang['clients']."</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=counter&amp;port=".$port."\">".$lang['clientcounter']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=clients&amp;port=".$port."\">".$lang['clientlist']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=complainlist&amp;port=".$port."\">".$lang['complainlist']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=chanclienteditperm&amp;port=".$port."\">".$lang['chanclientperms']."</a></td></tr>";			
				
				echo "<tr><td class=\"maincat\">".$lang['bans']."</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=banlist&amp;port=".$port."\">".$lang['banlist']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=banadd&amp;port=".$port."\">".$lang['addban']."</a></td></tr>";
				
				echo "<tr><td class=\"maincat\">".$lang['groups']."</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=sgroups&amp;port=".$port."\">".$lang['servergroups']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=sgroupadd&amp;port=".$port."\">".$lang['addservergroup']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=cgroups&amp;port=".$port."\">".$lang['channelgroups']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=cgroupadd&amp;port=".$port."\">".$lang['addchannelgroup']."</a></td></tr>";
				
				echo "<tr><td class=\"maincat\">".$lang['token']."</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=token&amp;port=".$port."\">".$lang['token']."</a></td></tr>";
				
				echo "<tr><td class=\"maincat\">".$lang['backup']."</td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=backup&amp;port=".$port."\">".$lang['chanbackups']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=serverbackup&amp;port=".$port."\">".$lang['serverbackups']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=permexport&amp;port=".$port."\">".$lang['permexport']."</a></td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=clientsexport&amp;port=".$port."\">".$lang['clientsexport']."</a></td></tr>";
				echo "<tr><td class=\"green2\"><a class=\"mainbarlink\" href=\"index.php?site=bansexport&amp;port=".$port."\">".$lang['bansexport']."</a></td></tr>";
				
				echo "<tr><td class=\"maincat\">Console</td></tr>";
				echo "<tr><td class=\"green1\"><a class=\"mainbarlink\" href=\"index.php?site=console&amp;port=".$port."\">".$lang['queryconsole']."</a></td></tr>";
				}?>
</table>
</td>
<?php } ?>