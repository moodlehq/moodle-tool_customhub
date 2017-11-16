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

use stdClass;
use Exception;
use moodle_exception;
use moodleform;
use webservice_xmlrpc_client;
use core_text;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * This form display a hub selector.
 * The hub list is retrieved from Moodle.org hub directory.
 * Also displayed, a text field to enter private hub url + its password
 */
class hub_selector_form extends moodleform {

    public function definition() {
        global $CFG, $OUTPUT;
        $mform = & $this->_form;
        $mform->addElement('header', 'site', get_string('selecthub', 'tool_customhub'));

        //retrieve the hub list on the hub directory by web service
        /*$function = 'hubdirectory_get_hubs';
        $params = array();
        $serverurl = HUB_HUBDIRECTORYURL . "/local/hubdirectory/webservice/webservices.php";
        require_once($CFG->dirroot . "/webservice/xmlrpc/lib.php");
        $xmlrpcclient = new webservice_xmlrpc_client($serverurl, 'publichubdirectory');
        try {
            $hubs = $xmlrpcclient->call($function, $params);
        } catch (Exception $e) {
            $error = $OUTPUT->notification(get_string('errorhublisting', 'hub', $e->getMessage()));
            $mform->addElement('static', 'errorhub', '', $error);
            $hubs = array();
        }

        //remove moodle.org from the hub list
        foreach ($hubs as $key => $hub) {
            if ($hub['url'] == HUB_MOODLEORGHUBURL || $hub['url'] == HUB_OLDMOODLEORGHUBURL) {
                unset($hubs[$key]);
            }
        }

        //Public hub list
        $options = array();
        foreach ($hubs as $hub) {
            //to not display a name longer than 100 character (too big)
            if (core_text::strlen($hub['name']) > 100) {
                $hubname = core_text::substr($hub['name'], 0, 100);
                $hubname = $hubname . "...";
            } else {
                $hubname = $hub['name'];
            }
            $options[$hub['url']] = $hubname;
            $mform->addElement('hidden', clean_param($hub['url'], PARAM_ALPHANUMEXT), $hubname);
            $mform->setType(clean_param($hub['url'], PARAM_ALPHANUMEXT), PARAM_ALPHANUMEXT);
        }
        if (!empty($hubs)) {
            $mform->addElement('select', 'publichub', get_string('publichub', 'hub'),
                $options, array("size" => 15));
            $mform->setType('publichub', PARAM_URL);
        }

        $mform->addElement('static', 'or', '', get_string('orenterprivatehub', 'hub'));
        */

        //Private hub
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
        global $CFG;
        $errors = parent::validation($data, $files);

        $unlistedurl = $this->_form->_submitValues['unlistedurl'];

        if (empty($unlistedurl)) {
            $errors['unlistedurl'] = get_string('badurlformat', 'hub');
        }

        return $errors;
    }

}
