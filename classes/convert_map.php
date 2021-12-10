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
 * Onlyoffice convert map.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyoffice;

defined('MOODLE_INTERNAL') || die();

/**
 * Onlyoffice convert map class.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class convert_map {

    /** Get convert map.
     * @return string[][] convert map.
     */
    public static function get_convert_map() {
        return array(
            '.djvu' =>  array('.bmp', '.gif', '.jpg', '.png'),
            '.doc' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.docm' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.docx' =>  array('.bmp', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.dot' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.dotm' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.dotx' =>  array('.bmp', '.docx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.epub' =>  array('.bmp', '.docx', '.dotx', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.fb2' =>  array('.bmp', '.docx', '.dotx', '.epub', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.fodt' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.html' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.mht' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.odt' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.ott' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),
            '.pdf' =>  array('.bmp', '.gif', '.jpg', '.png'),
            '.rtf' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.txt'),
            '.txt' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf'),
            '.xps' =>  array('.bmp', '.gif', '.jpg', '.pdf', '.pdfa', '.png'),
            '.xml' =>  array('.bmp', '.docx', '.dotx', '.epub', '.fb2', '.gif', '.html', '.jpg', '.odt', '.ott', '.pdf', '.pdfa', '.png', '.rtf', '.txt'),

            '.csv' => array('.bmp', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.fods' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.ods' => array('.bmp', '.csv', '.gif', '.jpg', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.ots' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.xls' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.xlsm' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.xlsx' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xltx'),
            '.xlt' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.xltm' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx', '.xltx'),
            '.xltx' => array('.bmp', '.csv', '.gif', '.jpg', '.ods', '.ots', '.pdf', '.pdfa', '.png', '.xlsx'),

            '.fodp' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.odp' => array('.bmp', '.gif', '.jpg', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.otp' => array('.bmp', '.gif', '.jpg', '.odp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.pot' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.potm' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.potx' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.pptx'),
            '.pps' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.ppsm' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.ppsx' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.ppt' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.pptm' => array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx', '.pptx'),
            '.pptx' =>  array('.bmp', '.gif', '.jpg', '.odp', '.otp', '.pdf', '.pdfa', '.png', '.potx')
        );
    }

}
