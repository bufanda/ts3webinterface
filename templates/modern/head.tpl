<div class="header-content">
	<div class="header-logo" style="display: flex; align-items: center; gap: 15px;">
		<h1>TeamSpeak Webinterface</h1>
		{if isset($custom_update_available) && $custom_update_available}
        <a href="https://www.ts-rent.de/ts3-webinterface/index.php" target="_blank" rel="noopener noreferrer" class="btn update-blinking-btn" title="Update herunterladen">
            Update verfügbar
        </a>
        {/if}
        <span class="header-date" style="font-size: 0.9rem; opacity: 0.8; font-weight: 500;">{$current_date_de}</span>
	</div>
	
	<div class="header-actions">
		<div class="user-status">
			{if $loginstatus === true}
				{if $hoststatus === true}
					<a href="index.php?site=clearcache" class="btn" style="background-color: var(--danger-color); color: white; padding: 0.3rem 0.8rem; font-size: 0.85rem; border: none; box-shadow: 0 0 8px rgba(239, 68, 68, 0.4); margin-right: 5px;">Cache leeren</a>
				{/if}
				<span class="user-name">{$smarty.session.loginuser}</span>
				<a href="index.php?site=logout" class="btn btn-logout">{$lang['logout']}</a>
			{/if}
		</div>
		
		<div class="server-switch">
			{if $fastswitch == true AND $hoststatus === true}
				<form method="get" action="index.php?site=serverview" class="fastswitch-form">
				{if strpos($site, 'edit') == false OR $site == serveredit}
					<input type="hidden" name="site" value="{$site}" />
				{else}
					<input type="hidden" name="site" value="serverview" />
				{/if}
				<div class="select-wrapper">
					<select name="sid" onchange="submit()" class="glass-select">
					{foreach key=key item=server from=$serverlist}
						{if $sid == $server['virtualserver_id']}
						<option selected="selected" value="{$server['virtualserver_id']}">{$server['virtualserver_name']} - Port {$server['virtualserver_port']}</option>
						{else}
						<option value="{$server['virtualserver_id']}">{$server['virtualserver_name']} - Port {$server['virtualserver_port']}</option>
						{/if}
					{/foreach}
					</select>
				</div>
				</form>
			{/if}
		</div>
        
        <div class="theme-swatches">
            <div class="theme-swatch" data-theme-value="light" title="Hell" style="background-color: #f0f2f5; border: 1px solid #ccc;"></div>
            <div class="theme-swatch" data-theme-value="dark" title="Dunkel (Schwarz)" style="background-color: #0f172a; border: 1px solid #333;"></div>
            <div class="theme-swatch" data-theme-value="darkblue" title="Dunkelblau" style="background-color: #0B192C; border: 1px solid #333;"></div>
            <div class="theme-swatch" data-theme-value="darkgreen" title="Dunkelgrün" style="background-color: #0f291e; border: 1px solid #333;"></div>
            <div class="theme-swatch" data-theme-value="bordeaux" title="Bordeauxrot" style="background-color: #3b070e; border: 1px solid #333;"></div>
        </div>
	</div>
</div>