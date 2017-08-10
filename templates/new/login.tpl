{if !empty($error)}
<table>
	<tr>
		<td class="error">{$error}</td>
	</tr>
</table>
{/if}
{if !empty($motd)}
<table cellpadding="0" cellspacing="0">
	<tr>
		<td class="logintop login"></td>
	</tr>
	<tr>
		<td class="loginpuff loginhead">{$lang['motd']}</td>
	</tr>
	<tr>
		<td class="loginpuff" align="center">
		{$motd}
		</td>
	</tr>
	<tr>
		<td class="loginbottom">&nbsp;</td>
	</tr>
</table>
{/if}
{if !isset($smarty.post.sendlogin) AND $loginstatus !== true OR $loginstatus !== true}
<form method="post" action="index.php?site=login">
<table cellpadding="0" cellspacing="0">
	<tr>
		<td class="logintop" colspan="2"></td>
	</tr>
	<tr>
		<td class="loginpuff loginhead" colspan="2">{$lang['login']}</td>
	</tr>
	<tr>
		<td class="loginpuff" align="center">
		<table style="padding:10px;" cellpadding="1" cellspacing="0">
			<tr>
				<td class="login">{$lang['server']}:</td>
				<td>
				{if count($instances) == 1}
					{foreach key=skey item=sdata from=$instances}
					<input type="hidden" name="skey" value="{$skey}" />	{$sdata['alias']} 
					{/foreach}
				{else}
				<select name="skey">
				{foreach key=skey item=sdata from=$instances}
				<option value="{$skey}">{$sdata['alias']}</option>	
				{/foreach}
				</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="login">{$lang['username']}:</td>
				<td class="login"><input type="text" name="loginUser" value="serveradmin" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['password']}:</td>
				<td class="login"><input type="password" name="loginPw" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['option']}:</td>
				<td><input class="button" type="submit" name="sendlogin" value="{$lang['login']}"/></td>
			</tr>
		</table>
		
		</td>
	</tr>
	<tr>
		<td class="loginbottom">&nbsp;</td>
	</tr>
</table>
</form>
{/if}