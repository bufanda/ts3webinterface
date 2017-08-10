{if !empty($error) OR !empty($noerror)}
<table>
	{if !empty($error)}
	<tr>
		<td class="error">{$error}</td>
	</tr>
	{/if}
	{if !empty($noerror)}
	<tr>
		<td class="noerror">{$noerror}</td>
	</tr>
	{/if}
</table>
{/if}
<form enctype="multipart/form-data" action="index.php?site=fileupload&amp;port={$port}" method="post">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="2">{$lang['iconupload']}</td>
	</tr>
	<tr>
		<td class="green1" colspan="2">{$lang['iconupinfo']}</td>
	</tr>
	<tr>
		<td class="green2" colspan="2">
		<input type="hidden" name="max_file_size" value="81920" />
		{$lang['iconupload']}: <input name="thefile" type="file" />
		
		</td>
	</tr>
	<tr>
		<td class="green1"  style="width:75px">{$lang['option']}</td>
		<td class="green1"  align="left"><input type="submit" name="upload" value="{$lang['iconupload']}" /></td>
	</tr>
</table>
</form>