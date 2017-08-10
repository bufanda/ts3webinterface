<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../templates/default/gfx/style.css" type="text/css" media="screen" />
<title>Webinterface - Interactive</title>
</head>
<body>
<form method="post" name="f1" action="interactive.php?port={$smarty.get.port}&amp;clid={$smarty.get.clid}&amp;nick={$smarty.get.nick}">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2">{$smarty.get.nick}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['select']}:</td>
			<td class="green1">
			<select name="action" onchange="this.form.submit()">
				<option value="">{$lang['select']}</option>
				<option value="kick">{$lang['kick']}</option>
				<option value="ban">{$lang['ban']}</option>
				<option value="poke">{$lang['poke']}</option>
				<option value="move">{$lang['move']}</option>
			</select>
			</td>
		</tr>
	</table>
	</form>
	<br />
{if $smarty.post.action == 'kick'}
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;port={$smarty.get.port}" onsubmit="window.close()">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2">{$lang['kick']} {$smarty.get.nick}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['kickmsg']}:</td>
		<td class="green1"><input type="text" name="kickmsg" value="" /></td>
	<tr>
		<td class="green2">{$lang['option']}:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="{$smarty.get.clid}" />
		<input class="button" type="submit" name="sendkick" value="{$lang['kick']}">
		</td>
	</tr>
</table>
</form>
{/if}

{if $smarty.post.action == 'ban'}
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;port={$smarty.get.port}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2">{$lang['ban']} {$smarty.get.nick}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['banmsg']}:</td>
		<td class="green1">
		<input type="text" name="banmsg" value=""></td>
	<tr>
	<tr>
		<td class="green2">{$lang['bantime']}:</td>
		<td class="green2">
		<input type="text" name="bantime" value="">{$lang['seconds']}</td>
	<tr>
		<td class="green1">{$lang['option']}:</td>
		<td class="green1">
		<input type="hidden" name="clid" value="{$smarty.get.clid}" />
		<input class="button" type="submit" name="sendban" value="{$lang['ban']}" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
{/if}

{if $smarty.post.action == 'poke'}
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;port={$smarty.get.port}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2">{$lang['poke']} {$smarty.get.nick}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['pokemsg']}:</td>
		<td class="green1">
		<input type="text" name="pokemsg" value=""></td>
	<tr>
		<td class="green2">{$lang['option']}:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="{$smarty.get.clid}" />
		<input class="button" type="submit" name="sendpoke" value="{$lang['poke']}" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
{/if}
{if $smarty.post.action=='move'}
<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;port={$smarty.get.port}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="maincat" colspan="2">{$lang['move']} {$_GET['nick']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['move']}:</td>
		<td class="green1">
		<select name="cid">
		{foreach key=key item=value from=$channellist}
			<option value="{$value['cid']}">{$value['channel_name']}</option>";
		{/foreach}
		</select>
		</td>
	<tr>
		<td class="green2">{$lang['option']}:</td>
		<td class="green2">
		<input type="hidden" name="clid" value="{$smarty.get.clid}" />
		<input class="button" type="submit" name="sendmove" value="{$lang['move']}" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
{/if}
</body>
</html>