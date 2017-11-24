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
 * Class hub_selector_form.
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
 * This form display a hub selector.
 * The hub list is retrieved from Moodle.org hub directory.
 * Also displayed, a text field to enter private hub url + its password
 *
 * @package    tool_customhub
 * @copyright  Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
class hub_selector_form extends moodleform {

    public function definition() {
        $mform = & $this->_form;
        $mform->addElement('header', 'site', get_string('selecthub', 'tool_customhub'));

        $mform->addElement('text', 'unlistedurl', get_string('privatehuburl', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->setType('unlistedurl', PARAM_URL);
        $mform->addElement('text', 'password', get_string('password'),
            array('class' => 'registration_textfield'));
        $mform->setType('password', PARAM_RAW);

        $this->add_action_buttons(false, get_string('selecthub', 'tool_customhub'));
    }

    /**
     * Check the unlisted URL is a URL
     */
    function validation($data, $files) {
        $errors = parent::validation($data, $files);

        $unlistedurl = $this->_form->_submitValues['unlistedurl'];

        if (empty($unlistedurl)) {
            $errors['unlistedurl'] = get_string('badurlformat', 'tool_customhub');
        }

        return $errors;
    }

}
