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
     * Returns all users who can be mentioned in the comments.
     *
     * @param \context $context Module context.
     * @return array Users array for mentioning.
     * @throws \coding_exception
     */
    public static function get_users_to_mention_in_comments($context) {
        global $USER;
        $users = get_users_by_capability($context, 'mod/onlyoffice:view');
        $userstomention = array();
        foreach ($users as $user) {
            if ($user->id !== $USER->id) {
                $array = array('email' => $user->email, 'name' => $user->firstname . ' ' . $user->lastname);
                $userstomention[] =& $array;
            }
        }
        return $userstomention;
    }

    /**
     * Send notification to users about mentioning in the comment.
     *
     * @param string $actionlink Link to the comment.
     * @param string $comment Comment text.
     * @param array $emails Emails of mentioned users.
     * @param \context $context Module context.
     * @return array Array of mentioned users.
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function mention_user_in_comment($actionlink, $comment, $emails, $context) {
        global $DB, $USER;
        $mentionedusers = array();
        $modulename = $context->get_context_name(false);
        $coursename = $context->get_course_context()->get_context_name(false);

        foreach ($emails as $email) {
            $user = $DB->get_record('user', array('email' => $email));
            $permission = has_capability('mod/onlyoffice:editdocument', $context, $user) ? 'Full Access' : 'Read only';
            $mentioneduser = ['permissions' => $permission, 'user' => $user->firstname . ' ' . $user->lastname];
            $mentionedusers[] =& $mentioneduser;

            $message = new \core\message\message();
            $message->component = 'mod_onlyoffice';
            $message->name = 'mentionnotifier';
            $message->userfrom = \core_user::get_noreply_user();
            $message->userto = $user;
            $message->subject = $USER->firstname . ' ' . $USER->lastname . ' ' . get_string('mentionnotifier:notification', 'onlyoffice');
            $message->fullmessageformat = FORMAT_HTML;
            $message->fullmessagehtml =
                '<p><strong>' . $USER->firstname . ' ' . $USER->lastname . '</strong> ' . get_string('mentionnotifier:notification', 'onlyoffice')
                . '<strong>' . $modulename . ' </strong>'
                . strtolower(get_string('course')) . ' <strong>' . $coursename . '</strong>:</p>'
                . '<p>' . $comment . '</p>';
            $message->notification = 1;
            $message->contexturl = $actionlink;
            $message->contexturlname = get_string('mentioncontexturlname', 'onlyoffice');

            $messageid = message_send($message);
        }
        return $mentionedusers;
    }

    public static function save_document_to_moodle($data, $hash, $isForcesave) {
        $downloadurl = $data['url'];
        $fs = get_file_storage();
        if ($file = $fs->get_file_by_hash($hash->pathnamehash)) {
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
                if (!$isForcesave) {
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

}
