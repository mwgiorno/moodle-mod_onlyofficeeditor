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
 * Key and permissions for document.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2023 Ascensio System SIA <integration@onlyoffice.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyofficeeditor;

use curl;

/**
 * Document class.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2023 Ascensio System SIA <integration@onlyoffice.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class document_service {

    /**
     * Get document conversion url.
     * @param string $documenturi original file source.
     * @param string $from original file format.
     * @param string $to format to which to convert.
     * @param string $key document key.
     * @return string source url for converted document
     */
    public static function get_conversion_url($documenturi, $from, $to, $key) {
        $modconfig = get_config('onlyofficeeditor');

        $curl = new curl();
        $curl->setHeader(['Content-type: application/json']);
        $curl->setHeader(['Accept: application/json']);

        $conversionbody = [
            "async" => false,
            "url" => $documenturi,
            "outputtype" => $to,
            "filetype" => $from,
            "title" => $key . '.' . $from,
            "key" => $key
        ];

        if (!empty($modconfig->documentserversecret)) {
            $params = [
                'payload' => $conversionbody
            ];
            $token = \mod_onlyofficeeditor\jwt_wrapper::encode($params, $modconfig->documentserversecret);
            $jwtheader = !empty($modconfig->jwtheader) ? $modconfig->jwtheader : 'Authorization';
            $curl->setHeader([$jwtheader . ': Bearer ' . $token]);

            $token = \mod_onlyofficeeditor\jwt_wrapper::encode($conversionbody, $modconfig->documentserversecret);
            $conversionbody['token'] = $token;
        }

        $conversionbody = json_encode($conversionbody);
        $conversionurl = $modconfig->documentserverurl . '/ConvertService.ashx';

        $response = $curl->post($conversionurl, $conversionbody);

        $conversionjson = json_decode($response);
        if (isset($conversionjson->error)) {
            return '';
        }

        if (isset($conversionjson->endConvert) && $conversionjson->endConvert) {
            return $conversionjson->fileUrl;
        }

        return '';
    }
}
