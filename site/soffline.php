<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} ?>
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead"><?php echo $lang['serveroffline']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['serveroffmsg']; ?></td>
	</tr>
</table>
<?php
session_destroy();