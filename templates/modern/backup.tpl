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
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="center" colspan="3" style="font-size:12px;">{$lang['chanbackdesc']}</td>
	</tr>
	<tr>
		<td class="thead" colspan="3">{$lang['chanbackups']}</td>
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
				<td class="{$td_col} center options-col">
				<div class="action-buttons">
				<button type="button" class="btn-icon" title="{$lang['view']}" onClick="oeffnefenster('site/chanbackupview.php?backupid={$value['timestamp']}&amp;fileport={$value['server']}');">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
				</button>
				<form method="post" action="index.php?site=backup&amp;sid={$sid}">
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<button type="submit" name="deploy" class="btn-icon btn-success-icon" title="{$lang['deploy']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="5 12 12 5 19 12"></polyline><line x1="12" y1="19" x2="12" y2="5"></line></svg>
				</button>
				</form>
				<form method="post" action="index.php?site=backup&amp;sid={$sid}">
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<button type="submit" name="delete" class="btn-icon btn-danger-icon" title="{$lang['delete']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
				</form>
				</div>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/if}
	{/foreach}	
{/if}
</table>
{if $serverhost == true AND $hoststatus == true OR $serverhost == false}
	<br />
	<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead" colspan="3">{$lang['host']} {$lang['chanbackups']}</td>
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
				<td class="{$td_col} center options-col">
				<div class="action-buttons">
				<button type="button" class="btn-icon" title="{$lang['view']}" onClick="oeffnefenster('site/chanbackupview.php?backupid={$value['timestamp']}&amp;fileport={$value['server']}&amp;hostbackup=1');">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
				</button>
				<form method="post" action="index.php?site=backup&amp;sid={$sid}">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<button type="submit" name="deploy" class="btn-icon btn-success-icon" title="{$lang['deploy']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="5 12 12 5 19 12"></polyline><line x1="12" y1="19" x2="12" y2="5"></line></svg>
				</button>
				</form>
				<form method="post" action="index.php?site=backup&amp;sid={$sid}">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="{$value['timestamp']}" />
				<input type="hidden" name="fileport" value="{$value['server']}" />
				<button type="submit" name="delete" class="btn-icon btn-danger-icon" title="{$lang['delete']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
				</form>
				</div>
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
	<td class="thead">{$lang['createchanbackup']}</td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=backup&amp;sid={$sid}">
	<input class="button" type="submit" name="create" value="{$lang['create']}" />
	</form>
{if $serverhost == true AND $hoststatus == true OR $serverhost == false}
	<form method="post" action="index.php?site=backup&amp;sid={$sid}">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="{$lang['host']} {$lang['create']}" />
	</form>
{/if}
	</td>
</tr>
</table>