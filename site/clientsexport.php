<form method="post" action="site/clientsexportaction.php" target="_blank">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead"><?php echo $lang['clientsexport']; ?></td>
	</tr>
	<tr>
		<td><?php echo $lang['clientsexportdesc']; ?></td>
	</tr>
	<tr>
		<td class="green1">
		<?php echo $lang['serverid']; ?>: <input type="text" name="sid" value="" />
		<input type="hidden" name="port" value="<?php echo $port; ?>" />
		<input class="button" type="submit" name="give" value="<?php echo $lang['clientsexport']; ?>" />
		</td>
	</tr>
</table>
</form>