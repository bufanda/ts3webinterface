<?php
session_start();
require_once('../ts3admin.class.php');
$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
$ts3->connect();
$ts3->login($_SESSION['loginuser'], $_SESSION['loginpw']);
$ts3->selectServerByPort($_POST['port']);

$start=0;
$duration=1000;
while($clients=$ts3->clientDbList("start=".$start, "duration=".$duration))
	{
	foreach($clients AS $client)
		{
		if($client['client_unique_identifier']!="ServerQuery")
			{
			$sqlstring.="INSERT INTO \"clients\" (server_id, client_unique_id, client_nickname) VALUES (".$_POST['sid'].",'".$client['client_unique_identifier']."','".$client['client_nickname']."');\n";
			}
		}
	$start=$start + $duration;
	}
header('Content-Disposition: attachment; filename="clientbackup.sql"');
header('Content-Type: x-type/subtype');
echo $sqlstring;
?>