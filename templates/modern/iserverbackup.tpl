{if $hoststatus === false AND $serverhost === true}
<table>
	<tr>
		<td class="error">{$lang['nohoster']}</td>
	</tr>
</table>
{else}
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
<table class="border" style="width:90%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="4">Instanz Server Backups</td>
	</tr>
	<tr>
		<td style="font-size:12px" colspan="3">{$lang['servbackdesc']}</td>
	</tr>
	<tr>
		<td class="warning" style="font-size:12px" colspan="3">{$lang['snapwarning']}</td>
	</tr>
	<tr>
		<td class="thead" colspan="4">{$lang['serverbackups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['server']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if isset($files[0]) AND !empty($files[0]) OR isset($folder[2]) AND !empty($folder[2])}
		{if !isset($smarty.post.backupdate)}
			{foreach key=key item=value from=$folder[2]}
				{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value}</td>
				<td colspan="2" class="{$td_col} center options-col">
				<div class="action-buttons">
				<form method="post" action="index.php?site=iserverbackup">
				<input type="hidden" name="backupdate" value="{$value}" />
				<button type="submit" name="chose" class="btn-icon" title="Auswählen">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
				</button>
				</form>
				</div>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
		{else}
			{if	isset($files[0])}
			{foreach key=key item=value from=$files[0]}
				{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
				<tr>
					<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
					<td class="{$td_col} center">{$value['server']}</td>
					<td class="{$td_col} center options-col">
					<div class="action-buttons" style="flex-wrap: wrap;">
					<form method="post" action="index.php?site=iserverbackup">
					<select name="deployon" class="glass-select" style="padding:0.2rem 1rem 0.2rem 0.5rem; height: 28px; font-size: 0.8rem; margin-right: 0.2rem;">
					<option value="">-</option>
					{if !empty($serverlist)}
						{foreach key=key2 item=value2 from=$serverlist}
							<option value="{$value2['virtualserver_port']}">{$value2['virtualserver_name']}:{$value2['virtualserver_port']}</option>
						{/foreach}
					{/if}
					</select>
					<input type="hidden" name="backupid" value="{$value['timestamp']}" />
					<input type="hidden" name="fileport" value="{$value['server']}" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
					<button type="submit" name="deploy" class="btn-icon btn-success-icon" title="{$lang['deploy']}">
						<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="5 12 12 5 19 12"></polyline><line x1="12" y1="19" x2="12" y2="5"></line></svg>
					</button>
					</form>
					<form method="post" action="index.php?site=iserverbackup">
					<input type="hidden" name="backupid" value="{$value['timestamp']}" />
					<input type="hidden" name="fileport" value="{$value['server']}" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
					<button type="submit" name="delete" class="btn-icon btn-danger-icon" title="{$lang['delete']}">
						<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
					</button>
					</form>
					</div>
					</td>
				</tr>
				{assign var=change_col value="`$change_col+1`"}
			{/foreach}	
			{else}
			<tr>
				<td colspan="3" class="green1 center">No Backups found!</td>
			</tr>
			{/if}
		{/if}
	{else}
		<tr>
			<td colspan="3" class="green1 center">No Backups found!</td>
		</tr>
	{/if}
</table>
<br />
<table class="border" style="width:90%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="4">{$lang['host']} {$lang['serverbackups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['server']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
{if isset($files[1]) AND !empty($files[1]) OR isset($folder[1]) AND !empty($folder[1])}
	{if !isset($smarty.post.backupdate)}
		{foreach key=key item=value from=$folder.1}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
		<tr>
			<td class="{$td_col} center">{$value}</td>
			<td colspan="2" class="{$td_col} center options-col">
			<div class="action-buttons">
			<form method="post" action="index.php?site=iserverbackup">
			<input type="hidden" name="backupdate" value="{$value}" />
			<button type="submit" name="chose" class="btn-icon" title="Auswählen">
				<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
			</button>
			</form>
			</div>
			</td>
		</tr>
		{assign var=change_col value="`$change_col+1`"}
	{/foreach}
	{else}
		{if	isset($files[1])}
			{foreach key=key item=value from=$files[1]}
				{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
				<tr>
					<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
					<td class="{$td_col} center">{$value['server']}</td>
					<td class="{$td_col} center options-col">
					<div class="action-buttons" style="flex-wrap: wrap;">
					<form method="post" action="index.php?site=iserverbackup">
					<select name="deployon" class="glass-select" style="padding:0.2rem 1rem 0.2rem 0.5rem; height: 28px; font-size: 0.8rem; margin-right: 0.2rem;">
					<option value="">-</option>
					{if !empty($serverlist)}
						{foreach key=key2 item=value2 from=$serverlist}
							<option value="{$value2['virtualserver_port']}">{$value2['virtualserver_name']}:{$value2['virtualserver_port']}</option>
						{/foreach}
					{/if}
					</select>
					<input type="hidden" name="hostbackup" value="1" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
					<input type="hidden" name="backupid" value="{$value['timestamp']}" />
					<input type="hidden" name="fileport" value="{$value['server']}" />
					<button type="submit" name="deploy" class="btn-icon btn-success-icon" title="{$lang['deploy']}">
						<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="5 12 12 5 19 12"></polyline><line x1="12" y1="19" x2="12" y2="5"></line></svg>
					</button>
					</form>
					<form method="post" action="index.php?site=iserverbackup">
					<input type="hidden" name="hostbackup" value="1" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
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
		{else}
			<tr>
				<td colspan="3" class="green1 center">No Backups found!</td>
			</tr>
		{/if}
	{/if}
{else}
	<tr>
		<td colspan="3" class="green1 center">No Backups found!</td>
	</tr>
{/if}
</table>
<br />
<table class="border" cellpadding="1" cellspacing="0">
<tr>
	<td class="thead" colspan="3">{$lang['createserverbackup']}</td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=iserverbackup">
	<input class="button" type="submit" name="create" value="{$lang['create']}" />
	</form>
	</td>
	<td class="green1 center">
	<form method="post" action="index.php?site=iserverbackup">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="{$lang['host']} {$lang['create']}" />
	</td>
</tr>
</table>
{/if}