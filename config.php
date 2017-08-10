<?php
/*
*Copyright (C) 2010-2011  Psychokiller
*
*This program is free software; you can redistribute it and/or modify it under the terms of 
*the GNU General Public License as published by the Free Software Foundation; either 
*version 3 of the License, or any later version.
*
*This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
*without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
*See the GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. 
*/
if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
/*
REGARD!!
If you use the web interface, they must write the webserver ip in the query_ip_whitelist.txt.
After adding the ip, the server must be restarted!

Add more Server Ip's.
For Example
$server[0]['alias']= "Lokaler Server1";
$server[0]['ip']= "127.0.0.1";
$server[0]['tport']= "10011";

$server[0]['alias']= "Lokaler Server2";
$server[1]['ip']= "127.0.0.2";
$server[1]['tport']= "20022";

$server[0]['alias']= "Lokaler Server3";
$server[2]['ip']= "127.0.0.3";
$server[2]['tport']= "30033";
*/

$server[0]['alias']= "Lokaler Server";
$server[0]['ip']= "127.0.0.1";
$server[0]['tport']= "10011";

$cfglang	=	"en";			//Language German = de, English = en, Netherlandish=nl (by pd1evl)

$duration = "100";				//Set the Limit for Clients show per Page on Client List

$fastswitch=true;				//If true you can switch the Server on the header

$showicons="left";				//Define the position where the icons on the Viewer will show left or right

$style="new";					//Chose your design  set 'default' or 'new' for the default designs or the name of your own create design

$msgsend_name="Webinterface";	//This Name will be show if you send a message to a Server

$serverhost=false;				//If this true normal query clients must specific a port on Login.
$hostusername='superadmin';  	//If $serverhost=true write here your webinterface username.
$hostpassword='123456';		 	//If $serverhost=true write here your webinterface password.
?>