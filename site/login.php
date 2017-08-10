<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} ?>
<table cellpadding="0" cellspacing="0">
<?php

if($loginstatus===true AND $serverhost===true AND isset($_POST['sendlogin']))
	{
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=serverview&amp;port=".$_SESSION['loginport']."\">";
	}
elseif($loginstatus===true AND $serverhost===false AND isset($_POST['sendlogin']))
	{
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";
	}
elseif($loginstatus===false AND !empty($port_err) AND isset($_POST['sendlogin']))
	{
	echo "<tr><td colspan=\"2\">".$lang['noserverport']."</td></tr>";
	}
elseif($loginstatus===false AND isset($_POST['sendlogin']))
	{
	echo "<tr><td colspan=\"2\">".$lang['loginerror']."</td></tr>";
	echo $ts3->getDebugLog();
	}
elseif($loginstatus===true AND !isset($_POST['sendlogin']))
	{
	echo "<tr><td>".$lang['alreadylogin']."</td></tr>";
	}
	
if(!isset($_POST['sendlogin']) AND $loginstatus!==true OR $loginstatus!==true)
	{?>
	<form method="post" action="index.php?site=login">
	<tr>
		<td class="logintop login" colspan="2"><?php echo $lang['login']; ?></td>
	</tr>
	<tr>
		<td class="loginpuff" align="center">
		<table style="padding:10px;" cellpadding="1" cellspacing="0">
			<tr>
				<td class="login"><?php echo $lang['server']; ?>:</td>
				<td>
				<?php
				if(count($server)==1)
					{
					foreach($server AS $key=>$value)
						{?>
						<input type="hidden" name="skey" value="<?php echo $key; ?>" />		
						<?php	
						echo $server[$key]['ip']; 
						}
					}
					else
					{?>
					<select name="skey">
					<?php
					foreach($server AS $key=>$value)
						{?>
						<option value="<?php echo $key;?>"><?php echo $server[$key]['ip']; ?></option>	
				<?php	}
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="login"><?php echo $lang['username']; ?>:</td>
				<td class="login"><input class="bild" type="text" name="loginUser" value="serveradmin" /></td>
			</tr>
			<tr>
				<td class="login"><?php echo $lang['password']; ?>:</td>
				<td class="login"><input class="bild" type="password" name="loginPw" /></td>
			</tr>
			<?php
			if($serverhost===true)
				{?>
				<tr>
					<td class="login"><?php echo $lang['port']; ?>:</td>
					<td class="login"><input class="bild" type="text" name="loginPort" value="" /></td>
				</tr>
			<?php } ?>
			<tr>
				<td class="login"><?php echo $lang['option']; ?>:</td>
				<td><input class="button" type="submit" class="button" name="sendlogin" value="<?php echo $lang['login']; ?>"/></td>
			</tr>
			</form>
			<?php
			if($serverhost===true)
				{?>
			<tr>
				<td colspan="2" style="text-align:center"><a href="index.php?site=hostlogin"><?php echo $lang['hostlogin']; ?></a></td>
			</tr>
			<?php } ?>
		</table>
		</td>
	</tr>
	<tr>
		<td class="loginbottom">&nbsp;</td>
	</tr>
<?php } ?>
</table>