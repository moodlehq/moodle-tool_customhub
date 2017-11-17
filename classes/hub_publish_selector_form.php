<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/*
 * @package    course
 * @subpackage publish
 * @author     Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * The forms used for course publication
 */

namespace tool_customhub;

use moodleform;
use html_writer;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/*
 * Hub selector to choose on which hub we want to publish.
 */

class hub_publish_selector_form extends moodleform {

    public function definition() {
        global $CFG;
        $mform = & $this->_form;
        $share = $this->_customdata['share'];

        $mform->addElement('header', 'site', get_string('selecthub', 'tool_customhub'));

        $mform->addElement('static', 'info', '', get_string('selecthubinfo', 'tool_customhub') . html_writer::empty_tag('br'));

        $registrationmanager = new registration_manager();
        $registeredhubs = $registrationmanager->get_registered_on_hubs();

        //Public hub list
        $options = array();
        foreach ($registeredhubs as $hub) {

            $hubname = $hub->hubname;
            $mform->addElement('hidden', clean_param($hub->huburl, PARAM_ALPHANUMEXT), $hubname);
            $mform->setType(clean_param($hub->huburl, PARAM_ALPHANUMEXT), PARAM_ALPHANUMEXT);
            if (empty($hubname)) {
                $hubname = $hub->huburl;
            }
            $mform->addElement('radio', 'huburl', null, ' ' . $hubname, $hub->huburl);
            if ($hub->huburl == HUB_MOODLEORGHUBURL) {
                $mform->setDefault('huburl', $hub->huburl);
            }
        }

        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        if ($share) {
            $buttonlabel = get_string('shareonhub', 'tool_customhub');
            $mform->addElement('hidden', 'share', true);
            $mform->setType('share', PARAM_BOOL);
        } else {
            $buttonlabel = get_string('advertiseonhub', 'tool_customhub');
            $mform->addElement('hidden', 'advertise', true);
            $mform->setType('advertise', PARAM_BOOL);
        }

        $this->add_action_buttons(false, $buttonlabel);
    }

}
