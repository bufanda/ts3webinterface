<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table class="border" cellpadding="1" cellspacing="0">
<?php
$settings=array();
if(isset($_POST['createchannel']))
	{
	$settings[]=array('name', $_POST['name']);
	$settings[]=array('topic', $_POST['topic']);
	$settings[]=array('description', $_POST['description']);
	$settings[]=array('codec', $_POST['codec']);
	$settings[]=array('codec_quality', $_POST['codecquali']);
	$settings[]=array('maxclients', $_POST['maxclients']);
	$settings[]=array('maxfamilyclients', $_POST['maxfamclients']);
	if($_POST['chantyp']=='1')
		{
		$settings[]=array('flag_permanent', '0');
		$settings[]=array('flag_semi_permanent', '1');
		}
	elseif($_POST['chantyp']=='2')
		{
		$settings[]=array('flag_permanent', '1');
		$settings[]=array('flag_semi_permanent', '0');
		}
	elseif($_POST['chantyp']=='3')
		{
		$settings[]=array('flag_permanent', '1');
		$settings[]=array('flag_semi_permanent', '0');
		$settings[]=array('flag_default', '1');
		}
	$settings[]=array('flag_maxfamilyclients_inherited', $_POST['inherited']);
	$settings[]=array('needed_talk_power', $_POST['talkpower']);
	$settings[]=array('name_phonetic', $_POST['phonetic']);
	$ts3->channelCreate($settings);
	if(strpos($ts3->getDebugLog(), 'cid=')!==false)
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['channelcreatedok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"2\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
$channellist=$ts3->channelList();
?>

		<form method="post" action="index.php?site=createchannel&amp;port=<?php echo $port; ?>">
			<tr>
				<td colspan="2" class="thead"><?php echo $lang['createachannel']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['name']; ?>:</td>
				<td class="green1"><input type="text" name="name" value="" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['topic']; ?>:</td>
				<td class="green2"><input type="text" name="topic" value="" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['description']; ?>:</td>
				<td class="green1"><input type="text" name="description" value="" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['codec']; ?>:</td>
				<td class="green1">
				<select name="codec">
				<option value="0"><?php echo $lang['codec0']; ?></option>
				<option value="1"><?php echo $lang['codec1']; ?></option>
				<option value="2"><?php echo $lang['codec2']; ?></option>
				<option value="3"><?php echo $lang['codec3']; ?></option>
				</select>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['codecquality']; ?>:</td>
				<td class="green2">
				<select name="codecquali">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				</select>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['maxclients']; ?>:</td>
				<td class="green1"><input type="text" name="maxclients" value="-1" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['maxfamilyclients']; ?>:</td>
				<td class="green2"><input type="text" name="maxfamclients" value="-1" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['type']; ?>:</td>
				<td class="green2">
				<?php echo $lang['semipermanent']; ?> <input type="radio" name="chantyp" value="1" checked="checked" /><br/>
				<?php echo $lang['permanent']; ?> <input type="radio" name="chantyp" value="2" /><br />
				<?php echo $lang['default']; ?> <input type="radio" name="chantyp" value="3" />
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['maxfamilyclientsinherited']; ?>:</td>
				<td class="green1">
				<select name="inherited">
				<option value="0">0</option>
				<option value="1">1</option>
				</select>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['neededtalkpower']; ?>:</td>
				<td class="green2"><input type="text" name="talkpower" value="0" /></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['phoneticname']; ?>:</td>
				<td class="green1"><input type="text" name="phonetic" value="" /></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['option']; ?>:</td>
				<td class="green2"><input type="submit" name="createchannel" value="<?php echo $lang['create']; ?>" /></td>
			</tr>
			</form>
		</table>
<?php } ?>