<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
$channelinfo=$ts3->channelInfo($cid);
?>
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead"><?php echo $lang['channelinfo']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['name']; ?>:</td>
				<td class="green1"><?php echo $channelinfo['channel_name'];?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['topic']; ?>:</td>
				<td class="green2"><?php if(isset($channelinfo['channel_topic'])) {echo $channelinfo['channel_topic'];} ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['description']; ?>:</td>
				<td class="green1"><?php if(isset($channelinfo['channel_description'])) {echo $channelinfo['channel_description'];}?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['passwordset']; ?>:</td>
				<td class="green2">
				<?php 
				if($channelinfo['channel_flag_password'] == '1')
					{
					echo $lang['yes'];
					}
					else
					{
					echo $lang['no'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['default']; ?>:</td>
				<td class="green1">
				<?php 
				if($channelinfo['channel_flag_default'] == '1')
					{
					echo $lang['yes'];
					}
					else
					{
					echo $lang['no'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['maxclients']; ?>:</td>
				<td class="green2">
				<?php 
				if($channelinfo['channel_maxclients'] == '-1')
					{
					echo $lang['unlimited'];
					}
					else
					{
					echo $channelinfo['channel_maxclients'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['maxfamilyclients']; ?>:</td>
				<td class="green1">
				<?php 
				if($channelinfo['channel_flag_maxfamilyclients_inherited'] == '1')
					{
					echo $lang['inherited'];
					}
				elseif($channelinfo['channel_flag_maxfamilyclients_unlimited'] == '1')
					{
					echo $lang['unlimited'];
					}
				else
					{
					echo $channelinfo['channel_maxfamilyclients'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['codec']; ?>:</td>
				<td class="green2">
				<?php
				if($channelinfo['channel_codec']=='0')
					{
					echo $lang['codec0'];
					}
				elseif($channelinfo['channel_codec']=='1')
					{
					echo $lang['codec1'];
					}
				elseif($channelinfo['channel_codec']=='2')
					{
					echo $lang['codec2'];
					}
				elseif($channelinfo['codec4']=='3')
					{
					echo $lang['codec3'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['codecquality']; ?>:</td>
				<td class="green1"><?php echo $channelinfo['channel_codec_quality'];?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['neededtalkpower']; ?>:</td>
				<td class="green2"><?php echo $channelinfo['channel_needed_talk_power'];?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['forcedsilence']; ?>:</td>
				<td class="green1">
				<?php
				if($channelinfo['channel_forced_silence'] == '1')
					{
					echo $lang['yes'];
					}
					else
					{
					echo $lang['no'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['phoneticname']; ?></td>
				<td class="green2"><?php if(isset($channelinfo['channel_name_phonetic'])) {echo $channelinfo['channel_name_phonetic'];} ?></td>
			</tr>
		</table>
<?php } ?>