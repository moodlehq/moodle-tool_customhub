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
 * Strings for tool_customhub
 *
 * @package    tool_customhub
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Custom hub communication';
$string['publishcourse'] = 'Publish on hub';
$string['customhub:publishcourse'] = 'Publish courses on custom hubs';

$string['advertise'] = 'Advertise this course for people to join';
$string['advertisepublication_help'] = 'Advertising your course on a community hub server allows people to find this course and come here to enrol.';
$string['share'] = 'Share this course for people to download';
$string['sharepublication_help'] = 'Uploading this course to a community hub server will enable people to download it and install it on their own Moodle sites.';
$string['removefromhub'] = 'Remove from hub';
$string['taskregistrationcron'] = 'Update registration on custom hubs';
$string['xmlrpcdisabledregistration'] = 'The XML-RPC extension is not enabled on the server. You will not be able to unregister or update your registration until you enable it.';
$string['moodlenetnotsupported'] = 'Registration on moodle.net is not supported by this tool.';
$string['existingscreenshotnumber'] = '{$a} existing screenshots. You will be able to see these screenshots on this page, only once the hub administrator enables your course.';

// Deprecated strings from core_admin:
$string['hubs'] = 'Hubs';
// Deprecated strings from core_hub:
$string['selecthub'] = 'Select hub';
$string['privatehuburl'] = 'Private hub URL';
$string['registerwith'] = 'Register with a hub';
$string['privacy'] = 'Privacy';
$string['privacy_help'] = 'The hub may want to display a list of registered sites. If it does then you can choose whether or not you want to appear on that list.';
$string['registeredon'] = 'Where your site is registered';
$string['hub'] = 'Hub';
$string['selecthubinfo'] = 'A community hub is a server that lists courses. You can only share your courses on hubs that this Moodle site is registered with.  If the hub you want is not listed below, please contact your site administrator.';
$string['advertiseonhub'] = 'Share this course for people to join';
$string['publishon'] = 'Share on';
$string['shareonhub'] = 'Upload this course to a hub';
$string['siteupdatedcron'] = 'Site registration updated on "{$a}"';
$string['errorcron'] = 'An error occurred during registration update on "{$a->hubname}" ({$a->errormessage})';
$string['errorcronnoxmlrpc'] = 'XML-RPC must be enabled in order to update the registration.';
