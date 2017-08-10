<?php /* Smarty version Smarty3rc4, created on 2016-06-27 21:41:13
         compiled from "E:\xampp_php7\htdocs\test\templates/new/mainbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59905771815966ce29-15346047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b79cbccf450c7c94591b0b3ff076479b7a372f1' => 
    array (
      0 => 'E:\\xampp_php7\\htdocs\\test\\templates/new/mainbar.tpl',
      1 => 1467056337,
    ),
  ),
  'nocache_hash' => '59905771815966ce29-15346047',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loginstatus')->value===true&&$_smarty_tpl->getVariable('site')->value!=='login'){?>
<td style="width:100px" >
<table style="width:100px" class="border" cellpadding="1" cellspacing="0">
	<tr><td style="width:100px" class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['server'];?>
</td></tr>
	<?php if ($_smarty_tpl->getVariable('hoststatus')->value===true){?>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=server"><?php echo $_smarty_tpl->getVariable('lang')->value['serverlist'];?>
</a></td></tr>
	<?php }?>
	<?php if (!isset($_smarty_tpl->getVariable('sid')->value)&&$_smarty_tpl->getVariable('hoststatus')->value===true){?>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createserver"><?php echo $_smarty_tpl->getVariable('lang')->value['createserver'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic"><?php echo $_smarty_tpl->getVariable('lang')->value['instancetraffic'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=instanceedit"><?php echo $_smarty_tpl->getVariable('lang')->value['instanceedit'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=logview"><?php echo $_smarty_tpl->getVariable('lang')->value['logview'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=iserverbackup"><?php echo $_smarty_tpl->getVariable('lang')->value['instancebackup'];?>
</a></td></tr>
		<?php }?>
	<?php if (isset($_smarty_tpl->getVariable('sid')->value)){?>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serverview&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['serverview'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['virtualtraffic'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serveredit&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['serveredit'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=temppw&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['temppw'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=fileupload&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['iconupload'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=logview&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['logview'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=filelist&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['filelist'];?>
</a></td></tr>				
		<tr><td class="green1"><a class="mainbarlink" href="javascript:oeffnefenster('site/interactive.php?sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
&amp;action=action');"><?php echo $_smarty_tpl->getVariable('lang')->value['massaction'];?>
</a></td></tr>
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['channel'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channel&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['channellist'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createchannel&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['createchannel'];?>
</a></td></tr>
		<?php if (isset($_smarty_tpl->getVariable('cid')->value)){?>
			<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channelview&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
&amp;cid=<?php echo $_smarty_tpl->getVariable('cid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['channelview'];?>
</a></td></tr>
			<tr><td class="green2"><a class="mainbarlink" href="index.php?site=channeledit&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
&amp;cid=<?php echo $_smarty_tpl->getVariable('cid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['channeledit'];?>
</a></td></tr>
		<?php }?>
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['clients'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=counter&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['clientcounter'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=clients&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['clientlist'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=complainlist&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['complainlist'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=chanclienteditperm&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['chanclientperms'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=clientcleaner&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['clientcleaner'];?>
</a></td></tr>		
		
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['bans'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=banlist&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['banlist'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=banadd&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['addban'];?>
</a></td></tr>
		
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['groups'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=sgroups&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['servergroups'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=sgroupadd&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['addservergroup'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=cgroups&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['channelgroups'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=cgroupadd&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['addchannelgroup'];?>
</a></td></tr>
		
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['token'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=token&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['token'];?>
</a></td></tr>
		
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['backup'];?>
</td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=backup&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['chanbackups'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=serverbackup&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['serverbackups'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=permexport&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['permexport'];?>
</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=clientsexport&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['clientsexport'];?>
</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=bansexport&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['bansexport'];?>
</a></td></tr>
		
		<tr><td class="maincat"><?php echo $_smarty_tpl->getVariable('lang')->value['console'];?>
</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=console&amp;sid=<?php echo $_smarty_tpl->getVariable('sid')->value;?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['queryconsole'];?>
</a></td></tr>
		<?php }?>
</table>
</td>
<?php }?>