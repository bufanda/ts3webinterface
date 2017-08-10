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
if(!defined("SECURECHECK")) {die("Error: The file can not be executed alone");} 
session_start();

if(isset($_POST['skey']) OR isset($_SESSION['server_ip']) AND isset($_SESSION['server_tport']))
	{
	if(!isset($_SESSION['server_ip']) AND !isset($_SESSION['server_tport']) OR isset($_POST['skey']))
		{
		$_SESSION['skey']=$_POST['skey'];
		$_SESSION['server_ip']=$server[$_POST['skey']]['ip'];
		$_SESSION['server_tport']=$server[$_POST['skey']]['tport'];
		}
	
	$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
	if($ts3->getElement('success', $ts3->connect())===true)
		{
		$serverstatus=true;
		}
		else
		{
		$serverstatus=false;
		}
	}


$uip=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['loginUser'])) {$lg_user=$_POST['loginUser'];}
if(isset($_POST['loginPw'])) {$lg_pw=$_POST['loginPw'];}
if(isset($_POST['loginPort'])) {$lg_port=$_POST['loginPort'];}
if(isset($_POST['loginHostUser'])) {$lg_host_user=$_POST['loginHostUser'];}
if(isset($_POST['loginHostPw'])) {$lg_host_pw=$_POST['loginHostPw'];}
$port_err=0;
$loginstatus=false;
$hoststatus=false;

if($serverhost===true)
	{
	if($lg_host_user==$hostusername AND $lg_host_pw==$hostpassword)
		{
		$hoststatus=true;
		$_SESSION['loggedhost']=true;
		$_SESSION['userip']=$uip;
		}
	if(isset($_SESSION['loggedhost']) AND $_SESSION['loggedhost']===true AND $_SESSION['userip']==$uip)
		{
		$hoststatus=true;
		}
		elseif(isset($_SESSION['loggedhost']) AND $_SESSION['loggedhost']===true AND $_SESSION['userip']!=$uip)
		{
		$loginstatus=false;
		$hoststatus=false;
		$ts3->logout();
		session_destroy();
		}
	if($hoststatus===false AND isset($lg_port) AND empty($lg_port))
		{
		$port_err++;
		}
	}

if(!empty($lg_user) AND !empty($lg_pw) AND empty($port_err))
	{
	if($ts3->getElement('success', $ts3->login($lg_user, $lg_pw))===true)
		{
		$loginstatus=true;
		$_SESSION['logged']=true;
		$_SESSION['userip']=$uip;
		$_SESSION['loginuser']=$lg_user;
		$_SESSION['loginpw']=base64_encode(serialize($lg_pw));
		if($serverhost===true AND $hoststatus===false)
			{
			$_SESSION['loginport']=$lg_port;
			}
		}
	}


if(isset($_SESSION['logged']) AND $_SESSION['logged']===true AND $_SESSION['userip']==$uip AND $serverstatus===true)
	{
	if($ts3->getElement('success', $ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw']))))===false)
		{
		$loginstatus=false;
		$hoststatus=false;
		$ts3->logout();
		session_destroy();
		}
		else
		{
		$loginstatus=true;
		}
	}
	
if(isset($_SESSION['logged']) AND $_SESSION['logged']===true AND $_SESSION['userip']!=$uip)
	{
	$loginstatus=false;
	$hoststatus=false;
	$ts3->logout();
	session_destroy();
	}
	
if($site=='logout' AND $loginstatus===true)
	{
	$hoststatus=false;
	$loginstatus=false;
	$ts3->logout();
	session_destroy();
	}
?>