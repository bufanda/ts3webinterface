{if isset($permoverview['b_virtualserver_servergroup_list']) AND empty($permoverview['b_virtualserver_servergroup_list'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
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
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="6">{$lang['servergroups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['id']}</td>
		<td class="thead">{$lang['name']}</td>
		<td class="thead">{$lang['type']}</td>
		<td class="thead">{$lang['iconid']}</td>
		<td class="thead">{$lang['savedb']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if !empty($servergroups)}
		{foreach key=key item=value from=$servergroups}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['sgid']}</td>
				<td class="{$td_col}">
                    <div class="inline-edit-container">
                        <button class="btn-icon btn-inline-edit" title="{$lang['rename']}">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        <span class="item-name">{$value['name']}</span>
                        <form method="post" action="index.php?site=sgroups&amp;sid={$sid}&amp;sgid={$value['sgid']}" class="inline-edit-form">
                            <input type="text" name="name" value="{$value['name']}" />
                            <button type="submit" name="sendname" class="btn-icon btn-success-icon" title="{$lang['rename']}">
                                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </button>
                        </form>
                    </div>
				</td>
				<td class="{$td_col} center">{$value['type']}</td>
				<td class="{$td_col} center">{sprintf('%u', $value['iconid'] & 0xffffffff)}</td>
				<td class="{$td_col} center">{$value['savedb']}</td>
				<td class="{$td_col} center options-col">
				<div class="action-buttons">
				{if $value['type'] != '0'}
				<form method="post" action="index.php?site=sgroupclients&amp;sid={$sid}&amp;sgid={$value['sgid']}">
				<button type="submit" name="groupclients" class="btn-icon" title="{$lang['clients']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
				</button>
				</form>
				{/if}
				<form method="post" action="index.php?site=sgroupeditperm&amp;sid={$sid}&amp;sgid={$value['sgid']}">
				<button type="submit" name="permedit" class="btn-icon" title="{$lang['editperms']}">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
				</button>
				</form>
				{if !isset($permoverview['b_virtualserver_servergroup_delete']) or $permoverview['b_virtualserver_servergroup_delete'] == 1}
				<form method="post" action="index.php?site=sgroups&amp;sid={$sid}&amp;sgid={$value['sgid']}">
				<button type="submit" name="delgroup" class="btn-icon btn-danger-icon" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgservergroup']}')">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
				</form>
				{/if}
				</div>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{/if}
</table>
{/if}