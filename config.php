<?php
/*
 * ==============================================================================
 *  TEAMSPEAK 3 WEBINTERFACE
 * ==============================================================================
 * 
 *  Copyright (C) 2009-2026 Psychokiller
 *  In Kooperation mit Psychokiller und TS-Rent.de entstanden
 * 
 *  DE: Dies ist ein kostenloses Community-Projekt! Bitte respektiere die 
 *      Arbeit der urspruenglichen Entwickler, indem du diesen Copyright-Hinweis 
 *      und die Copyright-Texte im Interface nicht entfernst.
 *      Dieses Skript steht unter der GNU General Public License v3.
 *      Danke, dass du diese offene Software nutzt und unterstuetzt!
 * 
 *  EN: This is a free community project! Please respect the work of the 
 *      original developers by not removing this copyright notice and the 
 *      copyright texts in the web interface. 
 *      This script is licensed under the GNU General Public License v3.
 *      Thank you for using and supporting this open software!
 * 
 * ==============================================================================
 *  WICHTIGE INFORMATION / IMPORTANT INFORMATION
 * ==============================================================================
 * 
 *  DE: Damit das Webinterface funktioniert, MUSS die IP-Adresse deines 
 *      Webservers in die Datei 'query_ip_whitelist.txt' deines TeamSpeak 3 
 *      Servers eingetragen werden! Nach dem Eintragen muss der TS3 Server 
 *      neu gestartet werden.
 * 
 *  EN: For the web interface to work, the IP address of your web server MUST 
 *      be added to the 'query_ip_whitelist.txt' file of your TeamSpeak 3 
 *      server! After adding the IP, the TS3 server must be restarted.
 * 
 * ==============================================================================
 *  SERVER KONFIGURATION / SERVER CONFIGURATION
 * ==============================================================================
 * 
 *  DE: Hier kannst du beliebig viele Server hinzufuegen. Kopiere einfach 
 *      einen Block und erhoehe die Nummer in den eckigen Klammern (z.B. $server[23]).
 * 
 *  EN: Here you can add as many servers as you like. Just copy a block 
 *      and increase the number in the brackets (e.g. $server[23]).
 */

$server[0]['alias']= "";
$server[0]['ip']= "";
$server[0]['tport']= "";


$cfglang	=	"de";			// DE: Sprache (de, en, nl) | EN: Language (de, en, nl)
$duration = "100";				// DE: Maximale Clients pro Seite | EN: Max clients per page
$fastswitch=true;				// DE: Server-Schnellwechsel im Header erlauben? | EN: Allow quick server switch in header?
$showicons="left";				// DE: Position der Icons im Viewer (left/right) | EN: Position of icons in viewer (left/right)
$style="modern";				// DE: Design-Name ('modern' ist das neue UI!) | EN: Theme name ('modern' is the new UI!)
$msgsend_name="Webinterface";	// DE: Absendername fuer Server-Nachrichten | EN: Sender name for server messages
$show_motd=true;				// DE: "Nachricht des Tages" beim Login zeigen? | EN: Show "Message of the Day" on login?
$show_version=true;				// DE: Version im Footer anzeigen? | EN: Show version in footer?
?>