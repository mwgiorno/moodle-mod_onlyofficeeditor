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
 * Onlyoffice file utility.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyoffice;


defined('MOODLE_INTERNAL') || die();

/**
 * Onlyoffice file utility class.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class onlyoffice_file_utility{

    /**
     * Get accepted spreadsheets exntensions.
     * @return string[] Accepted extensions of spreadsheet files
     */
    public static function get_accepted_spreadsheet_formats(){
        return array('.xls', '.xlsx', '.xlsm',
            '.xlt', '.xltx', '.xltm',
            '.ods', '.fods', '.ots', '.csv');
    }

    /**
     * Get accepted document extensions.
     * @return string[] Accepted extensions of document files.
     */
    public static function get_accepted_document_formats(){
        return array('.doc', '.docx', '.docm',
            '.dot', '.dotx', '.dotm',
            '.odt', '.fodt', '.ott', '.rtf', '.txt',
            '.html', '.htm', '.mht', '.xml',
            '.pdf', '.djvu', '.fb2', '.epub', '.xps', '.oxps');
    }

    /**
     * Get accepted presentation extensions.
     * @return string[] Accepted extensions of presentation files.
     */
    public static function get_accepted_presentation_formats(){
        return array('.pps', '.ppsx', '.ppsm',
            '.ppt', '.pptx', '.pptm',
            '.pot', '.potx', '.potm',
            '.odp', '.fodp', '.otp');
    }

    /**
     * Editable extensions.
     * @return string[] Editable extensions.
     */
    public static function get_editable_extensions() {
        return array('.docx', '.xlsx', '.pptx');
    }

    /**
     * Viewable extensions.
     * @return string[] Viewable extensions.
     */
    public static function get_viewable_extensions() {
        return array('.pdf', '.djvu', '.xps', '.oxps');
    }

    /**
     * Convertible extensions.
     * @return string[] Convertible extensions.
     */
    public static function get_convertible_exntensions() {
        return array('.docm', '.doc', '.dotx', '.dotm', '.dot', '.odt', '.fodt', '.ott',
            '.xlsm', '.xls', '.xltx', '.xltm', '.xlt', '.ods', '.fods', '.ots', '.pptm', '.ppt',
            '.ppsx', '.ppsm', '.pps', '.potx', '.potm', '.pot', '.odp', '.fodp', '.otp',
            '.rtf', '.mht', '.html', '.htm', '.xml', '.epub', '.fb2');
    }

    /**
     * Custom editable extensions.
     * @return string[] Custom editable extensions.
     * @throws \dml_exception
     */
    public static function get_custom_editable_extensions() {
        $config = (array)get_config('onlyoffice');
        $customeditableexts = array('txt', 'rtf', 'csv', 'odt', 'odp', 'ods');
        $array = array();
        foreach ($customeditableexts as $ext){
            if ($config['editor_allow_' . $ext] == 1) {
                $array[] = '.' . $ext;
            }
        }
        return $array;
    }

}
