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
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td style="font-size:12px" colspan="3">{$lang['servbackdesc']}</td>
	</tr>
	<tr>
		<td class="warning" style="font-size:12px" colspan="3">{$lang['snapwarning']}</td>
	</tr>
	<tr>
		<td class="thead" colspan="3">{$lang['serverbackups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['server']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
{if isset($files[0]) AND !empty($files[0])}
	{foreach key=key item=value from=$files[0]}
		{if $serverhost === true AND $hoststatus === false AND $value['server'] == $getserverip OR $serverhost === false OR $hoststatus === true}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
				<td class="{$td_col} center">{$value['server']}</td>
				<td class="{$td_col} center">
				<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<input class="start" type="submit" name="deploy" value="" title="{$lang['deploy']}" />
				</form>
				<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<input class="delete" type="submit" name="delete" value="" title="{$lang['delete']}" />
				</form>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/if}
	{/foreach}	
{/if}
</table>
<br />	
{if $serverhost == true AND $hoststatus == true OR $serverhost == false}
	<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead" colspan="3">{$lang['host']} {$lang['serverbackups']}</td>
		</tr>
		<tr>
			<td class="thead">{$lang['created']}</td>
			<td class="thead">{$lang['server']}</td>
			<td class="thead">{$lang['options']}</td>
		</tr>
	{if isset($files[1]) AND !empty($files[1])}
		{foreach key=key item=value from=$files[1]}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
				<td class="{$td_col} center">{$value['server']}</td>
				<td class="{$td_col} center">
				<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<input class="start" type="submit" name="deploy" value="" title="{$lang['deploy']}" />
				</form>
				<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<input class="delete" type="submit" name="delete" value="" title="{$lang['delete']}" />
				</form>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}	
	{/if}
	</table>
{/if}
<br />
<table class="border" cellpadding="1" cellspacing="0">
<tr>
	<td class="thead" colspan="2">{$lang['createserverbackup']}</td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
	<input class="button" type="submit" name="create" value="{$lang['create']}" />
	</form>
	</td>
{if $serverhost==true AND $hoststatus==true OR $serverhost==false}
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;port={$port}">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="{$lang['host']} {$lang['create']}" />
	</form>
	</td>
{/if}
</tr>
</table>