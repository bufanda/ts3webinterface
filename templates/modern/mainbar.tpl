<nav class="sidebar-nav">
{if $hoststatus === true OR $loginstatus === true}
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['server']}</h3>
		<ul>
			{if $hoststatus}
				<li><a href="index.php?site=server">{$lang['serverlist']}</a></li>
			{/if}
			{if !isset($sid) && $hoststatus}
				<li><a href="index.php?site=createserver">{$lang['createserver']}</a></li>
				<li><a href="index.php?site=servertraffic">{$lang['instancetraffic']}</a></li>
				<li><a href="index.php?site=instanceedit">{$lang['instanceedit']}</a></li>
				<li><a href="index.php?site=logview">{$lang['logview']}</a></li>
				<li><a href="index.php?site=iserverbackup">{$lang['instancebackup']}</a></li>
			{/if}
			{if isset($sid)}
				<li><a href="index.php?site=serverview&amp;sid={$sid}">{$lang['serverview']}</a></li>
				<li><a href="index.php?site=servertraffic&amp;sid={$sid}">{$lang['virtualtraffic']}</a></li>
				<li><a href="index.php?site=serveredit&amp;sid={$sid}">{$lang['serveredit']}</a></li>
				<li><a href="index.php?site=temppw&amp;sid={$sid}">{$lang['temppw']}</a></li>
				<li><a href="index.php?site=fileupload&amp;sid={$sid}">{$lang['iconupload']}</a></li>
				<li><a href="index.php?site=logview&amp;sid={$sid}">{$lang['logview']}</a></li>
				<li><a href="index.php?site=filelist&amp;sid={$sid}">{$lang['filelist']}</a></li>				
				<li><a href="javascript:oeffnefenster('site/interactive.php?sid={$sid}&amp;action=action');">{$lang['massaction']}</a></li>
			{/if}
		</ul>
	</div>

	{if isset($sid)}
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['channel']}</h3>
		<ul>
			<li><a href="index.php?site=channel&amp;sid={$sid}">{$lang['channellist']}</a></li>
			<li><a href="index.php?site=createchannel&amp;sid={$sid}">{$lang['createchannel']}</a></li>
			{if isset($cid)}
				<li><a href="index.php?site=channelview&amp;sid={$sid}&amp;cid={$cid}">{$lang['channelview']}</a></li>
				<li><a href="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">{$lang['channeledit']}</a></li>
			{/if}
		</ul>
	</div>

	<div class="nav-section">
		<h3 class="nav-heading">{$lang['clients']}</h3>
		<ul>
			<li><a href="index.php?site=counter&amp;sid={$sid}">{$lang['clientcounter']}</a></li>
			<li><a href="index.php?site=clients&amp;sid={$sid}">{$lang['clientlist']}</a></li>
			<li><a href="index.php?site=complainlist&amp;sid={$sid}">{$lang['complainlist']}</a></li>
			<li><a href="index.php?site=chanclienteditperm&amp;sid={$sid}">{$lang['chanclientperms']}</a></li>
			<li><a href="index.php?site=clientcleaner&amp;sid={$sid}">{$lang['clientcleaner']}</a></li>		
		</ul>
	</div>
	
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['bans']}</h3>
		<ul>
			<li><a href="index.php?site=banlist&amp;sid={$sid}">{$lang['banlist']}</a></li>
			<li><a href="index.php?site=banadd&amp;sid={$sid}">{$lang['addban']}</a></li>
		</ul>
	</div>
	
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['groups']}</h3>
		<ul>
			<li><a href="index.php?site=sgroups&amp;sid={$sid}">{$lang['servergroups']}</a></li>
			<li><a href="index.php?site=sgroupadd&amp;sid={$sid}">{$lang['addservergroup']}</a></li>
			<li><a href="index.php?site=cgroups&amp;sid={$sid}">{$lang['channelgroups']}</a></li>
			<li><a href="index.php?site=cgroupadd&amp;sid={$sid}">{$lang['addchannelgroup']}</a></li>
		</ul>
	</div>
	
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['token']}</h3>
		<ul>
			<li><a href="index.php?site=token&amp;sid={$sid}">{$lang['token']}</a></li>
		</ul>
	</div>
	
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['backup']}</h3>
		<ul>
			<li><a href="index.php?site=backup&amp;sid={$sid}">{$lang['chanbackups']}</a></li>
			<li><a href="index.php?site=serverbackup&amp;sid={$sid}">{$lang['serverbackups']}</a></li>
			<li><a href="index.php?site=permexport&amp;sid={$sid}">{$lang['permexport']}</a></li>
			<li><a href="index.php?site=clientsexport&amp;sid={$sid}">{$lang['clientsexport']}</a></li>
			<li><a href="index.php?site=bansexport&amp;sid={$sid}">{$lang['bansexport']}</a></li>
		</ul>
	</div>
	
	<div class="nav-section">
		<h3 class="nav-heading">{$lang['console']}</h3>
		<ul>
			<li><a href="index.php?site=console&amp;sid={$sid}">{$lang['queryconsole']}</a></li>
		</ul>
	</div>
	{/if}

	{if $hoststatus === true OR isset($sid)}
	<div class="nav-section">
		<h3 class="nav-heading">Geo Map</h3>
		<ul>
			<li><a href="index.php?site=geo{if isset($sid)}&amp;sid={$sid}{/if}" style="color: #ef4444; font-weight: 500;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: text-bottom; margin-right: 4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                Geo
            </a></li>
		</ul>
	</div>
	{/if}
{else}
	{if !empty($motd)}
	<div class="nav-section" style="padding: 1.5rem 1rem; color: var(--text-color); font-size: 0.9rem; line-height: 1.6;">
		{$motd}
	</div>
	{/if}
{/if}

	<div class="nav-section" style="padding: 1.5rem 1rem; text-align: center; border-top: 1px solid var(--border-color); margin-top: auto;">
		<a href="https://www.ts-rent.de/ts3-webinterface/index.php" class="button" style="display: block; margin-bottom: 1rem;" target="_blank" rel="noopener noreferrer">
			Download
		</a>
		<a href="https://www.ts-rent.de/update/" target="_blank" rel="noopener noreferrer" style="display: inline-block;">
			<img src="https://www.paypalobjects.com/en_US/DK/i/btn/btn_donateCC_LG.gif" border="0" title="Spenden (PayPal)" alt="Spenden (PayPal)" />
		</a>
	</div>
</nav>