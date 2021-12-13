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
 * Onlyoffice convert action.
 *
 * @package     mod_onlyoffice
 * @subpackage
 * @copyright   2021 Ascensio System SIA <integration@onlyoffice.com>
 * @license        http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(dirname(__FILE__) . '/lib.php');

use mod_onlyoffice\converter;

defined('AJAX_SCRIPT') or define('AJAX_SCRIPT', true);

$courseid = required_param('courseid', PARAM_INT);
$cmid = required_param('cmid', PARAM_INT);
$convertto = required_param('ext', PARAM_TEXT);
$result = optional_param('res', '', PARAM_TEXT);

require_login($courseid);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $percent = converter::create_new_converted_file($courseid, $cmid, $convertto);
    } catch (moodle_exception $e) {
        throw new \Exception($e);
    }
    echo json_encode(array('percent' => $percent));
} else {
    echo $OUTPUT->header();
    if ($result == 'suc') {
        echo $OUTPUT->notification(get_string('onlyofficeconvertsuccess', 'onlyoffice'), 'notifysuccess');
    } else if ($result == 'failure') {
        echo $OUTPUT->notification(get_string('onlyofficeconverterror', 'onlyoffice'), 'error');
    }
    echo $OUTPUT->continue_button($CFG->wwwroot . '/course/view.php?id=' . $courseid);
    echo $OUTPUT->footer();
}

die();
