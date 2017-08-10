{if $loginstatus === true AND $site !==login}
<td style="width:100px" >
<table style="width:100px" class="border" cellpadding="1" cellspacing="0">
	<tr><td style="width:100px" class="maincat">{$lang['server']}</td></tr>
	{if $hoststatus === true OR $serverhost == false}
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=server">{$lang['serverlist']}</a></td></tr>
	{/if}
	{if !isset($port) AND $hoststatus === true or !isset($port) AND $serverhost == false}
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createserver">{$lang['createserver']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic">{$lang['instancetraffic']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=instanceedit">{$lang['instanceedit']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=logview">{$lang['logview']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=iserverbackup">{$lang['instancebackup']}</a></td></tr>
		{/if}
	{if isset($port)}
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serverview&amp;port={$port}">{$lang['serverview']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic&amp;port={$port}">{$lang['virtualtraffic']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serveredit&amp;port={$port}">{$lang['serveredit']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=fileupload&amp;port={$port}">{$lang['iconupload']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=logview&amp;port={$port}">{$lang['logview']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=filelist&amp;port={$port}">{$lang['filelist']}</a></td></tr>				
		<tr><td class="maincat">{$lang['channel']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channel&amp;port={$port}">{$lang['channellist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createchannel&amp;port={$port}">{$lang['createchannel']}</a></td></tr>
		{if isset($cid)}
			<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channelview&amp;port={$port}&amp;cid={$cid}">{$lang['channelview']}</a></td></tr>
			<tr><td class="green2"><a class="mainbarlink" href="index.php?site=channeledit&amp;port={$port}&amp;cid={$cid}">{$lang['channeledit']}</a></td></tr>
		{/if}
		<tr><td class="maincat">{$lang['clients']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=counter&amp;port={$port}">{$lang['clientcounter']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=clients&amp;port={$port}">{$lang['clientlist']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=complainlist&amp;port={$port}">{$lang['complainlist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=chanclienteditperm&amp;port={$port}">{$lang['chanclientperms']}</a></td></tr>			
		
		<tr><td class="maincat">{$lang['bans']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=banlist&amp;port={$port}">{$lang['banlist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=banadd&amp;port={$port}">{$lang['addban']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['groups']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=sgroups&amp;port={$port}">{$lang['servergroups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=sgroupadd&amp;port={$port}">{$lang['addservergroup']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=cgroups&amp;port={$port}">{$lang['channelgroups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=cgroupadd&amp;port={$port}">{$lang['addchannelgroup']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['token']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=token&amp;port={$port}">{$lang['token']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['backup']}</td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=backup&amp;port={$port}">{$lang['chanbackups']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=serverbackup&amp;port={$port}">{$lang['serverbackups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=permexport&amp;port={$port}">{$lang['permexport']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=clientsexport&amp;port={$port}">{$lang['clientsexport']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=bansexport&amp;port={$port}">{$lang['bansexport']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['console']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=console&amp;port={$port}">{$lang['queryconsole']}</a></td></tr>
		{/if}
</table>
</td>
{/if}