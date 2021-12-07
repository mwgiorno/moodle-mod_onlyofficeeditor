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
 * ONLYOFFICE module admin settings and defaults
 *
 * @package    mod_onlyoffice
 * @copyright  2021 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright  based on work by 2018 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use mod_onlyoffice\util;

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $defaulthost = 'https://documentserver.url';
    $settings->add(new admin_setting_configtext('onlyoffice/documentserverurl',
        get_string('documentserverurl', 'onlyoffice'), get_string('documentserverurl_desc', 'onlyoffice'), $defaulthost));
    $settings->add(new admin_setting_configtext('onlyoffice/documentserversecret',
        get_string('documentserversecret', 'onlyoffice'), get_string('documentserversecret_desc', 'onlyoffice'), ''));

    $settings->add(new admin_setting_heading('onlyoffice/editor_allow_filetype',
        get_string('editor_allow_filetype', 'onlyoffice'), get_string('editor_allow_filetype_desc', 'onlyoffice')));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_csv',
        'csv', '', 1));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_odp',
        'odp', '', 0));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_ods',
        'ods', '', 0));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_odt',
        'odt', '', 0));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_rtf',
        'rtf', '', 0));
    $settings->add(new admin_setting_configcheckbox('onlyoffice/editor_allow_txt',
        'txt', '', 1));
}
