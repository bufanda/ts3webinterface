<?php
//Don't change this
$wiversionurl="http://www.ts3.cs-united.de/ts3wi/wiversion.html";
$seversionurl="http://www.ts3.cs-united.de/ts3wi/seversion.html";

$wiversion="beta2.3.3";

function check_wi_version($wiversion, $wiversionurl)
	{
	$file=@file_get_contents($wiversionurl);
	$get_number=str_replace('beta', '', $wiversion);
	$get_number2=str_replace('beta', '', $file);
	if($wiversion==$file or $get_number>$get_number2)
		{
		return true;
		}
		else
		{
		return "<a class=\"warning\" href=\"http://www.ts3.cs-united.de/ts3wi/traffic.php?version=".$file."\" target=\"_blank\">".$file."</a>";
		}
	}
	
function check_server_version($serverversion, $seversionurl)
	{
	$file=@file_get_contents($seversionurl);
	$get_build=explode(' ', $serverversion);
	$get_build=str_replace(']', '', $get_build[2]);
	$get_build2=explode(' ', $file);
	$get_build2=str_replace(']', '', $get_build2[2]);
	if ($serverversion==$file OR $get_build>$get_build2)
		{
		return true;
		}
		else
		{
		return "<a class=\"warning\" href=\"http://www.teamspeak.com\" target=\"_blank\">".$file."</a>";
		}
	}