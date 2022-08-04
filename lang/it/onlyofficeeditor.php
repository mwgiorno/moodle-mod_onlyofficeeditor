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
 * Strings for component 'onlyofficeeditor', language 'it'.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2022 Ascensio System SIA <integration@onlyoffice.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['editorenterfullscreen'] = 'Apri la modalità schermo intero';
$string['editorexitfullscreen'] = 'Esci dalla modalità schermo intero';
$string['onmentionerror'] = 'Errore nel menzionare.';
$string['mentioncontexturlname'] = 'Link al commento.';
$string['messageprovider:mentionnotifier'] = 'Notifica della menzione di ONLYOFFICE nel modulo Documenti.';
$string['mentionnotifier:notification'] = '{$a->notifier} menzionato nel {$a->course}';
$string['docxformname'] = 'Documento';
$string['pptxformname'] = 'Presentazione';
$string['xlsxformname'] = 'Foglio di calcolo';
$string['docxfformname'] = 'Modello di modulo';
$string['uploadformname'] = 'Carica file';
$string['modulename'] = 'Documento ONLYOFFICE';
$string['modulenameplural'] = 'Documenti ONLYOFFICE';
$string['modulename_help'] = 'Modulo ONLYOFFICE consente di creare e modificare i documenti di office archiviati localmente in Moodle utilizzando ONLYOFFICE Document Server, permette a più utenti di collaborare in tempo reale e di salvare le modifiche in Moodle';
$string['pluginname'] = 'Documento ONLYOFFICE';
$string['pluginadministration'] = 'Amministrazione dell'attività Documenti di ONLYOFFICE';
$string['onlyofficename'] = 'Nome dell'attività';

$string['onlyofficeactivityicon'] = 'Aprire in ONLYOFFICE';
$string['onlyofficeeditor:addinstance'] = 'Aggiungi una nuova attività Documenti ONLYOFFICE';
$string['onlyofficeeditor:view'] = 'Visualizza l'attività Documenti ONLYOFFICE';

$string['documentserverurl'] = 'Indirizzo del servizio di modifica documenti';
$string['documentserverurl_desc'] = 'Indirizzo del servizio di modifica documenti specifica l'indirizzo del server con i servizi documenti installati. Sostituisci \'https://documentserver.url\' sopra con l'indirizzo corretto del server';
$string['documentserversecret'] = 'Chiave di Document Server';
$string['documentserversecret_desc'] = 'Chiave segreta viene utilizzata per generare il token (una firma crittografata) nel browser per aprire l'editor di documenti e chiamare i metodi e le richieste al servizio di comando documenti e al servizio di conversione documenti. Il token impedisce la sostituzione di parametri importanti nelle richieste di ONLYOFFICE Document Server.';
$string['allowedformats'] = 'Formati consentiti';
$string['allowedformats_desc'] = '';

$string['selectfile'] = 'Seleziona il file esistente o creane uno nuovo cliccando una delle icone';
$string['printintro'] = 'Stampa il testo intro';
$string['printintroexplain'] = '';
$string['documentpermissions'] = 'Autorizzazioni per documenti';
$string['download'] = 'E possibile scaricare documento';
$string['download_help'] = 'Se è disabilitata gli documenti non saranno scaricabili tramite l'editor ONLYOFFICE. Nota: gli utenti con la funzionalità <strong>course:manageactivities</strong> possono sempre scaricare i documenti tramite l'applicazione.';
$string['download_desc'] = 'Consenti il download di documenti tramite l'editor ONLYOFFICE';
$string['print'] = 'E possibile stampare il documento';
$string['print_help'] = 'Se è disabilitata, gli documenti non saranno stampabili tramite l'editor ONLYOFFICE. Nota: gli utenti con la funzionalità <strong>course:manageactivities</strong> possono sempre stampare i documenti tramite l'applicazione.';
$string['print_desc'] = 'Consenti la stampa di documenti tramite l'editor ONLYOFFICE';
$string['protect'] = 'Nascondere la scheda Protezione';
$string['protect_help'] = 'Se è disabilitata, gli utenti hanno accesso alle impostazioni di protezione nell'editor ONLYOFFICE. Nota: gli utenti con la funzionalità <strong>course:manageactivities</strong> hanno sempre accesso alle impostazioni di protezione.';
$string['protect_desc'] = 'Consenti agli utenti di aprire la scheda Protezione nell'editor ONLYOFFICE';

$string['returntodocument'] = 'Torna alla pagina del corso';
$string['docserverunreachable'] = 'ONLYOFFICE Document Server non può essere raggiunto. Contatta amministratore';
$string['privacy:metadata'] = 'Nessuna informazione sui dati personali degli utenti viene memorizzata.';
$string['privacy:metadata:onlyofficeeditor:userid'] = 'L'effettivo ID utente non viene inviato all'editor ONLYOFFICE.';
$string['privacy:metadata:onlyofficeeditor:intro'] = 'Introduzione generale dell'attività ONLYOFFICE';
$string['privacy:metadata:onlyofficeeditor:introformat'] = 'Formato del campo intro (MOODLE, HTML, MARKDOWN...).';
$string['privacy:metadata:onlyofficeeditor:permissions'] = 'Autorizzazioni per documenti.';
$string['privacy:metadata:onlyofficeeditor:name'] = 'Nome dell'attività ONLYOFFICE.';
$string['privacy:metadata:onlyofficeeditor:course'] = 'Corso a cui appartiene l'attività ONLYOFFICE';
$string['privacy:metadata:onlyofficeeditor'] = 'Informazioni sui documenti modificati con ONLYOFFICE.';
$string['privacy:metadata:onlyofficeeditor:core_files'] = 'Attività Documenti ONLYOFFICE memorizza i documenti che sono stati modificati.';
$string['forcesave'] = 'Abilita salvataggio forzato';
$string['editor_view'] = 'Impostazioni di personalizzazione dell'editor';
$string['editor_view_chat'] = 'Visualizza il pulsante del menu Chat';
$string['editor_view_help'] = 'Visualizza il pulsante del menu Guida';
$string['editor_view_header'] = 'Visualizza l'intestazione più compatta';
$string['editor_view_feedback'] = 'Visualizza il pulsante del menu Feedback e Supporto';
$string['editor_view_toolbar'] = 'Visualizza intestazione della barra degli strumenti monocromatica';

$string['oldversion'] = 'Si prega di aggiornare ONLYOFFICE Docs alla versione 7.0 per lavorare su moduli compilabili online';
$string['saveaserror'] = 'Qualcosa è andato storto.';
$string['saveassuccess'] = 'Il documento è stato salvato con successo.';
$string['saveastitle'] = 'Seleziona la sezione del corso per salvare il documento';
$string['saveasbutton'] = 'Seleziona';
