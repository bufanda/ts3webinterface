<?php
session_start();
require('../config.php');
require('../ts3admin.class.php');
require('lang.php');

$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
$ts3->connect();
$ts3->login($_SESSION['loginuser'], $_SESSION['loginpw']);
$ts3->selectServerByPort($_GET['port']);

$channellist=$ts3->channelList("-limits");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../gfx/<?php echo $style; ?>/style.css" type="text/css" media="screen" />
</head>
<body>

	<form method="post" name="f1" action="interactive.php?port=<?php echo $_GET['port']; ?>&clid=<?php echo $_GET['clid']; ?>&nick=<?php echo $_GET['nick']; ?>">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2"><?php echo $_GET['nick']; ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['select']; ?>:</td>
			<td class="green1">
			<select name="action" onChange="submit()">
				<option value=""><?php echo $lang['select']; ?></option>
				<option value="kick"><?php echo $lang['kick']; ?></option>
				<option value="ban"><?php echo $lang['ban']; ?></option>
				<option value="poke"><?php echo $lang['poke']; ?></option>
				<option value="move"><?php echo $lang['move']; ?></option>
			</select>
			</td>
		</tr>
	</table>
	</form>
	<br />
<?php 

if($_POST['action']=='kick')
	{?>
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&port=<?php echo $_GET['port']; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2"><?php echo $lang['kick']." ".$_GET['nick']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['kickmsg']; ?>:</td>
		<td class="green1"><input type="text" name="kickmsg" value="" /></td>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?>:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="<?php echo $_GET['clid']; ?>" />
		<input class="button" type="submit" name="sendkick" value="<?php echo $lang['kick']; ?>" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
<?php } 

if($_POST['action']=='ban')
	{?>
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&port=<?php echo $_GET['port']; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2"><?php echo $lang['ban']." ".$_GET['nick']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['banmsg']; ?>:</td>
		<td class="green1">
		<input type="text" name="banmsg" value=""></td>
	<tr>
	<tr>
		<td class="green2"><?php echo $lang['bantime']; ?>:</td>
		<td class="green2">
		<input type="text" name="bantime" value=""><?php echo $lang['seconds']; ?></td>
	<tr>
		<td class="green1"><?php echo $lang['option']; ?>:</td>
		<td class="green1">
		<input type="hidden" name="clid" value="<?php echo $_GET['clid']; ?>" />
		<input class="button" type="submit" name="sendban" value="<?php echo $lang['ban']; ?>" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
<?php } 

if($_POST['action']=='poke')
	{?>
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&port=<?php echo $_GET['port']; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2"><?php echo $lang['poke']." ".$_GET['nick']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['pokemsg']; ?>:</td>
		<td class="green1">
		<input type="text" name="pokemsg" value=""></td>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?>:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="<?php echo $_GET['clid']; ?>" />
		<input class="button" type="submit" name="sendpoke" value="<?php echo $lang['poke']; ?>" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
<?php }

if($_POST['action']=='move')
	{?>
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&port=<?php echo $_GET['port']; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2"><?php echo $lang['move']." ".$_GET['nick']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['move']; ?>:</td>
		<td class="green1">
		<select name="cid">
		<?php
		foreach($channellist AS $value)
			{
			echo "<option value=\"".$value['cid']."\">".htmlentities($value['channel_name'], ENT_QUOTES, "UTF-8")."</option>";
			}
		?>
		</select>
		</td>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?>:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="<?php echo $_GET['clid']; ?>" />
		<input class="button" type="submit" name="sendmove" value="<?php echo $lang['move']; ?>" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
<?php }
?>
</body>
</html>