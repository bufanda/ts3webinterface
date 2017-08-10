<table border="0" style="width:1000px; height:100px" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td class="header">
		<table style="width:100%">
			<tr>
				<td>
				{if $fastswitch == true}
					<form method="get" action="index.php?site=serverview">
					{if strpos($site, 'edit') == false OR $site == serveredit}
					<input type="hidden" name="site" value="{$site}" />
					{else}
					<input type="hidden" name="site" value="serverview" />
					{/if}
					<select name="port" onchange="submit()">
					{foreach key=key item=server from=$serverlist}
						{if $port == $server['virtualserver_port']}
						<option selected="selected" value="{$server['virtualserver_port']}">{$server['virtualserver_name']}-{$server['virtualserver_port']}</option>
						{else}
						<option value="{$server['virtualserver_port']}">{$server['virtualserver_name']}-{$server['virtualserver_port']}</option>
						{/if}
					{/foreach}
					</select>
					</form>
				{/if}
				</td>
				<td style="text-align:right">
				{if $loginstatus === true}
					{$smarty.session.loginuser} <a href="index.php?site=logout">{$lang['logout']}</a>
				{/if}
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>