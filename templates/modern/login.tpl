{if !empty($error)}
<div class="error">
	{$error}
</div>
{/if}


{if !isset($smarty.post.sendlogin) AND $loginstatus !== true OR $loginstatus !== true}
<div class="login-wrapper">

	<div class="glass-panel login-box">
		<h2>{$lang['login']}</h2>
		<form method="post" action="index.php?site=login">
			<div style="margin-bottom: 1rem; text-align: left;">
				<label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">{$lang['server']}:</label>
				{if count($instances) == 1}
					{foreach key=skey item=sdata from=$instances}
					<input type="hidden" name="skey" value="{$skey}" />
					<input type="text" value="{$sdata['alias']}" disabled />
					{/foreach}
				{else}
				<div class="select-wrapper">
					<select name="skey" class="glass-select" style="width: 100%;">
					{foreach key=skey item=sdata from=$instances}
					<option value="{$skey}">{$sdata['alias']}</option>	
					{/foreach}
					</select>
				</div>
				{/if}
			</div>
			
			<div style="margin-bottom: 1rem; text-align: left;">
				<label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">{$lang['username']}:</label>
				<input type="text" name="loginUser" value="serveradmin" />
			</div>
			
			<div style="margin-bottom: 1.5rem; text-align: left;">
				<label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">{$lang['password']}:</label>
				<input type="password" name="loginPw" />
			</div>
			
			<div>
				<input class="button" type="submit" name="sendlogin" value="{$lang['login']}" style="width: 100%;" />
			</div>
		</form>
	</div>

	<div class="glass-panel feature-preview">
		<!-- Das Bild bitte nach templates/modern/gfx/feature-map.png hochladen -->
		<img src="templates/modern/gfx/feature-map.png" alt="Feature Vorschau - Geo Map">
		
		<div class="feature-text">
			<h3>JETZT NEU</h3>
			<p><strong>Jetzt neu im Webinterface!</strong></p>
			<p>Behalte den Überblick über Deine User – visuell und in Echtzeit:<br>
			Auf einer Deutschlandkarte werden alle verbundenen Nutzer als Pins dargestellt.</p>
			
			<p>Bewege Deine Maus über einen Pin und erhalte sofort detaillierte Informationen:</p>
			<ul>
				<li>Username im TeamSpeak</li>
				<li>Herkunft (Standort)</li>
				<li>Verwendeter Serverport</li>
			</ul>
			
			<p>So siehst Du auf einen Blick, woher Deine Community kommt und wie sie verbunden ist.</p>
		</div>
	</div>

</div>
{/if}