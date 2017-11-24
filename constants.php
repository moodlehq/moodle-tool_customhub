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
 * Constants
 *
 * @package    tool_customhub
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Site privacy: private
 */
define('HUB_SITENOTPUBLISHED', 'notdisplayed');

/**
 * Site privacy: public
 */
define('HUB_SITENAMEPUBLISHED', 'named');

/**
 * Site privacy: public and global
 */
define('HUB_SITELINKPUBLISHED', 'linked');


defined('MOODLE_INTERNAL') || die;


define('HUB_LASTMODIFIED_WEEK', 7);

define('HUB_LASTMODIFIED_FORTEENNIGHT', 14);

define('HUB_LASTMODIFIED_MONTH', 30);

//// AUDIENCE ////

/**
 * Audience: educators
 */
define('HUB_AUDIENCE_EDUCATORS', 'educators');

/**
 * Audience: students
 */
define('HUB_AUDIENCE_STUDENTS', 'students');

/**
 * Audience: admins
 */
define('HUB_AUDIENCE_ADMINS', 'admins');

///// EDUCATIONAL LEVEL /////

/**
 * Educational level: primary
 */
define('HUB_EDULEVEL_PRIMARY', 'primary');

/**
 * Educational level: secondary
 */
define('HUB_EDULEVEL_SECONDARY', 'secondary');

/**
 * Educational level: tertiary
 */
define('HUB_EDULEVEL_TERTIARY', 'tertiary');

/**
 * Educational level: government
 */
define('HUB_EDULEVEL_GOVERNMENT', 'government');

/**
 * Educational level: association
 */
define('HUB_EDULEVEL_ASSOCIATION', 'association');

/**
 * Educational level: corporate
 */
define('HUB_EDULEVEL_CORPORATE', 'corporate');

/**
 * Educational level: other
 */
define('HUB_EDULEVEL_OTHER', 'other');

///// FILE TYPES /////

/**
 * FILE TYPE: COURSE SCREENSHOT
 */
define('HUB_SCREENSHOT_FILE_TYPE', 'screenshot');

/**
 * FILE TYPE: HUB SCREENSHOT
 */
define('HUB_HUBSCREENSHOT_FILE_TYPE', 'hubscreenshot');

/**
 * FILE TYPE: BACKUP
 */
define('HUB_BACKUP_FILE_TYPE', 'backup');
