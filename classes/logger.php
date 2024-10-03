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
 * Simple logger.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2024 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright   based on work by 2018 Olumuyiwa <muyi.taiwo@logicexpertise.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_onlyofficeeditor;

use core_reportbuilder\local\filters\date;

/**
 * Simple logger class.
 *
 * @package     mod_onlyofficeeditor
 * @subpackage
 * @copyright   2024 Ascensio System SIA <integration@onlyoffice.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class logger {
    /**
     * Log filename
     */
    const LOG_FILENAME = 'logs.txt';

    /**
     * @var string log file path
     */
    private string $logfilepath;
    /**
     * @var array logs array
     */
    private array $log = [];

    /**
     * Logger class constructor
     *
     * @return void
     */
    public function __construct() {
        global $CFG;
        $this->logfilepath = $CFG->dataroot . DIRECTORY_SEPARATOR . self::LOG_FILENAME;
    }

    /**
     * Add log entry
     *
     * @param mixed $message
     * @param mixed $name
     * @return void
     */
    public function add(string $message, string $name = ''): void {
        $logentry = [
            'time' => date("Y-m-d H:i"),
            'name' => $name,
            'message' => $message,
        ];

        $this->log[] = $logentry;
    }

    /**
     * Dump logs to file
     *
     * @return void
     */
    public function dump(): void {
        if (file_exists($this->logfilepath)) {
            $logs = '';
            foreach ($this->log as $logentry) {
                $logs .= $this->format_log($logentry);
            }
            file_put_contents(
                $this->logfilepath,
                $logs,
                FILE_APPEND | LOCK_EX,
            );
            $this->log = [];
        }
    }

    /**
     * Format log entry
     * @param array $logentry
     *
     * @return string
     */
    private function format_log(array $logentry): string {
        $entry = '';

        $entry .= "DEBUG: (" . PHP_EOL;
        $entry .= "time: " . $logentry['time'] . PHP_EOL;
        $entry .= "name: " . ($logentry['name'] ?? "Default") . PHP_EOL;
        $entry .= "message: " . $logentry['message'] . PHP_EOL;
        $entry .= ")" . PHP_EOL;

        return $entry;
    }
}
