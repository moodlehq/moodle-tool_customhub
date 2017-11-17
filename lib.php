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
 * Callbacks for tool_customhub
 *
 * @package    tool_customhub
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * This function extends the navigation with the tool items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass        $course     The course to object for the tool
 * @param context         $context    The context of the course
 */
function tool_customhub_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('tool/customhub:publishcourse', $context)) {
        $url = new moodle_url('/admin/tool/customhub/publishcourse.php', array('id' => $course->id));
        $node = navigation_node::create(get_string('publishcourse', 'tool_customhub'), $url, navigation_node::TYPE_SETTING,
            null, null, new pix_icon('i/publish', ''));

        $beforekey = null;
        $childrenkeylist = $navigation->get_children_key_list();
        if (($publishindex = array_search('publish', $childrenkeylist)) !== false && $publishindex < count($childrenkeylist) - 1) {
            $beforekey = $childrenkeylist[$publishindex + 1];
        }

        $navigation->add_node($node, $beforekey);
    }
}

/**
 * Callback called from /admin/registration/confirmregistration.php
 */
function tool_customhub_confirm_registration() {
    redirect(new moodle_url('/admin/tool/customhub/confirmregistration.php', $_GET));
}