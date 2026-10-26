document.addEventListener('DOMContentLoaded', () => {
    const swatches = document.querySelectorAll('.theme-swatch');
    const htmlElement = document.documentElement;
    
    // Check local storage for theme preference
    const savedTheme = localStorage.getItem('ts3wi_theme') || 'light';
    htmlElement.setAttribute('data-theme', savedTheme);
    updateActiveSwatch(savedTheme);

    swatches.forEach(swatch => {
        swatch.addEventListener('click', function() {
            const newTheme = this.getAttribute('data-theme-value');
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('ts3wi_theme', newTheme);
            updateActiveSwatch(newTheme);
        });
    });

    function updateActiveSwatch(theme) {
        swatches.forEach(swatch => {
            if (swatch.getAttribute('data-theme-value') === theme) {
                swatch.classList.add('active');
            } else {
                swatch.classList.remove('active');
            }
        });
    }

    // Inline Edit Logic
    document.querySelectorAll('.btn-inline-edit').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const container = this.closest('.inline-edit-container');
            const itemName = container.querySelector('.item-name');
            const inlineForm = container.querySelector('.inline-edit-form');
            
            if (itemName && inlineForm) {
                itemName.style.display = 'none';
                this.style.display = 'none';
                inlineForm.style.display = 'flex';
                const input = inlineForm.querySelector('input[type="text"]');
                if (input) {
                    input.focus();
                    input.select();
                }
            }
        });
    });

    // Client-Rechte-Modal Controller mit dynamischer Initialisierung & Event-Delegation
    function getOrCreatePermsModal() {
        let modal = document.getElementById('ts3-perms-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'ts3-perms-modal';
            modal.className = 'ts3-modal-backdrop';
            modal.style.display = 'none';
            modal.innerHTML = `
                <div class="ts3-modal-container glass-panel">
                    <div class="ts3-modal-header">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="modal-icon-badge">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            <h3 style="margin: 0; font-size: 1.2rem;">Benutzer-Rechte verwalten</h3>
                        </div>
                        <button type="button" class="btn-icon ts3-modal-close" id="ts3-modal-close-btn" title="Schließen">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="ts3-modal-body">
                        <div class="client-detail-card" style="margin-bottom: 1.2rem; padding: 0.8rem 1rem; border-radius: 8px; background: rgba(128,128,128,0.08); border: 1px solid var(--glass-border);">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 10px;">
                                <div>
                                    <span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7; display: block;">Benutzer:</span>
                                    <strong id="modal-client-name" style="font-size: 1rem; color: var(--accent-color);">-</strong>
                                </div>
                                <div>
                                    <span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7; display: block;">DB-ID:</span>
                                    <strong id="modal-client-dbid">-</strong>
                                </div>
                                <div>
                                    <span style="font-size: 0.75rem; text-transform: uppercase; opacity: 0.7; display: block;">Eindeutige ID (UID):</span>
                                    <span id="modal-client-uid" style="font-family: monospace; font-size: 0.85rem; word-break: break-all;">-</span>
                                </div>
                            </div>
                        </div>
                        <div id="modal-status-msg" style="display: none; margin-bottom: 1rem; padding: 0.6rem 0.8rem; border-radius: 6px; font-size: 0.85rem;"></div>
                        <div style="margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="margin: 0; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">Zugewiesene Servergruppen</h4>
                            <span id="modal-groups-count" style="font-size: 0.8rem; opacity: 0.7;"></span>
                        </div>
                        <div id="modal-groups-loading" style="text-align: center; padding: 2rem 0;">
                            <span style="opacity: 0.7; font-size: 0.9rem;">Rechte werden geladen...</span>
                        </div>
                        <div id="modal-groups-table-wrap" style="display: none;">
                            <table class="border" style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th class="thead" style="width: 70px;">SGID</th>
                                        <th class="thead">Servergruppe / Recht</th>
                                        <th class="thead" style="width: 110px; text-align: center;">Aktion</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-groups-tbody"></tbody>
                            </table>
                        </div>
                        <div id="modal-groups-empty" style="display: none; text-align: center; padding: 1.5rem 0; opacity: 0.7; font-size: 0.9rem;">
                            Keine speziellen Servergruppen zugewiesen.
                        </div>
                    </div>
                    <div class="ts3-modal-footer" style="margin-top: 1.2rem; display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--glass-border); padding-top: 0.8rem;">
                        <button type="button" class="btn" id="ts3-modal-btn-close" style="background: rgba(128,128,128,0.15);">Schließen</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            // Modal Schließen-Events
            modal.querySelector('#ts3-modal-close-btn').addEventListener('click', () => modal.style.display = 'none');
            modal.querySelector('#ts3-modal-btn-close').addEventListener('click', () => modal.style.display = 'none');
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.style.display = 'none';
            });
        }
        return modal;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"']/g, function(m) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
        });
    }

    function showStatus(text, isError) {
        const modalStatusMsg = document.getElementById('modal-status-msg');
        if (!modalStatusMsg) return;
        modalStatusMsg.style.display = 'block';
        modalStatusMsg.style.background = isError ? 'rgba(239, 68, 68, 0.15)' : 'rgba(76, 175, 80, 0.15)';
        modalStatusMsg.style.color = isError ? 'var(--danger-color)' : 'var(--accent-color)';
        modalStatusMsg.style.border = isError ? '1px solid rgba(239, 68, 68, 0.3)' : '1px solid rgba(76, 175, 80, 0.3)';
        modalStatusMsg.innerHTML = text;
    }

    function hideStatus() {
        const modalStatusMsg = document.getElementById('modal-status-msg');
        if (modalStatusMsg) {
            modalStatusMsg.style.display = 'none';
            modalStatusMsg.innerHTML = '';
        }
    }

    function renderGroupsInModal(groups, cldbid, uid, nickname, currentSid, currentSgFilter) {
        const modalGroupsLoading = document.getElementById('modal-groups-loading');
        const modalGroupsTbody = document.getElementById('modal-groups-tbody');
        const modalGroupsCount = document.getElementById('modal-groups-count');
        const modalGroupsTableWrap = document.getElementById('modal-groups-table-wrap');
        const modalGroupsEmpty = document.getElementById('modal-groups-empty');

        if (modalGroupsLoading) modalGroupsLoading.style.display = 'none';
        if (modalGroupsTbody) modalGroupsTbody.innerHTML = '';
        hideStatus();

        if (!groups || groups.length === 0) {
            if (modalGroupsCount) modalGroupsCount.textContent = '(0 Gruppen)';
            if (modalGroupsTableWrap) modalGroupsTableWrap.style.display = 'none';
            if (modalGroupsEmpty) modalGroupsEmpty.style.display = 'block';
            return;
        }

        if (modalGroupsCount) modalGroupsCount.textContent = '(' + groups.length + ' Gruppe' + (groups.length > 1 ? 'n' : '') + ')';
        if (modalGroupsEmpty) modalGroupsEmpty.style.display = 'none';
        if (modalGroupsTableWrap) modalGroupsTableWrap.style.display = 'block';

        groups.forEach(group => {
            const tr = document.createElement('tr');
            const sgid = group.sgid;
            const sgname = group.name || ('Gruppe #' + sgid);

            tr.innerHTML = `
                <td class="center" style="font-family: monospace; font-size: 0.85rem; opacity: 0.8;">${sgid}</td>
                <td><strong>${escapeHtml(sgname)}</strong></td>
                <td class="center">
                    <button type="button" 
                            class="btn-revoke-perm" 
                            data-sgid="${sgid}" 
                            data-sgname="${escapeHtml(sgname)}" 
                            data-cldbid="${cldbid}" 
                            data-uid="${escapeHtml(uid)}" 
                            data-nickname="${escapeHtml(nickname)}"
                            title="Recht entziehen">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" stroke-width="2" fill="none"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        Entziehen
                    </button>
                </td>
            `;
            modalGroupsTbody.appendChild(tr);
        });

        // Event-Listener für Entziehen-Buttons
        modalGroupsTbody.querySelectorAll('.btn-revoke-perm').forEach(btn => {
            btn.addEventListener('click', function() {
                const btnSgid = parseInt(this.getAttribute('data-sgid'), 10);
                const btnSgname = this.getAttribute('data-sgname');
                const btnCldbid = this.getAttribute('data-cldbid');
                const btnUid = this.getAttribute('data-uid');
                const btnNick = this.getAttribute('data-nickname');

                const confirmMsg = `Sind Sie sicher, dass Sie dem Benutzer „${btnNick}“ (DB-ID: ${btnCldbid}, Eindeutige ID: ${btnUid}) das Recht „${btnSgname}“ (SGID: ${btnSgid}) entziehen möchten?`;

                if (window.confirm(confirmMsg)) {
                    this.disabled = true;
                    this.innerHTML = 'Wird entzogen...';

                    const formData = new FormData();
                    formData.append('ajax', 'revoke_client_group');
                    formData.append('cldbid', btnCldbid);
                    formData.append('sgid', btnSgid);

                    fetch(`index.php?site=clients&sid=${currentSid}`, {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showStatus(`Recht <strong>${escapeHtml(btnSgname)}</strong> wurde erfolgreich entzogen.`, false);
                            renderGroupsInModal(data.groups, btnCldbid, btnUid, btnNick, currentSid, currentSgFilter);

                            // Falls Liste nach genau dieser Gruppe gefiltert ist: Zeile aus Haupttabelle entfernen
                            if (currentSgFilter === btnSgid) {
                                const row = document.getElementById(`client-row-${btnCldbid}`);
                                if (row) {
                                    row.style.transition = 'opacity 0.4s ease';
                                    row.style.opacity = '0';
                                    setTimeout(() => row.remove(), 400);
                                }
                            }
                        } else {
                            showStatus(`Das Recht konnte nicht entzogen werden: ${escapeHtml(data.error || 'Unbekannter Fehler')}`, true);
                            this.disabled = false;
                            this.innerHTML = 'Entziehen';
                        }
                    })
                    .catch(err => {
                        showStatus(`Fehler bei der Anfrage: ${escapeHtml(err.message)}`, true);
                        this.disabled = false;
                        this.innerHTML = 'Entziehen';
                    });
                }
            });
        });
    }

    // Globale Event-Delegation für alle Rechte-Buttons (funktioniert immer, auch bei dynamischem Inhalt)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-badge-perms');
        if (!btn) return;

        e.preventDefault();
        const cldbid = btn.getAttribute('data-cldbid');
        const uid = btn.getAttribute('data-uid');
        const nickname = btn.getAttribute('data-nickname');

        const urlParams = new URLSearchParams(window.location.search);
        const currentSid = urlParams.get('sid') || '0';
        const currentSgFilter = parseInt(urlParams.get('sgfilter') || '0', 10);

        const modal = getOrCreatePermsModal();
        const modalClientName = document.getElementById('modal-client-name');
        const modalClientDbid = document.getElementById('modal-client-dbid');
        const modalClientUid = document.getElementById('modal-client-uid');
        const modalGroupsTableWrap = document.getElementById('modal-groups-table-wrap');
        const modalGroupsEmpty = document.getElementById('modal-groups-empty');
        const modalGroupsLoading = document.getElementById('modal-groups-loading');

        if (modalClientName) modalClientName.textContent = nickname;
        if (modalClientDbid) modalClientDbid.textContent = cldbid;
        if (modalClientUid) modalClientUid.textContent = uid;

        if (modalGroupsTableWrap) modalGroupsTableWrap.style.display = 'none';
        if (modalGroupsEmpty) modalGroupsEmpty.style.display = 'none';
        if (modalGroupsLoading) modalGroupsLoading.style.display = 'block';
        hideStatus();

        modal.style.display = 'flex';

        // Servergruppen asynchron abfragen
        fetch(`index.php?site=clients&sid=${currentSid}&ajax=get_client_groups&cldbid=${cldbid}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    renderGroupsInModal(data.groups, cldbid, uid, nickname, currentSid, currentSgFilter);
                } else {
                    if (modalGroupsLoading) modalGroupsLoading.style.display = 'none';
                    showStatus('Rechte konnten nicht geladen werden.', true);
                }
            })
            .catch(err => {
                if (modalGroupsLoading) modalGroupsLoading.style.display = 'none';
                showStatus('Netzwerkfehler beim Laden der Rechte: ' + err.message, true);
            });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('ts3-perms-modal');
            if (modal && modal.style.display !== 'none') {
                modal.style.display = 'none';
            }
        }
    });
});

// Globale Hilfsfunktionen fuer aeltere HTML-Event-Handler registrieren

// Funktion zum Auf- und Zuklappen von Rechte-Kategorien (Akkordeon)
window.Klappen = function(Id) {
    var jetec_Minus = "gfx/images/minus.png";
    var jetec_Plus = "gfx/images/plus.png";
    
    if (Id === 0) {
        var pic0 = document.getElementById('Pic0');
        if (!pic0) return;
        
        var openAll;
        if (pic0.name === 'plus') {
            pic0.src = jetec_Minus;
            pic0.name = 'minus';
            openAll = 1;
        } else {
            pic0.src = jetec_Plus;
            pic0.name = 'plus';
            openAll = 0;
        }
        
        var i = 1;
        while (i < 100) {
            var klappText = document.getElementById('Lay' + i);
            var klappBild = document.getElementById('Pic' + i);
            if (klappText && klappBild) {
                if (openAll === 1) {
                    klappText.style.display = 'block';
                    klappBild.src = jetec_Minus;
                } else {
                    klappText.style.display = 'none';
                    klappBild.src = jetec_Plus;
                }
                i++;
            } else {
                break;
            }
        }
    } else {
        var klappText = document.getElementById('Lay' + Id);
        var klappBild = document.getElementById('Pic' + Id);
        if (klappText && klappBild) {
            if (klappText.style.display === 'none') {
                klappText.style.display = 'block';
                klappBild.src = jetec_Minus;
            } else {
                klappText.style.display = 'none';
                klappBild.src = jetec_Plus;
            }
        }
    }
};

// Funktion zum Oeffnen von Popup-Fenstern (z.B. fuer Icons)
window.oeffnefenster = function(url) {
    var fenster = window.open(url, "fenster1", "width=350,height=150,status=no,scrollbars=yes,resizable=no");
    if (fenster) {
        fenster.opener.name = "opener";
        fenster.focus();
    }
};

// Funktion zum Ein-/Ausblenden von Elementen in der Token-Erstellung
window.hide_select = function(selectId) {
    var groups = document.getElementById("groups");
    var servergroups = document.getElementById("servergroups");
    var channelgroups = document.getElementById("channelgroups");
    var channel = document.getElementById("channel");
    
    if (parseInt(selectId) === 0) {
        if (groups) groups.style.display = "";
        if (servergroups) servergroups.style.display = "";
        if (channelgroups) channelgroups.style.display = "none";
        if (channel) channel.style.display = "none";
    } else if (parseInt(selectId) === 1) {
        if (groups) groups.style.display = "";
        if (servergroups) servergroups.style.display = "none";
        if (channelgroups) channelgroups.style.display = "";
        if (channel) channel.style.display = "";
    } else {
        if (groups) groups.style.display = "none";
        if (servergroups) servergroups.style.display = "none";
        if (channelgroups) channelgroups.style.display = "none";
        if (channel) channel.style.display = "none";
    }
};

// Funktion zum Auswaehlen/Abwaehlen aller Checkboxen in einem Formular
var checkflag = "false";
window.check = function(form) {
    var formElement = document.forms[form] || document.forms[0]; // Fallback auf das erste Formular
    if (!formElement) return checkflag;
    
    if (checkflag === "false") {
        for (var i = 0; i < formElement.elements.length; i++) {
            if (formElement.elements[i].name !== 'checkall') {
                formElement.elements[i].checked = true;
            }
        }
        checkflag = "true";
    } else {
        for (var i = 0; i < formElement.elements.length; i++) {
            formElement.elements[i].checked = false;
        }
        checkflag = "false";
    }
    return checkflag;
};

// Hilfsfunktionen fuer Massenaktionen auf Servern (Bestaetigungsabfrage)
var conf_arr = [];
window.confirmArray = function(sid, name, port, action) {
    conf_arr[sid] = {};
    conf_arr[sid]['name'] = name;
    conf_arr[sid]['port'] = port;
    
    var caction = document.getElementById("caction" + sid);
    if (caction) {
        if (caction.options.selectedIndex === 0) {
            conf_arr[sid]['action'] = '';
        } else if (caction.options.selectedIndex === 1) {
            conf_arr[sid]['action'] = 'start';
        } else if (caction.options.selectedIndex === 2) {
            conf_arr[sid]['action'] = 'stop';
        } else if (caction.options.selectedIndex === 3) {
            conf_arr[sid]['action'] = 'del';
        }
    }
};

window.confirmAction = function() {
    var text = "Moechtest du folgende Aktion wirklich ausfuehren?\n\n";
    for (var i in conf_arr) {
        if (conf_arr[i] && conf_arr[i]['action']) {
            if (conf_arr[i]['action'] === 'start') {
                text = text + "***Starten*** " + conf_arr[i]['name'] + " " + conf_arr[i]['port'] + "\n";
            } else if (conf_arr[i]['action'] === 'stop') {
                text = text + "***Stoppen*** " + conf_arr[i]['name'] + " " + conf_arr[i]['port'] + "\n";
            } else if (conf_arr[i]['action'] === 'del') {
                text = text + "***Loeschen*** " + conf_arr[i]['name'] + " " + conf_arr[i]['port'] + "\n";
            }
        }
    }
    return text;
};
