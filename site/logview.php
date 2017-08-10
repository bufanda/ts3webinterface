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

$yearx=date("Y");


$limit=500;

$comparator='';
$settime='';

if(isset($_POST['getfilter']))
	{
	if(empty($_POST['limit']))
		{
		$limit=500;
		}
	elseif($_POST['limit']<1)
		{
		$limit=1;
		}
	elseif($_POST['limit']>500)
		{
		$limit=500;
		}
	else
		{
		$limit=$_POST['limit'];
		}
		
	if(!empty($_POST['day']) or !empty($_POST['month']) or !empty($_POST['year']) or !empty($_POST['hour']) or !empty($_POST['min']) or !empty($_POST['sec']))
		{
		$settime=mktime((int)$_POST['hour'],(int)$_POST['min'],(int)$_POST['sec'],(int)$_POST['month'],(int)$_POST['day'],(int)$_POST['year']);
		}
		else
		{
		$settime='';
		}
		
	if(!empty($_POST['comparator']))
		{
		$comparator=$_POST['comparator'];
		}
		else
		{
		$comparator='';
		}
	}

$serverlog=$ts3->getElement('data', $ts3->logView($limit, $comparator, $settime));
if(!empty($serverlog))
	{
	foreach($serverlog AS $key=>$value)
		{
		$serverlog[$key]=secure($serverlog[$key]);
		}
	}
$smarty->assign("serverlog", $serverlog);
$smarty->assign("yearx", $yearx);
?>
