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
 * Onlyoffice convert service.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyoffice;

use Firebase\JWT\JWT;

defined('MOODLE_INTERNAL') || die();

/**
 * Onlyoffice convert service class.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class converter{

    /** Convert service url. */
    const DOC_SERV_CONVERT_URL = 'ConvertService.ashx';

    /** Request timeout convert service. */
    const DOC_SERV_TIMEOUT = '120000';

    /** Default JWT header. */
    const JWT_HEADER = 'Authorization';

    /**
     * The method is to convert the file to the required format.
     *
     * @param string $documenturi Uri for the document to convert.
     * @param string $fromext Document extension.
     * @param string $toext Extension to which to convert.
     * @param string $documentkey Key for caching on service.
     * @param bool $isasync Perform conversions asynchronously.
     *
     * @return int The percentage of completion of conversion.
     * @throws \dml_exception
     * @throws \Exception
     */
    public static function get_converted_uri($documenturi, $fromext, $toext, $documentkey, $isasync) {
        global $USER;
        $region = util::PATH_LOCALE[$USER->lang];
        $documentkey = $documentkey . $fromext;
        $response_from_convert_service = self::send_request_to_convert_service($documenturi, $fromext, $toext, $documentkey, $isasync, $region);
        $json = json_decode($response_from_convert_service, true);

        $errorelement = $json["error"];
        if ($errorelement != NULL && $errorelement != "") {
            $errormsg = 'Error occurred in the document service. Error code: ' . $errorelement;
            throw new \Exception($errormsg);
        }

        $isendconvert = $json["endConvert"];
        $converteddocumenturi = $json["fileUrl"];

        if ($isendconvert == null || $isendconvert == false || $converteddocumenturi == null) {
            throw new \Exception('endConvert is false or fileUrl is empty');
        }
        return $converteddocumenturi;
    }

    /**
     * Request for conversion to a service.
     *
     * @param string $documenturi Uri for the document to convert.
     * @param string $fromextension Document extension.
     * @param string $toextension Extension to which to convert.
     * @param string $documentkey Key for caching on service.
     * @param bool $isasync Perform conversions asynchronously.
     * @param string $region User region.
     * @return false|Document|string
     * @throws \dml_exception
     */
    public static function send_request_to_convert_service($documenturi, $fromextension, $toextension, $documentkey, $isasync, $region) {
        $docservurl = get_config('onlyoffice', 'documentserverurl');
        $urltoconverter = substr($docservurl, -1) == '/' ? $docservurl . self::DOC_SERV_CONVERT_URL
            : $docservurl . '/' . self::DOC_SERV_CONVERT_URL;

        $arr = [
            "async" => $isasync,
            "url" => $documenturi,
            "outputtype" => trim($toextension,'.'),
            "filetype" => trim($fromextension, '.'),
            "key" => $documentkey,
            "region" => $region
        ];

        $headertoken = "";

        if (!empty($secret = get_config('onlyoffice', 'documentserversecret'))) {
            $headertoken = JWT::encode(["payload" => $arr], $secret);
            $arr["token"] = JWT::encode($arr, $secret);
        }

        $data = json_encode($arr);

        $opts = array(
            'http' => array(
            'method'  => 'POST',
            'timeout' => self::DOC_SERV_TIMEOUT,
            'header'=> "Content-type: application/json\r\n" .
                "Accept: application/json\r\n" .
                (empty($headertoken) ? "" : self::JWT_HEADER.": Bearer $headertoken\r\n"),
            'content' => $data
            )
        );

        if (substr($urltoconverter, 0, strlen("https")) === "https") {
            $opts['ssl'] = array( 'verify_peer'   => FALSE );
        }

        $context = stream_context_create($opts);
        $response_data = file_get_contents($urltoconverter, FALSE, $context);

        return $response_data;
    }

}
