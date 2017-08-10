<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
$newwiversion=check_wi_version($wiversion, $wiversionurl);
if($loginstatus===true AND $newwiversion!==true)
	{?>
	<tr>
		<td class="green1 warning center" colspan="2">
		<?php echo $lang['wiupdateav'].$newwiversion; ?>
		</td>
	<tr>
<?php } ?>