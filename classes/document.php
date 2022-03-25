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
 * @copyright   2022 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright   based on work by 2018 Olumuyiwa <muyi.taiwo@logicexpertise.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyofficeeditor;

/**
 * Document class.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2022 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright   based on work by 2018 Olumuyiwa <muyi.taiwo@logicexpertise.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class document {

    /**
     * Get document key.
     * @param cm_info $cm information about that course-module.
     * @return mixed document key.
     */
    public static function get_key($cm) {
        global $DB;
        if (!$key = $DB->get_field('onlyofficeeditor', 'documentkey', ['id' => $cm->instance])) {
            $key = random_string(20);
            $DB->set_field('onlyofficeeditor', 'documentkey', $key, ['id' => $cm->instance]);
        }
        return $key;
    }

    /**
     * Set document key.
     * @param cm_info $cm information about that course-module.
     */
    public static function set_key($cm) {
        global $DB;
        $key = random_string(20);
        $DB->set_field('onlyofficeeditor', 'documentkey', $key, ['id' => $cm->instance]);
    }

    /**
     * Get document permissions.
     * @param context_module $context context instance.
     * @param cm_info $cm information about that course-module.
     * @return array permissions of editor config.
     */
    public static function get_permissions($context, $cm) {
        global $DB;
        $canmanage = has_capability('moodle/course:manageactivities', $context);
        $canedit = has_capability('mod/onlyofficeeditor:editdocument', $context);
        $editorperms = $DB->get_field('onlyofficeeditor', 'permissions', ['id' => $cm->instance]);
        $permissions = \array_map('boolval', unserialize($editorperms));
        $permissions['print'] = empty($permissions['print']) ? $canmanage : true;
        $permissions['download'] = empty($permissions['download']) ? $canmanage : true;

        $permissions['edit'] = $canedit;
        $permissions['review'] = $canedit;

        return $permissions;
    }

}
