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
 * Class site_unregistration_form.
 *
 * @package    tool_customhub
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_customhub;

use moodleform;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * This form display a unregistration form.
 *
 * @package    tool_customhub
 * @copyright  Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
class site_unregistration_form extends moodleform {

    public function definition() {
        $mform = & $this->_form;
        $mform->addElement('header', 'site', get_string('unregister', 'tool_customhub'));

        $huburl = $this->_customdata['huburl'];
        $hubname = $this->_customdata['hubname'];

        $unregisterlabel = get_string('unregister', 'tool_customhub');
        $mform->addElement('checkbox', 'unpublishalladvertisedcourses', '',
            ' ' . get_string('unpublishalladvertisedcourses', 'tool_customhub'));
        $mform->setType('unpublishalladvertisedcourses', PARAM_INT);
        $mform->addElement('checkbox', 'unpublishalluploadedcourses', '',
            ' ' . get_string('unpublishalluploadedcourses', 'tool_customhub'));
        $mform->setType('unpublishalluploadedcourses', PARAM_INT);

        $mform->addElement('hidden', 'confirm', 1);
        $mform->setType('confirm', PARAM_INT);
        $mform->addElement('hidden', 'unregistration', 1);
        $mform->setType('unregistration', PARAM_INT);
        $mform->addElement('hidden', 'huburl', $huburl);
        $mform->setType('huburl', PARAM_URL);
        $mform->addElement('hidden', 'hubname', $hubname);
        $mform->setType('hubname', PARAM_TEXT);

        $this->add_action_buttons(true, $unregisterlabel);
    }

}
