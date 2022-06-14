<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see https://www.gnu.org/licenses/.

/**
 * Provides the {@see xmldb_local_helloworld_upgrade()} function.
 *
 * @package     local_helloworld
 * @category    upgrade
 * @copyright   2020 Your Name <email@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Define upgrade steps to be performed to upgrade the plugin from the old version to the current one.
 *
 * @param int $oldversion Version number the plugin is being upgraded from.
 */
function xmldb_local_helloworld_upgrade($oldversion) {

    if ($oldversion < 2022012500) {
        // Here goes the code that needs to be executed.
        set_config('foo', 'bar', 'local_helloworld');

        upgrade_plugin_savepoint(true, 2022012500, 'local', 'helloworld');
    }

    return true;
}