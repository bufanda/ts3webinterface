
<?php
if($fastswitch==true AND $serverhost==true AND $hoststatus==true AND $loginstatus!==false AND $site!="server" AND $site!="login" OR $fastswitch==true AND $serverhost==false AND $loginstatus!==false AND $site!="server" AND $site!="server" AND $site!="login")
	{
$serverlist=$ts3->serverList();
?>
<form method="get" action="index.php?site=serverview">
<?php
if(strpos($site, 'edit')==false OR $site=='serveredit')
	{
	echo "<input type=\"hidden\" name=\"site\" value=\"$site\" />";
	}
	else
	{
	echo "<input type=\"hidden\" name=\"site\" value=\"serverview\" />";
	}
?>
<select name="port" onChange="submit()">
<?php
foreach($serverlist AS $server)
	{
	if($port==$server['virtualserver_port'])
		{
		echo "<option selected=\"selected\" value=\"".$server['virtualserver_port']."\">".$server['virtualserver_name']."-".$server['virtualserver_port'];
		}
		else
		{
		echo "<option value=\"".$server['virtualserver_port']."\">".$server['virtualserver_name']."-".$server['virtualserver_port'];
		}
	}
?>
</select>
</form>
<?php } ?>
