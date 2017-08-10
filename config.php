<?php
/*
REGARD!!
If you use the web interface, they must write the webserver ip in the query_ip_whitelist.txt.
After adding the ip, the server must be restarted!


Add more Server Ip's.
For Example
$server[0]['ip']= "127.0.0.1";
$server[0]['tport']= "10011";

$server[1]['ip']= "127.0.0.2";
$server[1]['tport']= "20022";

$server[2]['ip']= "127.0.0.3";
$server[2]['tport']= "30033";
*/
$server[0]['ip']= "127.0.0.1";
$server[0]['tport']= "10011";

$cfglang	=	"en";			//Language German = de, English = en

$duration = "100";				//Set the Limit for Clients show per Page on Client List

$fastswitch=true;				//If true you can switch the Server on the header

$oldserver=false;				//Set this on true if the Server version older than beta23

$style="new";				


$serverhost=false;				//If this true normal query clients must specific a port on Login.
$hostusername='superadmin';  	//If $serverhost=true write here your webinterface username.
$hostpassword='123456';		 	//If $serverhost=true write here your webinterface password.
