{if isset($permoverview['b_virtualserver_log_view']) AND empty($permoverview['b_virtualserver_log_view'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<form method="post" action="index.php?site=logview{if !empty($port)}&amp;port={$port}{/if}">
<table class="border" style="width:90%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="thead" colspan="4">{$lang['filter']}</td>
	</tr>
	<tr>
		<td class="green1" colspan="4">
		{$lang['limit']} (1-500):<input type="text" maxlength="3" size="1" name="limit" value="{if isset($smarty.post.limit)}{$smarty.post.limit}{/if}" />
		</td>
	</tr>
	<tr>
		<td class="green1" colspan="4">
		{$lang['error']}:
		<input type="checkbox" {if isset($smarty.post.type.error) AND $smarty.post.type.error == 1}checked="checked"{/if} name="type[error]" value="1" />
		{$lang['warning']}:
		<input type="checkbox" {if isset($smarty.post.type.warning) AND $smarty.post.type.warning == 2}checked="checked"{/if} name="type[warning]" value="2" />
		{$lang['debug']}:
		<input type="checkbox" {if isset($smarty.post.type.debug) AND $smarty.post.type.debug == 3}checked="checked"{/if} name="type[debug]" value="3" />
		{$lang['info']}:
		<input type="checkbox" {if isset($smarty.post.type.info) AND $smarty.post.type.info == 4}checked="checked"{/if} name="type[info]" value="4" /><br />
		</td>
	</tr>
	<tr>
		<td class="green1" colspan="4">
		{$lang['comparator']}: <select name="comparator">
			<option value="" {if isset($smarty.post.comparator) AND empty($smarty.post.comparator)}selected="selected"{/if}>-</option>
			<option value="<" {if isset($smarty.post.comparator) AND $smarty.post.comparator == '<'}selected="selected"{/if}>Before</option>
			<option value="=" {if isset($smarty.post.comparator) AND $smarty.post.comparator == '='}selected="selected"{/if}>Exactly</option>
			<option value=">" {if isset($smarty.post.comparator) AND $smarty.post.comparator == '>'}selected="selected"{/if}>Later</option>
			</select>
		{$lang['like']} 
		{$lang['date']} 
			<select name="day">
			<option value="">-</option>
			{section name=days start=1 loop=32 step=1}
				<option {if $smarty.post.day == $smarty.section.days.index}selected="selected"{/if} value="{$smarty.section.days.index}">{$smarty.section.days.index}</option>
			{/section}
			</select>
		    .<select name="month">
			<option value="">-</option>
			{section name=months start=1 loop=13 step=1}
				<option {if $smarty.post.month == $smarty.section.months.index}selected="selected"{/if} value="{$smarty.section.months.index}">{$smarty.section.months.index}</option>
			{/section}
			</select>
		    .<select name="year">
			<option value="">-</option>
			{section name=years start=1990 loop=$yearx+1 step=1}
				<option {if $smarty.post.year == $smarty.section.years.index}selected="selected"{/if} value="{$smarty.section.years.index}">{$smarty.section.years.index}</option>
			{/section}
			</select>
			- {$lang['time']}
		    <select name="hour">
			<option value="">-</option>
			{section name=hours start=0 loop=25 step=1}
				<option {if $smarty.post.hour == $smarty.section.hours.index AND $smarty.post.hour!=''}selected="selected"{/if} value="{$smarty.section.hours.index}">{$smarty.section.hours.index}</option>
			{/section}
			</select>
			:<select name="min">
			<option value="">-</option>
			{section name=mins start=0 loop=61 step=1}
				<option {if $smarty.post.min == $smarty.section.mins.index AND $smarty.post.min!=''}selected="selected"{/if} value="{$smarty.section.mins.index}">{$smarty.section.mins.index}</option>
			{/section}
			</select>
			:<select name="sec">
			<option value="">-</option>
			{section name=secs start=0 loop=61 step=1}
				<option {if $smarty.post.sec == $smarty.section.secs.index AND $smarty.post.sec!=''}selected="selected"{/if} value="{$smarty.section.secs.index}">{$smarty.section.secs.index}</option>
			{/section}
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="4"> 
			<input type="submit" name="getfilter" value="Search" />
		</td>
	</tr>
</table>
</form>
<br />
<table class="border" style="width:90%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="width:20%" class="thead">{$lang['date']}</td>
		<td style="width:5%" class="thead">{$lang['level']}</td>
		<td style="width:20%" class="thead">{$lang['channel']}</td>
		<td style="width:55%" class="thead">{$lang['message']}</td>
	</tr>

{if !empty($serverlog)}
	{foreach key=key item=value from=$serverlog}
		{if empty($smarty.post.type.error) AND empty($smarty.post.type.warning) AND empty($smarty.post.type.debug) AND empty($smarty.post.type.info) OR $smarty.post.type.error == $value['level'] OR $smarty.post.type.warning == $value['level'] OR $smarty.post.type.debug == $value['level'] OR $smarty.post.type.info == $value['level']}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col}">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
				<td class="{$td_col}">{$value['level']}</td>
				<td class="{$td_col}">{$value['channel']}</td>
				<td class="{$td_col}">{$value['msg']}</td>
			</tr>
		
			{assign var=change_col value="`$change_col+1`"}
		{/if}
	{/foreach}
{/if}
</table>
{/if}