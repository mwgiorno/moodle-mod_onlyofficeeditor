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
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright   based on work by 2018 Olumuyiwa <muyi.taiwo@logicexpertise.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['docxformname'] = 'Document';
$string['pptxformname'] = 'Presentation';
$string['xlsxformname'] = 'Spreadsheet';
$string['uploadformname'] = 'Upload file';
$string['modulename'] = 'ONLYOFFICE document';
$string['modulenameplural'] = 'ONLYOFFICE documents';
$string['modulename_help'] = 'The ONLYOFFICE module enables the users to create and edit office documents stored locally in Moodle using ONLYOFFICE Document Server, allows multiple users to collaborate in real time and to save back those changes to Moodle';
$string['pluginname'] = 'ONLYOFFICE document';
$string['pluginadministration'] = 'ONLYOFFICE document activity administration';
$string['onlyofficename'] = 'Activity Name';

$string['onlyofficeactivityicon'] = 'Open in ONLYOFFICE';
$string['onlyoffice:addinstance'] = 'Add a new ONLYOFFICE document activity';
$string['onlyoffice:view'] = 'View ONLYOFFICE document activity';

$string['documentserverurl'] = 'Document Editing Service Address';
$string['documentserverurl_desc'] = 'The Document Editing Service Address specifies the address of the server with the document services installed. Please replace \'https://documentserver.url\' above with the correct server address';
$string['documentserversecret'] = 'Document Server Secret';
$string['documentserversecret_desc'] = 'The secret is used to generate the token (an encrypted signature) in the browser for the document editor opening and calling the methods and the requests to the document command service and document conversion service. The token prevents the substitution of important parameters in ONLYOFFICE Document Server requests.';
$string['allowedformats'] = 'Allowed formats';
$string['allowedformats_desc'] = '';

$string['selectfile'] = 'Select existing file or create new by clicking one of the icons';
$string['printintro'] = 'Print intro text';
$string['printintroexplain'] = '';
$string['documentpermissions'] = 'Document permissions';
$string['download'] = 'Document can be downloaded';
$string['download_help'] = 'If this is off, documents will not be downloadable in the ONLYOFFICE editor app. Note, users with <strong>course:manageactivities</strong> capability are always able to download documents via the app';
$string['download_desc'] = 'Allow documents to be downloaded via the ONLYOFFICE editor app';
$string['print'] = 'Document can be printed';
$string['print_help'] = 'If this is off, documents will not be printable via the ONLYOFFICE editor app. Note, users with <strong>course:manageactivities</strong> capability are always able to print documents via the app';
$string['print_desc'] = 'Allow documents to be printed via the ONLYOFFICE editor app';

$string['returntodocument'] = 'Return to course page';
$string['docserverunreachable'] = 'ONLYOFFICE Document Server cannot be reached. Please contact admin';
