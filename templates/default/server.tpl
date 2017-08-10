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
<form method="post" action="index.php?site=server">
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="7">{$lang['msgtoall']}</td>
	</tr>
	<tr>
		<td class="green1"><input style="width:830px" type="text" name="msgtoall" size="100" value=""/></td>
		<td class="green1"><input style="width:60px" class="button" type="submit" name="sendmsg" value="{$lang['send']}" /></td>
	</tr>
</table>
</form>
<br />
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="7" class="thead">{$lang['server']}</td>
	</tr>

	{if !empty($serverlist)}

	<tr>
		<td colspan="7">{$serverstats}</td>
	</tr>
	{/if}
	<tr>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=id&amp;sorttype={if $sortby == 'virtualserver_id' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['id']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=name&amp;sorttype={if $sortby == 'virtualserver_name' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['name']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=port&amp;sorttype={if $sortby == 'virtualserver_port' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['port']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=status&amp;sorttype={if $sortby == 'virtualserver_status' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['status']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=uptime&amp;sorttype={if $sortby == 'virtualserver_uptime' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['runtime']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=clients&amp;sorttype={if $sortby == 'virtualserver_clientsonline' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['clients']}</a></td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if !empty($serverlist)}
		{foreach key=key item=value from=$serverlist}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['virtualserver_id']}</td>
				<td class="{$td_col} center"><a href="index.php?site=serverview&amp;port={$value['virtualserver_port']}">{$value['virtualserver_name']}</a></td>
				<td class="{$td_col} center">{$value['virtualserver_port']}</td>
				<td class="{$td_col} center">
				{if $value['virtualserver_status'] == "online"}
				<span class="online">{$lang['online']}</span>
				{else}
				<span class="offline">{$lang['offline']}</span>
				{/if}
				</td>
				<td class="{$td_col} center">{$value['virtualserver_uptime']}</td>
				<td class="{$td_col} center">{$value['virtualserver_clientsonline']} / {$value['virtualserver_maxclients']}</td>
				<td class="{$td_col} center">
				<form method="post" action="index.php?site=server&amp;action=start">
				<input type="hidden" name="sid" value="{$value['virtualserver_id']}" />
				<input class="start" type="submit" name="start" value="" title="{$lang['start']}" />
				</form>
				<form method="post" action="index.php?site=server&amp;action=stop">
				<input type="hidden" name="sid" value="{$value['virtualserver_id']}" />
				<input class="stop" type="submit" name="stop" value="" onclick="return confirm('{$lang['stopservermsg']}')" title="{$lang['stop']}" />
				</form>
				<form method="post" action="index.php?site=serverview&amp;port={$value['virtualserver_port']}">
				<input class="select" type="submit" name="edit" value="" title="{$lang['select']}" />
				</form>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<form method="post" action="index.php?site=server&amp;action=del">
				<input type="hidden" name="sid" value="{$value['virtualserver_id']}" />
				<input class="delete" type="submit" name="del" value="" onclick="return confirm('{$lang['deletemsgserver']}')" title="{$lang['delete']}" />
				</form>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{else}
	<tr><td class='green1' colspan='7'>{$lang['noserver']}</td></tr>
	{/if}
</table>
{/if}