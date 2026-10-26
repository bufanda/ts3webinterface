{if isset($permoverview['b_virtualserver_client_list']) AND empty($permoverview['b_virtualserver_client_list']) OR isset($permoverview['b_virtualserver_client_dblist']) AND empty($permoverview['b_virtualserver_client_dblist'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}

<!-- Filter- und Suchleiste -->
<div class="client-filter-bar glass-panel" style="margin-bottom: 1rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 15px;">
	<form method="get" action="index.php" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
		<input type="hidden" name="site" value="clients" />
		<input type="hidden" name="sid" value="{$sid}" />
		{if isset($smarty.get.sortby)}<input type="hidden" name="sortby" value="{$smarty.get.sortby}" />{/if}
		{if isset($smarty.get.sorttype)}<input type="hidden" name="sorttype" value="{$smarty.get.sorttype}" />{/if}
		
		<label for="sgfilter_select" style="font-weight: 600; display: flex; align-items: center; gap: 6px; font-size: 0.9rem;">
			<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
			Rechtefilter:
		</label>
		<div class="select-wrapper">
			<select name="sgfilter" id="sgfilter_select" onchange="this.form.submit()" class="glass-select" style="padding: 0.4rem 2rem 0.4rem 0.8rem; font-size: 0.85rem;">
				<option value="0"{if $sgfilter == 0} selected="selected"{/if}>Alle Rechte (Standard)</option>
				{foreach from=$servergroups item=sg}
					<option value="{$sg['sgid']}"{if $sgfilter == $sg['sgid']} selected="selected"{/if}>{$sg['name']} (ID: {$sg['sgid']})</option>
				{/foreach}
			</select>
		</div>
		{if $sgfilter > 0}
			<a href="index.php?site=clients&amp;sid={$sid}{if isset($smarty.get.sortby)}&amp;sortby={$smarty.get.sortby}{/if}{if isset($smarty.get.sorttype)}&amp;sorttype={$smarty.get.sorttype}{/if}" class="btn" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; background: rgba(239, 68, 68, 0.2); color: var(--danger-color);" title="Filter zurücksetzen">✕ Filter aufheben</a>
		{/if}
	</form>

	<form method="post" action="index.php?site=clients&amp;sid={$sid}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}" style="display: flex; gap: 8px; align-items: center;">
		<div class="select-wrapper">
			<select name="searchby" class="glass-select" style="padding: 0.4rem 2rem 0.4rem 0.8rem; font-size: 0.85rem;">
				<option value="name">{$lang['name']}</option>
				<option value="cldbid">{$lang['cldbid']}</option>
				<option value="uniqueid">{$lang['uniqueid']}</option>
			</select>
		</div>
		<input type="text" name="search" placeholder="Suchbegriff..." style="width: 160px; margin-bottom: 0; padding: 0.4rem 0.6rem; font-size: 0.85rem;" />
		<button type="submit" name="sendsearch" class="button" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{$lang['search']}</button>
	</form>
</div>

<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="8">
		{$lang['clients']}{if $sgfilter > 0} <span style="font-weight: normal; font-size: 0.85rem; opacity: 0.8;">(Gefiltert)</span>{/if}<br />
		{if $pages!=0}
			{while $print_pages <= $pages}
				{if $print_pages == 1}
					<a class="paging" href="index.php?site=clients&amp;sid={$sid}&amp;getstart=0{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}{if isset($smarty.get.sortby)}&amp;sortby={$smarty.get.sortby}{/if}{if isset($smarty.get.sorttype)}&amp;sorttype={$smarty.get.sorttype}{/if}">{$print_pages}</a>	
				{else}
					-<a class="paging" href="index.php?site=clients&amp;sid={$sid}&amp;getstart={$countstarted}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}{if isset($smarty.get.sortby)}&amp;sortby={$smarty.get.sortby}{/if}{if isset($smarty.get.sorttype)}&amp;sorttype={$smarty.get.sorttype}{/if}">{$print_pages}</a>
				{/if}
				{assign var=countstarted value="`$countstarted+$duration`"}
				{assign var=print_pages value="`$print_pages+1`"}
			{/while}
		{/if}
		</td>
	</tr>
	<tr>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=cldbid&amp;sorttype={if $sortby == 'cldbid' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['dbid']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=unique&amp;sorttype={if $sortby == 'client_unique_identifier' AND $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['uniqueid']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=name&amp;sorttype={if $sortby == 'client_nickname' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['nickname']}</a>
		</td>
		<td class="thead center" style="width: 95px;">Rechte</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=created&amp;sorttype={if $sortby == 'client_created' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['created']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=lastcon&amp;sorttype={if $sortby == 'client_lastconnected' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['lastonline']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=status&amp;sorttype={if $sortby == 'clid' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}{if $sgfilter > 0}&amp;sgfilter={$sgfilter}{/if}">{$lang['status']}</a>
		</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
	{while $showclients <= $duration AND isset($clientdblist[$getstart])}
		{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
		<tr id="client-row-{$clientdblist[$getstart]['cldbid']}">
			<td class="{$td_col} center">
			{$clientdblist[$getstart]['cldbid']}
			</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_unique_identifier']}</td>
			<td class="{$td_col} center">
				<span class="client-name-text">{$clientdblist[{$getstart}]['client_nickname']}</span>
			</td>
			<td class="{$td_col} center">
				<button type="button" 
						class="btn-badge-perms" 
						title="Rechte anzeigen & verwalten" 
						onclick="toggleClientPermsRow(this)"
						data-cldbid="{$clientdblist[{$getstart}]['cldbid']}" 
						data-uid="{$clientdblist[{$getstart}]['client_unique_identifier']}" 
						data-nickname="{$clientdblist[{$getstart}]['client_nickname']|escape:'html'}">
					<svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
					Rechte
				</button>
			</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_created']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_lastconnected']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			<td class="{$td_col} center">
			{if isset($clientdblist[{$getstart}]['clid'])}
				<span class="online">{$lang['online']}</span>
			{else}
				<span class="offline">{$lang['offline']}</span>
			{/if}
			</td>
			<td class="{$td_col} center options-col">
			<div class="action-buttons">
			<form method="post" action="index.php?site=cleditperm&amp;sid={$sid}&amp;cldbid={$clientdblist[{$getstart}]['cldbid']}">
			<button type="submit" name="editperms" class="btn-icon" title="{$lang['editperms']}">
				<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
			</button>
			</form>
			{if !isset($permoverview['b_client_delete_dbproperties']) OR $permoverview['b_client_delete_dbproperties'] == 1}
				<form method="post" action="index.php?site=clients&amp;sid={$sid}">
				<input type="hidden" name="cldbid" value="{$clientdblist[{$getstart}]['cldbid']}" />
				<button type="submit" name="clientdel" class="btn-icon btn-danger-icon" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgclient']}')">
					<svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
				</button>
				</form>
			{/if}
			</div>
			</td>
		</tr>
		
		{assign var=change_col value="`$change_col+1`"}
		{assign var=showclients value="`$showclients+1`"}
		{assign var=getstart value="`$getstart+1`"}
	{/while}
</table>

<script>
{literal}
window.toggleClientPermsRow = function(btn) {
    if (!btn) return;
    var cldbid = btn.getAttribute('data-cldbid');
    var uid = btn.getAttribute('data-uid');
    var nickname = btn.getAttribute('data-nickname');
    var clientRow = btn.closest('tr');
    if (!clientRow) return;

    var existingDetailRow = document.getElementById('perms-detail-row-' + cldbid);

    // Falls dieses Fenster bereits genau hier offen ist: Toggle / Schließen
    if (existingDetailRow) {
        existingDetailRow.parentNode.removeChild(existingDetailRow);
        btn.classList.remove('active');
        return;
    }

    // Alle anderen offenen Detailzeilen vorher schließen & Buttons zurücksetzen
    document.querySelectorAll('.client-perms-detail-row').forEach(function(row) {
        row.parentNode.removeChild(row);
    });
    document.querySelectorAll('.btn-badge-perms.active').forEach(function(b) {
        b.classList.remove('active');
    });

    // Button als aktiv markieren
    btn.classList.add('active');

    // Neue Detail-Tabellenzeile direkt nach der ausgewählten Benutzerzeile erzeugen
    var detailRow = document.createElement('tr');
    detailRow.id = 'perms-detail-row-' + cldbid;
    detailRow.className = 'client-perms-detail-row';

    var detailTd = document.createElement('td');
    detailTd.colSpan = 8;

    detailTd.innerHTML = `
        <div class="client-perms-detail-box">
            <div class="client-perms-detail-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" style="color: var(--accent-color);"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <h3 style="margin: 0; font-size: 1.05rem;">Rechte von <strong>` + escapeHtml(nickname) + `</strong></h3>
                </div>
                <button type="button" class="btn-icon" style="opacity: 0.8;" title="Schließen" onclick="closePermsDetailRow('` + cldbid + `')">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Benutzerdaten -->
            <div class="client-detail-card" style="margin-bottom: 1rem; padding: 0.6rem 0.9rem; border-radius: 6px; background: rgba(128,128,128,0.06); border: 1px solid var(--glass-border); display: flex; flex-wrap: wrap; gap: 20px;">
                <div><span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7;">Nickname:</span> <strong style="color: var(--accent-color);">` + escapeHtml(nickname) + `</strong></div>
                <div><span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7;">DB-ID:</span> <strong>` + cldbid + `</strong></div>
                <div><span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7;">Unique ID:</span> <span style="font-family: monospace; font-size: 0.85rem;">` + escapeHtml(uid) + `</span></div>
            </div>

            <!-- Statusmeldung -->
            <div id="inline-status-` + cldbid + `" style="display: none; margin-bottom: 0.8rem; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.85rem;"></div>

            <!-- Gruppen-Inhalt -->
            <div id="inline-loading-` + cldbid + `" style="text-align: center; padding: 1.2rem 0; opacity: 0.7; font-size: 0.9rem;">
                Rechte werden geladen...
            </div>

            <div id="inline-table-wrap-` + cldbid + `" style="display: none;">
                <table class="border" style="width: 100%; border-collapse: collapse; margin-bottom: 0.5rem;">
                    <thead>
                        <tr>
                            <th class="thead" style="width: 70px;">SGID</th>
                            <th class="thead">Servergruppe / Recht</th>
                            <th class="thead" style="width: 110px; text-align: center;">Aktion</th>
                        </tr>
                    </thead>
                    <tbody id="inline-tbody-` + cldbid + `"></tbody>
                </table>
            </div>

            <div id="inline-empty-` + cldbid + `" style="display: none; text-align: center; padding: 1rem 0; opacity: 0.7; font-size: 0.9rem;">
                Keine speziellen Servergruppen zugewiesen.
            </div>
        </div>
    `;

    detailRow.appendChild(detailTd);

    // Direkt nach der angeklickten Zeile einfügen
    clientRow.parentNode.insertBefore(detailRow, clientRow.nextSibling);

    // Daten asynchron abrufen
    var urlParams = new URLSearchParams(window.location.search);
    var currentSid = urlParams.get('sid') || '0';
    var currentSgFilter = parseInt(urlParams.get('sgfilter') || '0', 10);

    fetch('index.php?site=clients&sid=' + encodeURIComponent(currentSid) + '&ajax=get_client_groups&cldbid=' + encodeURIComponent(cldbid))
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                renderInlineGroups(data.groups, cldbid, uid, nickname, currentSid, currentSgFilter);
            } else {
                var loading = document.getElementById('inline-loading-' + cldbid);
                var status = document.getElementById('inline-status-' + cldbid);
                if (loading) loading.style.display = 'none';
                if (status) {
                    status.style.display = 'block';
                    status.style.background = 'rgba(239, 68, 68, 0.15)';
                    status.style.color = 'var(--danger-color)';
                    status.textContent = 'Rechte konnten nicht geladen werden.';
                }
            }
        })
        .catch(function(err) {
            var loading = document.getElementById('inline-loading-' + cldbid);
            var status = document.getElementById('inline-status-' + cldbid);
            if (loading) loading.style.display = 'none';
            if (status) {
                status.style.display = 'block';
                status.style.background = 'rgba(239, 68, 68, 0.15)';
                status.style.color = 'var(--danger-color)';
                status.textContent = 'Netzwerkfehler: ' + err.message;
            }
        });
};

window.closePermsDetailRow = function(cldbid) {
    var detailRow = document.getElementById('perms-detail-row-' + cldbid);
    if (detailRow && detailRow.parentNode) {
        detailRow.parentNode.removeChild(detailRow);
    }
    var clientRow = document.getElementById('client-row-' + cldbid);
    if (clientRow) {
        var btn = clientRow.querySelector('.btn-badge-perms');
        if (btn) btn.classList.remove('active');
    }
};

window.renderInlineGroups = function(groups, cldbid, uid, nickname, currentSid, currentSgFilter) {
    var loading = document.getElementById('inline-loading-' + cldbid);
    var tableWrap = document.getElementById('inline-table-wrap-' + cldbid);
    var tbody = document.getElementById('inline-tbody-' + cldbid);
    var empty = document.getElementById('inline-empty-' + cldbid);
    var status = document.getElementById('inline-status-' + cldbid);

    if (loading) loading.style.display = 'none';
    if (tbody) tbody.innerHTML = '';
    if (status) status.style.display = 'none';

    if (!groups || groups.length === 0) {
        if (tableWrap) tableWrap.style.display = 'none';
        if (empty) empty.style.display = 'block';
        return;
    }

    if (empty) empty.style.display = 'none';
    if (tableWrap) tableWrap.style.display = 'block';

    groups.forEach(function(group) {
        var tr = document.createElement('tr');
        var sgid = group.sgid;
        var sgname = group.name || ('Gruppe #' + sgid);

        var tdSgid = document.createElement('td');
        tdSgid.className = 'center';
        tdSgid.style.fontFamily = 'monospace';
        tdSgid.style.fontSize = '0.85rem';
        tdSgid.style.opacity = '0.8';
        tdSgid.textContent = sgid;

        var tdName = document.createElement('td');
        var strong = document.createElement('strong');
        strong.textContent = sgname;
        tdName.appendChild(strong);

        var tdAction = document.createElement('td');
        tdAction.className = 'center';

        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn-revoke-perm';
        btn.innerHTML = '<svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Entziehen';
        btn.title = 'Recht entziehen';

        btn.onclick = function() {
            var confirmMsg = 'Sind Sie sicher, dass Sie dem Benutzer \u201E' + nickname + '\u201C (DB-ID: ' + cldbid + ', Eindeutige ID: ' + uid + ') das Recht \u201E' + sgname + '\u201C (SGID: ' + sgid + ') entziehen m\u00F6chten?';
            if (window.confirm(confirmMsg)) {
                btn.disabled = true;
                btn.textContent = 'Wird entzogen...';

                var formData = new FormData();
                formData.append('ajax', 'revoke_client_group');
                formData.append('cldbid', cldbid);
                formData.append('sgid', sgid);

                fetch('index.php?site=clients&sid=' + encodeURIComponent(currentSid), {
                    method: 'POST',
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    if (d.success) {
                        if (status) {
                            status.style.display = 'block';
                            status.style.background = 'rgba(76, 175, 80, 0.15)';
                            status.style.color = 'var(--accent-color)';
                            status.style.border = '1px solid rgba(76, 175, 80, 0.3)';
                            status.textContent = 'Recht \u201E' + sgname + '\u201C wurde erfolgreich entzogen.';
                        }
                        renderInlineGroups(d.groups, cldbid, uid, nickname, currentSid, currentSgFilter);

                        if (currentSgFilter === sgid) {
                            var row = document.getElementById('client-row-' + cldbid);
                            if (row) {
                                row.style.transition = 'opacity 0.4s ease';
                                row.style.opacity = '0';
                                setTimeout(function() { 
                                    if (row.parentNode) row.parentNode.removeChild(row);
                                    closePermsDetailRow(cldbid);
                                }, 400);
                            }
                        }
                    } else {
                        if (status) {
                            status.style.display = 'block';
                            status.style.background = 'rgba(239, 68, 68, 0.15)';
                            status.style.color = 'var(--danger-color)';
                            status.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                            status.textContent = 'Fehler beim Entziehen: ' + (d.error || 'Unbekannter Fehler');
                        }
                        btn.disabled = false;
                        btn.innerHTML = '<svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Entziehen';
                    }
                })
                .catch(function(err) {
                    if (status) {
                        status.style.display = 'block';
                        status.style.background = 'rgba(239, 68, 68, 0.15)';
                        status.style.color = 'var(--danger-color)';
                        status.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                        status.textContent = 'Anfragefehler: ' + err.message;
                    }
                    btn.disabled = false;
                    btn.innerHTML = '<svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Entziehen';
                });
            }
        };

        tdAction.appendChild(btn);
        tr.appendChild(tdSgid);
        tr.appendChild(tdName);
        tr.appendChild(tdAction);
        tbody.appendChild(tr);
    });
};

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/[&<>"']/g, function(m) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
    });
}
{/literal}
</script>

{/if}