<?php /* Smarty version Smarty3rc4, created on 2016-06-27 21:41:13
         compiled from "E:\xampp_php7\htdocs\test\templates/new/showupdate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9615771815965bae9-95041757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c834596e23b0f6ab4fae8228f21e0da469b2255e' => 
    array (
      0 => 'E:\\xampp_php7\\htdocs\\test\\templates/new/showupdate.tpl',
      1 => 1467056337,
    ),
  ),
  'nocache_hash' => '9615771815965bae9-95041757',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('newwiversion')->value)){?>
<tr>
	<td class="green1 warning center" colspan="2">
	<?php echo $_smarty_tpl->getVariable('newwiversion')->value;?>

	</td>
<tr>
<?php }?>