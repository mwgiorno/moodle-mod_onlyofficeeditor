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

namespace mod_onlyoffice;

defined('MOODLE_INTERNAL') || die();

class util {

    const STATUS_NOTFOUND = 0;
    const STATUS_EDITING = 1;
    const STATUS_MUSTSAVE = 2;
    const STATUS_ERRORSAVING = 3;
    const STATUS_CLOSEDNOCHANGES = 4;
    const STATUS_FORCESAVE = 6;
    const STATUS_ERRORFORCESAVE = 7;

    /** Path locales to create file from ONLYOFFICE template. */
    const PATH_LOCALE = [
        "az" => "az-Latn-AZ",
        "bg" => "bg-BG",
        "cs" => "cs-CZ",
        "de" => "de-DE",
        "el" => "el-GR",
        "en-GB" => "en-GB",
        "en" => "en-US",
        "es" => "es-ES",
        "fr" => "fr-FR",
        "it" => "it-IT",
        "ja" => "ja-JP",
        "ko" => "ko-KR",
        "lv" => "lv-LV",
        "nl" => "nl-NL",
        "pl" => "pl-PL",
        "pt-BR" => "pt-BR",
        "pt" => "pt-PT",
        "ru" => "ru-RU",
        "sk" => "sk-SK",
        "sv" => "sv-SE",
        "uk" => "uk-UA",
        "vi" => "vi-VN",
        "zh" => "zh-CN"];

    /** Mimetypes should convert back. */
    const SHOULD_CONVERT_BACK = [
        'application/vnd.oasis.opendocument.text',
        'application/vnd.oasis.opendocument.spreadsheet',
        'application/vnd.oasis.opendocument.presentation',
        'text/plain',
        'text/csv',
        'application/rtf',
        'application/x-rtf',
        'text/richtext'
    ];

    public static function get_appkey() {
        $key = get_config('onlyoffice', 'appkey');
        if (empty($key)) {
            $key = number_format(round(microtime(true) * 1000), 0, ".", "");
            set_config('appkey', $key, 'onlyoffice');
        }
        return $key;
    }

    public static function save_document_permissions($data) {
        $permissions = [];
        if (!empty($data->download)) {
            $permissions['download'] = 1;
        }
        if (!empty($data->print)) {
            $permissions['print'] = 1;
        }
        $data->permissions = serialize($permissions);
    }

    public static function save_file($data) {
        $cmid = $data->coursemodule;
        $draftitemid = $data->file;

        $context = \context_module::instance($cmid);
        if ($draftitemid) {
            $options = ['subdirs' => false];
            file_save_draft_area_files($draftitemid, $context->id, 'mod_onlyoffice', 'content', 0, $options);
        }
    }

    public static function get_connection_info($url) {
        $ch = new \curl();
        $ch->get($url);
        $info = $ch->get_info();
        return $info;
    }

    /**
     * Save new or changed file.
     *
     * @param array $data callback json.
     * @param object $hash encoded object.
     * @param bool $isforcesave forcesave is enabled or not.
     * @return bool saved or error.
     *
     * @throws \Exception
     */
    public static function save_document_to_moodle($data, $hash, $isforcesave) {
        $downloadurl = $data['url'];
        $fs = get_file_storage();
        if ($file = $fs->get_file_by_hash($hash->pathnamehash)) {
            $curext = strtolower('.' . pathinfo($file->get_filename(), PATHINFO_EXTENSION));
            $downloadext = strtolower('.' . pathinfo($downloadurl, PATHINFO_EXTENSION));
            $mimetype = $file->get_mimetype();
            if (in_array($mimetype, self::SHOULD_CONVERT_BACK)) {
                $key = document::get_key($hash->cm);
                $converteduri = '';
                try {
                    $percent = converter::get_converted_uri($downloadurl, $downloadext, $curext, $key, false, $converteduri);
                    if (!empty($converteduri)) {
                        $downloadurl = $converteduri;
                    }
                } catch (\Exception $e) {
                    throw new \Exception('Error while converting document back to original format: ' . $e->getMessage());
                }
            }
            $fr = array(
                'contextid' => $file->get_contextid(),
                'component' => $file->get_component(),
                'filearea' => 'draft',
                'itemid' => $file->get_itemid(),
                'filename' => $file->get_filename() . '_temp',
                'filepath' => '/',
                'userid' => $file->get_userid(),
                'timecreated' => $file->get_timecreated());
            try {
                $newfile = $fs->create_file_from_url($fr, $downloadurl);
                $file->replace_file_with($newfile);
                $file->set_timemodified(time());
                $newfile->delete();
                if (!$isforcesave) {
                    \mod_onlyoffice\document::set_key($hash->cm);
                }
                return true;
            } catch (\moodle_exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Generate new module for converted file;
     * @param object $moduleinfo Onlyoffice module info.
     * @param object $course Course.
     * @param object $cm Course module.
     * @return object|\stdClass
     * @throws \moodle_exception
     */
    public static function generate_new_module_info($moduleinfo, $course, $cm) {
        $newmoduleinfo = $moduleinfo;
        $newtime = time();
        $permissions = unserialize($moduleinfo->permissions);

        $newmoduleinfo->download = $permissions['download'];
        $newmoduleinfo->print = $permissions['print'];
        $newmoduleinfo->instance = 0;
        $newmoduleinfo->coursemodule = 0;
        $newmoduleinfo->section = $cm->section - 1;
        $newmoduleinfo->course = $course->id;
        $newmoduleinfo->add = 'onlyoffice';
        $newmoduleinfo->cmidnumber = '';
        $newmoduleinfo->completionunlocked = 1;
        $newmoduleinfo->completion = $cm->completion;
        $newmoduleinfo->completionexpected = $cm->completionexpected;
        $newmoduleinfo->showdescription = $cm->showdescription;
        $newmoduleinfo->visible = $cm->visible;
        $newmoduleinfo->visibleoncoursepage = $cm->visibleoncoursepage;
        $newmoduleinfo->tags = [];
        $newmoduleinfo->update = 0;
        $newmoduleinfo->return = 0;
        $newmoduleinfo->sr = 0;
        $newmoduleinfo->competencies = [];
        $newmoduleinfo->competency_rule = 0;
        $newmoduleinfo->timecreated = $newtime;
        $newmoduleinfo->timemodified = $newtime;
        $newmoduleinfo->documentkey = null;
        $newmoduleinfo->availabilityconditionsjson = '{"op":"&","c":[],"showc":[]}';

        $newmoduleinfo = add_moduleinfo($newmoduleinfo, $course);
        return $newmoduleinfo;
    }

}
