<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'onlyofficeeditor', language 'de'.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2024 Ascensio System SIA <integration@onlyoffice.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['editorenterfullscreen'] = 'Vollbildmodus aktivieren';
$string['editorexitfullscreen'] = 'Vollbildmodus verlassen';
$string['onmentionerror'] = 'Fehler bei der Erwähnung.';
$string['mentioncontexturlname'] = 'Link zum Kommentar.';
$string['messageprovider:mentionnotifier'] = 'Benachrichtigung über ONLYOFFICE im Modul Dokumente.';
$string['mentionnotifier:notification'] = '{$a->notifier} wurde in {$a->course} erwähnt';
$string['docxformname'] = 'Dokument';
$string['pptxformname'] = 'Präsentation';
$string['xlsxformname'] = 'Arbeitsmappe';
$string['docxfformname'] = '';
$string['uploadformname'] = 'Datei hochladen';
$string['modulename'] = 'ONLYOFFICE-Dokument';
$string['modulenameplural'] = 'ONLYOFFICE-Dokumente';
$string['modulename_help'] = 'Das ONLYOFFICE-Modul ermöglicht die Erstellung und gemeinsame Bearbeitung von lokal in Moodle gespeicherten Office-Dokumenten mithilfe ONLYOFFICE Document Server';
$string['pluginname'] = 'ONLYOFFICE-Dokument';
$string['pluginadministration'] = 'Verwaltung der Aktivitäten in einem ONLYOFFICE-Dokument';
$string['onlyofficename'] = 'Aktivitätsname';

$string['onlyofficeactivityicon'] = 'In ONLYOFFICE öffnen';
$string['onlyofficeeditor:addinstance'] = 'Neue Aktivität für ONLYOFFICE-Dokumente hinzufügen';
$string['onlyofficeeditor:view'] = 'ONLYOFFICE-Dokumentenaktivität anzeigen';
$string['onlyofficeeditor:editdocument'] = 'ONLYOFFICE-Dokumentenaktivität bearbeiten';

$string['documentserverurl'] = 'Serviceadresse der Dokumentbearbeitung';
$string['documentserverurl_desc'] = 'Die Adresse des Dienstes für die Dokumentenbearbeitung ist die Adresse des Servers, auf dem die Dokumentendienste installiert sind. Bitte ersetzen Sie \'https://documentserver.url\' oben durch die richtige Serveradresse';
$string['documentserversecret'] = 'Geheimschlüssel des Document Servers';
$string['documentserversecret_desc'] = 'Der Geheimschlüssel wird verwendet, um das Token (eine verschlüsselte Signatur) im Browser für das Öffnen des Dokumenteditors und den Aufruf der Methoden und der Anfragen an den Dokumentbefehlsdienst und den Dokumentkonvertierungsdienst zu generieren. Das Token verhindert die Ersetzung wichtiger Parameter in ONLYOFFICE Document Server-Anfragen.';
$string['jwtheader'] = 'Authorization-Header';
$string['disable_verify_ssl'] = 'Zertifikatsüberprüfung deaktivieren (unsicher)';

$string['selectfile'] = 'Wählen Sie eine vorhandene Datei aus oder erstellen Sie eine neue, indem Sie auf eines der Symbole klicken';
$string['documentpermissions'] = 'Zugriffsrechte auf Dokumente';
$string['download'] = 'Das Dokument kann heruntergeladen werden';
$string['download_help'] = 'Wenn deaktiviert, Herunterladen von Dokumenten über ONLYOFFICE-Editoren wird unmöglich. Benutzer mit der Zugriffsebene <strong>course:manageactivities</strong> dürfen Dokumente immer über die App herunterladen';
$string['print'] = 'Dokument kann gedruckt werden';
$string['print_help'] = 'Wenn deaktiviert, Drucken von Dokumenten über ONLYOFFICE-Editoren wird unmöglich. Benutzer mit der Zugriffsebene <strong>course:manageactivities</strong> dürfen Dokumente immer über die App drucken';
$string['protect'] = 'Registerkarte Schutz ausblenden';
$string['protect_help'] = 'Wenn deaktiviert, Benutzer haben Zugriff auf die Schutzeinstellungen im ONLYOFFICE-Editor. Für Benutzer mit der Zugriffsebene <strong>course:manageactivities</strong> sind diese Einstellungen immer verfügbar.';

$string['returntodocument'] = 'Zur Kursseite';
$string['docserverunreachable'] = 'ONLYOFFICE Document Server kann nicht erreicht werden. Bitte kontaktieren Sie Admin';
$string['privacy:metadata'] = 'Es werden keine Informationen über persönliche Daten der Nutzer gespeichert.';
$string['privacy:metadata:onlyofficeeditor:userid'] = 'Diese Benutzer-ID wird nicht an den ONLYOFFICE-Editor gesendet.';
$string['privacy:metadata:onlyofficeeditor:intro'] = 'Allgemeine Einführung in die ONLYOFFICE-Aktivität';
$string['privacy:metadata:onlyofficeeditor:introformat'] = ' Format des Einführungsfeldes (MOODLE, HTML, MARKDOWN...).';
$string['privacy:metadata:onlyofficeeditor:permissions'] = 'Zugriffsrechte auf Dokumente.';
$string['privacy:metadata:onlyofficeeditor:name'] = 'Name der Aktivität in ONLYOFFICE';
$string['privacy:metadata:onlyofficeeditor:course'] = 'Kurs zu dem die Aktivität ONLYOFFICE gehört.';
$string['privacy:metadata:onlyofficeeditor'] = 'Informationen über die mit ONLYOFFICE bearbeiteten Dokumente.';
$string['privacy:metadata:onlyofficeeditor:core_files'] = 'Die Dokumentenaktivität in ONLYOFFICE speichert Dokumente, die bearbeitet wurden.';
$string['forcesave'] = 'Force Save aktivieren';
$string['editor_view'] = 'Editor-Einstellungen';
$string['editor_view_chat'] = 'Chat-Taste anzeigen';
$string['editor_view_help'] = 'Hilfetaste anzeigen';
$string['editor_view_header'] = 'Kompakte Kopfzeile anzeigen';
$string['editor_view_feedback'] = 'Feedback-& Support-Taste anzeigen';
$string['editor_view_toolbar'] = 'Monochromen Kopfbereich der Symbolleiste anzeigen';
$string['editor_security'] = 'Sicherheit';
$string['editor_security_plugin'] = 'Arbeit mit Plugins aktivieren';
$string['editor_security_macros'] = 'Makros im Dokument ausführen';

$string['oldversion'] = ' Für Online-Arbeit mit Formularen ist Version 7.0 von ONLYOFFICE Docs erforderlich';
$string['saveaserror'] = 'Ein Fehler ist aufgetreten.';
$string['saveassuccess'] = 'Dokument wurde erfolgreich gespeichert.';
$string['saveastitle'] = 'Wählen Sie den Bereich Kurse aus, um das Dokument zu speichern';
$string['saveasbutton'] = 'Wählen';
