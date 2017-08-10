<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
$newsettings=array();
if(isset($_POST['editchannelname']))
	{
	$newsettings[]=array('name', $_POST['name']);
	
	if($ts3->channelEdit($cid, $newsettings))
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['channelnameeditok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
if(isset($_POST['editchannel']))
	{
	$newsettings[]=array('topic', $_POST['topic']);
	$newsettings[]=array('description', $_POST['description']);
	$newsettings[]=array('codec', $_POST['codec']);
	$newsettings[]=array('codec_quality', $_POST['codecquali']);
	$newsettings[]=array('maxclients', $_POST['maxclients']);
	$newsettings[]=array('maxfamilyclients', $_POST['maxfamclients']);
	if($_POST['chantyp']=='0')
		{
		$newsettings[]=array('flag_permanent', '0');
		$newsettings[]=array('flag_semi_permanent', '0');
		}
	elseif($_POST['chantyp']=='1')
		{
		$newsettings[]=array('flag_permanent', '0');
		$newsettings[]=array('flag_semi_permanent', '1');
		}
	elseif($_POST['chantyp']=='2')
		{
		$newsettings[]=array('flag_permanent', '1');
		$newsettings[]=array('flag_semi_permanent', '0');
		}
	elseif($_POST['chantyp']=='3')
		{
		$newsettings[]=array('flag_permanent', '1');
		$newsettings[]=array('flag_semi_permanent', '0');
		$newsettings[]=array('flag_default', '1');
		}
	$newsettings[]=array('flag_maxfamilyclients_inherited', $_POST['inherited']);
	$newsettings[]=array('needed_talk_power', $_POST['talkpower']);
	$newsettings[]=array('name_phonetic', $_POST['phonetic']);
	
	if($ts3->channelEdit($cid, $newsettings))
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['channeleditok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
if(isset($_POST['editpw']))
	{
	$newsettings[]=array('password', $_POST['password']);
	if($ts3->channelEdit($cid, $newsettings))
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['passwordsetok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
if(isset($_POST['movechan']))
	{
	if($ts3->channelMove($cid, $_POST['move']))
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['channelmoveok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
$channellist=$ts3->channellist();
$channelinfo=$ts3->channelInfo($cid);
?>
	<tr valign="top">
		<td style="width:50%">
		<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead"><?php echo $lang['channel']." ".$lang['editor'];?></td>
			</tr>
			<form method="post" action="index.php?site=channeledit&amp;port=<?php echo $port; ?>&amp;cid=<?php echo $cid; ?>">
			<tr>
				<td class="green1"><?php echo $lang['name']; ?>:</td>
				<td class="green1">
				<input type="text" name="name" value="<?php echo htmlentities($channelinfo['channel_name'], ENT_QUOTES, "UTF-8"); ?>" />
				<input class="button" type="submit" name="editchannelname" value="<?php echo $lang['rename']; ?>" />
				</td>
			</tr>
			</form>
			<form method="post" action="index.php?site=channeledit&amp;port=<?php echo $port; ?>&amp;cid=<?php echo $cid; ?>">
			<tr>
				<td class="green2"><?php echo htmlentities($lang['topic'], ENT_QUOTES, "UTF-8"); ?>:</td>
				<td class="green2"><input type="text" name="topic" value="<?php if(isset($channelinfo['channel_topic'])) {echo $channelinfo['channel_topic'];} ?>" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo htmlentities($lang['description'], ENT_QUOTES, "UTF-8"); ?>:</td>
				<td class="green1"><input type="text" name="description" value="<?php if(isset($channelinfo['channel_description'])) {echo $channelinfo['channel_description'];} ?>" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['codec']; ?>:</td>
				<td class="green2">
				<?php $sel='selected="selected"'; ?>
				<select name="codec">
				<option value="0" <?php if($channelinfo['channel_codec']=='0') {echo $sel;} ?>><?php echo $lang['codec0']; ?></option>
				<option value="1" <?php if($channelinfo['channel_codec']=='1') {echo $sel;} ?>><?php echo $lang['codec1']; ?></option>
				<option value="2" <?php if($channelinfo['channel_codec']=='2') {echo $sel;} ?>><?php echo $lang['codec2']; ?></option>
				<option value="3" <?php if($channelinfo['channel_codec']=='3') {echo $sel;} ?>><?php echo $lang['codec3']; ?></option>
				</select>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['codecquality']; ?>:</td>
				<td class="green1">
				<?php $sel='selected="selected"'; ?>
				<select name="codecquali">
				<option value="0" <?php if($channelinfo['channel_codec_quality']=='0') {echo $sel;} ?>>0</option>
				<option value="1" <?php if($channelinfo['channel_codec_quality']=='1') {echo $sel;} ?>>1</option>
				<option value="2" <?php if($channelinfo['channel_codec_quality']=='2') {echo $sel;} ?>>2</option>
				<option value="3" <?php if($channelinfo['channel_codec_quality']=='3') {echo $sel;} ?>>3</option>
				<option value="4" <?php if($channelinfo['channel_codec_quality']=='4') {echo $sel;} ?>>4</option>
				<option value="5" <?php if($channelinfo['channel_codec_quality']=='5') {echo $sel;} ?>>5</option>
				<option value="6" <?php if($channelinfo['channel_codec_quality']=='6') {echo $sel;} ?>>6</option>
				<option value="7" <?php if($channelinfo['channel_codec_quality']=='7') {echo $sel;} ?>>7</option>
				<option value="8" <?php if($channelinfo['channel_codec_quality']=='8') {echo $sel;} ?>>8</option>
				<option value="9" <?php if($channelinfo['channel_codec_quality']=='9') {echo $sel;} ?>>9</option>
				<option value="10" <?php if($channelinfo['channel_codec_quality']=='10') {echo $sel;} ?>>10</option>
				</select>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['maxclients']; ?>:</td>
				<td class="green2"><input type="text" name="maxclients" value="<?php echo $channelinfo['channel_maxclients']; ?>" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['maxfamilyclients']; ?>:</td>
				<td class="green1"><input type="text" name="maxfamclients" value="<?php echo $channelinfo['channel_maxfamilyclients']; ?>" /></td>
			</tr>
			<?php
			/**
			<tr>
				<td class="green2">Order:</td>
				<td class="green2">
				<select name="order">
				<option value="0">Mainchannel</option>
				<?php
				foreach($channellist AS $value)
					{
					$sel='';
					if($value['cid']==$channelinfo['channel_order'])
						{
						$sel='selected="selected"';
						}
					?>
					<option value="<?php echo $value['cid']; ?>"<?php echo $sel; ?>><?php echo $value['channel_name']; ?></option>
					<?php } ?>
				</select>
			</tr>
			*/
			?>
			<tr>
				<td class="green2"><?php echo $lang['name']; ?>:</td>
				<td class="green2">
				<?php $check='checked="checked"';?>
				<?php echo $lang['temporary']; ?><input type="radio" name="chantyp" value="0" <?php if($channelinfo['channel_flag_permanent']==0 AND $channelinfo['channel_flag_semi_permanent']==0) {echo $check;}?> /><br/>
				<?php echo $lang['semipermanent']; ?><input type="radio" name="chantyp" value="1" <?php if($channelinfo['channel_flag_semi_permanent']==1) {echo $check;}?> /><br/>
				<?php echo $lang['permanent']; ?><input type="radio" name="chantyp" value="2" <?php if($channelinfo['channel_flag_permanent']==1 AND $channelinfo['channel_flag_default']==0) {echo $check;}?> /><br />
				<?php echo $lang['default']; ?><input type="radio" name="chantyp" value="3" <?php if($channelinfo['channel_flag_default']==1) {echo $check;}?> />
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['maxfamilyclientsinherited']; ?>:</td>
				<td class="green2">
				<?php $sel='selected="selected"'; ?>
				<select name="inherited">
				<option value="0"<?php if($channelinfo['channel_flag_maxfamilyclients_inherited']=='0') {echo $sel;} ?>>0</option>
				<option value="1"<?php if($channelinfo['channel_flag_maxfamilyclients_inherited']=='1') {echo $sel;} ?>>1</option>
				</select>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['neededtalkpower']; ?>:</td>
				<td class="green1"><input type="text" name="talkpower" value="<?php echo $channelinfo['channel_needed_talk_power']; ?>" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo htmlentities($lang['phoneticname'], ENT_QUOTES, "UTF-8"); ?>:</td>
				<td class="green2"><input type="text" name="phonetic" value="<?php if(isset($channelinfo['channel_name_phonetic'])) {echo $channelinfo['channel_name_phonetic'];} ?>" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['option']; ?>:</td>
				<td class="green1"><input class="button" type="submit" name="editchannel" value="<?php echo $lang['edit']; ?>" /></td>
			</tr>
			</form>
		</table>
		</td>
		<td style="width:50%">
		<table class="border" cellpadding="1" cellspacing="0">
			<form method="post" action="index.php?site=channeledit&amp;port=<?php echo $port; ?>&amp;cid=<?php echo $cid; ?>">
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['channelpassword']; ?></td>
			</tr>
			<tr>
			<td class="green1"><?php echo $lang['passwordset']; ?>:</td>
			<td class="green1">
			<?php
			if($channelinfo['channel_flag_password']==1)
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
				<td class="green2"><?php echo $lang['newpassword']; ?>:</td>
				
				<td class="green2">
				<?php
				if($channelinfo['channel_flag_default']==1)
					{
					echo $lang['defaultnopw'];
					}
					else
					{
					echo "<input type=\"text\" name=\"password\" value=\"\" />";
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['option']; ?>:</td>
				<td class="green1">
				<?php
				if($channelinfo['channel_flag_default']==0)
					{
					echo "<input class=\"button\" type=\"submit\" name=\"editpw\" value=\"".$lang['send']."\" />";
					}
					?>
				</td>
			</tr>
		</table>
		<br />
		<form method="post" action="index.php?site=channeledit&amp;port=<?php echo $port; ?>&amp;cid=<?php echo $cid; ?>">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead"><?php echo $lang['channelmove']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['moveto']; ?>:</td>
				<td class="green1">
				<select name="move">
				<option value="0"><?php echo htmlentities($lang['mainchannel'], ENT_QUOTES, "UTF-8"); ?></option>
				<?php
				foreach($channellist AS $value)
					{
					if($value['cid']!=$cid)
						{?>
						<option value="<?php echo $value['cid']; ?>"><?php echo $value['channel_name']; ?></option>
				<?php 	}
					} ?>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['option']; ?>:</td>
				<td class="green2"><input class="button" type="submit" name="movechan" value="<?php echo $lang['move']; ?>" /></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>
<?php } ?>