{if isset($permoverview['b_virtualserver_channel_list']) AND empty($permoverview['b_virtualserver_channel_list'])}

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
		<td class="thead" colspan="4">{$lang['channel']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['id']}</td>
		<td class="thead">{$lang['pid']}</td>
		<td class="thead">{$lang['name']}</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
{if !empty($channellist)}
	{foreach key=key item=value from=$channellist}
	{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
		<tr>
			<td class="{$td_col} center">{$value['cid']}</td>
			<td class="{$td_col} center">{$value['pid']}</td>
			<td class="{$td_col} center">{$value['channel_name']}</td>
			<td class="{$td_col} center">
		<div class="action-buttons">
		<form method="post" action="index.php?site=channelview&amp;sid={$sid}&amp;cid={$value['cid']}">
		<button type="submit" class="btn-icon" name="select" title="{$lang['select']}">
			<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
		</button>
		</form>
		<a href="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$value['cid']}" class="btn-icon" title="{$lang['edit']}">
			<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
		</a>
		<form method="post" action="index.php?site=channeleditperm&amp;sid={$sid}&amp;cid={$value['cid']}">
		<button type="submit" class="btn-icon" name="editperms" title="{$lang['editperms']}">
			<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
		</button>
		</form>
		<form method="post" action="index.php?site=channel&amp;sid={$sid}">
		<input type="hidden" name="cid" value="{$value['cid']}" />
		{if $value['total_clients'] > 0}
			<input type="hidden" name="force" value="1" />
		{/if}
		{if !isset($permoverview['b_channel_delete_permanent']) AND $value['channel_flag_permanent'] == 1 OR $permoverview['b_channel_delete_permanent'] == 1 AND $value['channel_flag_permanent'] == 1}
			{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
				<button type="submit" class="btn-icon btn-danger-icon" name="delete" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
			{/if}
		{/if}
		{if !isset($permoverview['b_channel_delete_semi_permanent']) AND $value['channel_flag_semi_permanent'] == 1 OR $permoverview['b_channel_delete_semi_permanent'] == 1 AND $value['channel_flag_semi_permanent'] == 1}
			{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
				<button type="submit" class="btn-icon btn-danger-icon" name="delete" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
			{/if}
		{/if}
		{if !isset($permoverview['b_channel_delete_temporary']) AND $value['channel_flag_permanent'] == 0 AND $value['channel_flag_semi_permanent'] == 0 OR $permoverview['b_channel_delete_temporary'] == 1 AND $value['channel_flag_permanent'] == 0 AND $value['channel_flag_semi_permanent'] == 0}
			{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
				<button type="submit" class="btn-icon btn-danger-icon" name="delete" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
			{/if}
		{/if}
		</form>
		</div>
			</td>
		</tr>
		{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{/if}
</table>
{/if}