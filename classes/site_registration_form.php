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
 * Class site_registration_form.
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
use context_course;
use core_collator;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * The site registration form. Information will be sent to a given hub.
 *
 * @package    tool_customhub
 * @copyright  Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
class site_registration_form extends moodleform {

    public function definition() {
        global $CFG, $DB;
        require_once($CFG->dirroot.'/'.$CFG->admin.'/tool/customhub/constants.php');

        $strrequired = get_string('required');
        $mform = & $this->_form;
        $huburl = $this->_customdata['huburl'];
        $hubname = $this->_customdata['hubname'];
        $password = $this->_customdata['password'];
        $admin = get_admin();
        $site = get_site();

        //retrieve config for this hub and set default if they don't exist
        $cleanhuburl = clean_param($huburl, PARAM_ALPHANUMEXT);
        $sitename = get_config('hub', 'site_name_' . $cleanhuburl);
        if ($sitename === false) {
            $sitename = format_string($site->fullname, true, array('context' => context_course::instance(SITEID)));
        }
        $sitedescription = get_config('hub', 'site_description_' . $cleanhuburl);
        if ($sitedescription === false) {
            $sitedescription = $site->summary;
        }
        $contactname = get_config('hub', 'site_contactname_' . $cleanhuburl);
        if ($contactname === false) {
            $contactname = fullname($admin, true);
        }
        $contactemail = get_config('hub', 'site_contactemail_' . $cleanhuburl);
        if ($contactemail === false) {
            $contactemail = $admin->email;
        }
        $contactphone = get_config('hub', 'site_contactphone_' . $cleanhuburl);
        if ($contactphone === false) {
            $contactphone = $admin->phone1;
        }
        $imageurl = get_config('hub', 'site_imageurl_' . $cleanhuburl);
        $privacy = get_config('hub', 'site_privacy_' . $cleanhuburl);
        $address = get_config('hub', 'site_address_' . $cleanhuburl);
        if ($address === false) {
            $address = '';
        }
        $region = get_config('hub', 'site_region_' . $cleanhuburl);
        $country = get_config('hub', 'site_country_' . $cleanhuburl);
        if (empty($country)) {
            $country = $admin->country ?: $CFG->country;
        }
        $language = get_config('hub', 'site_language_' . $cleanhuburl);
        if ($language === false) {
            $language = explode('_', current_language())[0];
        }
        $geolocation = get_config('hub', 'site_geolocation_' . $cleanhuburl);
        if ($geolocation === false) {
            $geolocation = '';
        }
        $contactable = get_config('hub', 'site_contactable_' . $cleanhuburl);
        $emailalert = get_config('hub', 'site_emailalert_' . $cleanhuburl);
        $emailalert = ($emailalert === false || $emailalert) ? 1 : 0;
        $coursesnumber = get_config('hub', 'site_coursesnumber_' . $cleanhuburl);
        $usersnumber = get_config('hub', 'site_usersnumber_' . $cleanhuburl);
        $roleassignmentsnumber = get_config('hub', 'site_roleassignmentsnumber_' . $cleanhuburl);
        $postsnumber = get_config('hub', 'site_postsnumber_' . $cleanhuburl);
        $questionsnumber = get_config('hub', 'site_questionsnumber_' . $cleanhuburl);
        $resourcesnumber = get_config('hub', 'site_resourcesnumber_' . $cleanhuburl);
        $badgesnumber = get_config('hub', 'site_badges_' . $cleanhuburl);
        $issuedbadgesnumber = get_config('hub', 'site_issuedbadges_' . $cleanhuburl);
        $mediancoursesize = get_config('hub', 'site_mediancoursesize_' . $cleanhuburl);
        $participantnumberaveragecfg = get_config('hub', 'site_participantnumberaverage_' . $cleanhuburl);
        $modulenumberaveragecfg = get_config('hub', 'site_modulenumberaverage_' . $cleanhuburl);

        //hidden parameters
        $mform->addElement('hidden', 'huburl', $huburl);
        $mform->setType('huburl', PARAM_URL);
        $mform->addElement('hidden', 'hubname', $hubname);
        $mform->setType('hubname', PARAM_TEXT);
        $mform->addElement('hidden', 'password', $password);
        $mform->setType('password', PARAM_RAW);

        //the input parameters
        $mform->addElement('header', 'moodle', get_string('registrationinfo', 'tool_customhub'));

        $mform->addElement('text', 'name', get_string('sitename', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->addRule('name', $strrequired, 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $sitename);
        $mform->addHelpButton('name', 'sitename', 'tool_customhub');

        $options = array();
        $registrationmanager = new registration_manager();
        $options[HUB_SITENOTPUBLISHED] = $registrationmanager->get_site_privacy_string(HUB_SITENOTPUBLISHED);
        $options[HUB_SITENAMEPUBLISHED] = $registrationmanager->get_site_privacy_string(HUB_SITENAMEPUBLISHED);
        $options[HUB_SITELINKPUBLISHED] = $registrationmanager->get_site_privacy_string(HUB_SITELINKPUBLISHED);
        $mform->addElement('select', 'privacy', get_string('siteprivacy', 'tool_customhub'), $options);
        $mform->setDefault('privacy', $privacy);
        $mform->setType('privacy', PARAM_ALPHA);
        $mform->addHelpButton('privacy', 'privacy', 'tool_customhub');
        unset($options);

        $mform->addElement('textarea', 'description', get_string('sitedesc', 'tool_customhub'),
            array('rows' => 8, 'cols' => 41));
        $mform->addRule('description', $strrequired, 'required', null, 'client');
        $mform->setDefault('description', $sitedescription);
        $mform->setType('description', PARAM_TEXT);
        $mform->addHelpButton('description', 'sitedesc', 'tool_customhub');

        $languages = get_string_manager()->get_list_of_languages();
        core_collator::asort($languages);
        $mform->addElement('select', 'language', get_string('sitelang', 'tool_customhub'),
            $languages);
        $mform->setType('language', PARAM_ALPHANUMEXT);
        $mform->addHelpButton('language', 'sitelang', 'tool_customhub');
        $mform->setDefault('language', $language);

        $mform->addElement('textarea', 'address', get_string('postaladdress', 'tool_customhub'),
            array('rows' => 4, 'cols' => 41));
        $mform->setType('address', PARAM_TEXT);
        $mform->setDefault('address', $address);
        $mform->addHelpButton('address', 'postaladdress', 'tool_customhub');

        //TODO: use the region array I generated
//        $mform->addElement('select', 'region', get_string('selectaregion'), array('-' => '-'));
//        $mform->setDefault('region', $region);
        $mform->addElement('hidden', 'regioncode', '-');
        $mform->setType('regioncode', PARAM_ALPHANUMEXT);

        $countries = ['' => ''] + get_string_manager()->get_list_of_countries();
        $mform->addElement('select', 'countrycode', get_string('sitecountry', 'tool_customhub'), $countries);
        $mform->setDefault('countrycode', $country);
        $mform->setType('countrycode', PARAM_ALPHANUMEXT);
        $mform->addHelpButton('countrycode', 'sitecountry', 'tool_customhub');
        $mform->addRule('countrycode', $strrequired, 'required', null, 'client');

        $mform->addElement('text', 'geolocation', get_string('sitegeolocation', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->setDefault('geolocation', $geolocation);
        $mform->setType('geolocation', PARAM_RAW);
        $mform->addHelpButton('geolocation', 'sitegeolocation', 'tool_customhub');

        $mform->addElement('text', 'contactname', get_string('siteadmin', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->addRule('contactname', $strrequired, 'required', null, 'client');
        $mform->setType('contactname', PARAM_TEXT);
        $mform->setDefault('contactname', $contactname);
        $mform->addHelpButton('contactname', 'siteadmin', 'tool_customhub');

        $mform->addElement('text', 'contactphone', get_string('sitephone', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->setType('contactphone', PARAM_TEXT);
        $mform->setDefault('contactphone', $contactphone);
        $mform->addHelpButton('contactphone', 'sitephone', 'tool_customhub');
        $mform->setForceLtr('contactphone');

        $mform->addElement('text', 'contactemail', get_string('siteemail', 'tool_customhub'),
            array('class' => 'registration_textfield'));
        $mform->addRule('contactemail', $strrequired, 'required', null, 'client');
        $mform->setType('contactemail', PARAM_EMAIL);
        $mform->setDefault('contactemail', $contactemail);
        $mform->addHelpButton('contactemail', 'siteemail', 'tool_customhub');

        $options = array();
        $options[0] = get_string("registrationcontactno");
        $options[1] = get_string("registrationcontactyes");
        $mform->addElement('select', 'contactable', get_string('siteregistrationcontact', 'tool_customhub'), $options);
        $mform->setDefault('contactable', $contactable);
        $mform->setType('contactable', PARAM_INT);
        $mform->addHelpButton('contactable', 'siteregistrationcontact', 'tool_customhub');
        unset($options);

        $options = array();
        $options[0] = get_string("registrationno");
        $options[1] = get_string("registrationyes");
        $mform->addElement('select', 'emailalert', get_string('siteregistrationemail', 'tool_customhub'), $options);
        $mform->setDefault('emailalert', $emailalert);
        $mform->setType('emailalert', PARAM_INT);
        $mform->addHelpButton('emailalert', 'siteregistrationemail', 'tool_customhub');
        unset($options);

        //TODO site logo
        $mform->addElement('hidden', 'imageurl', ''); //TODO: temporary
        $mform->setType('imageurl', PARAM_URL);

        $mform->addElement('static', 'urlstring', get_string('siteurl', 'tool_customhub'), $CFG->wwwroot);
        $mform->addHelpButton('urlstring', 'siteurl', 'tool_customhub');

        $mform->addElement('static', 'versionstring', get_string('siteversion', 'tool_customhub'), $CFG->version);
        $mform->addElement('hidden', 'moodleversion', $CFG->version);
        $mform->setType('moodleversion', PARAM_INT);
        $mform->addHelpButton('versionstring', 'siteversion', 'tool_customhub');

        $mform->addElement('static', 'releasestring', get_string('siterelease', 'tool_customhub'), $CFG->release);
        $mform->addElement('hidden', 'moodlerelease', $CFG->release);
        $mform->setType('moodlerelease', PARAM_TEXT);
        $mform->addHelpButton('releasestring', 'siterelease', 'tool_customhub');

        /// Display statistic that are going to be retrieve by the hub
        $coursecount = $DB->count_records('course') - 1;
        $usercount = $DB->count_records('user', array('deleted' => 0));
        $roleassigncount = $DB->count_records('role_assignments');
        $postcount = $DB->count_records('forum_posts');
        $questioncount = $DB->count_records('question');
        $resourcecount = $DB->count_records('resource');
        require_once($CFG->dirroot . "/course/lib.php");
        $participantnumberaverage = number_format(average_number_of_participants(), 2);
        $modulenumberaverage = number_format(average_number_of_courses_modules(), 2);
        require_once($CFG->libdir . '/badgeslib.php');
        $badges = $DB->count_records_select('badge', 'status <> ' . BADGE_STATUS_ARCHIVED);
        $issuedbadges = $DB->count_records('badge_issued');

        $mform->addElement('checkbox', 'courses', get_string('sendfollowinginfo', 'tool_customhub'),
            " " . get_string('coursesnumber', 'tool_customhub', $coursecount));
        $mform->setDefault('courses', $coursesnumber != -1);
        $mform->setType('courses', PARAM_INT);
        $mform->addHelpButton('courses', 'sendfollowinginfo', 'tool_customhub');

        $mform->addElement('checkbox', 'users', '',
            " " . get_string('usersnumber', 'tool_customhub', $usercount));
        $mform->setDefault('users', $usersnumber != -1);
        $mform->setType('users', PARAM_INT);

        $mform->addElement('checkbox', 'roleassignments', '',
            " " . get_string('roleassignmentsnumber', 'tool_customhub', $roleassigncount));
        $mform->setDefault('roleassignments', $roleassignmentsnumber != -1);
        $mform->setType('roleassignments', PARAM_INT);

        $mform->addElement('checkbox', 'posts', '',
            " " . get_string('postsnumber', 'tool_customhub', $postcount));
        $mform->setDefault('posts', $postsnumber != -1);
        $mform->setType('posts', PARAM_INT);

        $mform->addElement('checkbox', 'questions', '',
            " " . get_string('questionsnumber', 'tool_customhub', $questioncount));
        $mform->setDefault('questions', $questionsnumber != -1);
        $mform->setType('questions', PARAM_INT);

        $mform->addElement('checkbox', 'resources', '',
            " " . get_string('resourcesnumber', 'tool_customhub', $resourcecount));
        $mform->setDefault('resources', $resourcesnumber != -1);
        $mform->setType('resources', PARAM_INT);

        $mform->addElement('checkbox', 'badges', '',
            " " . get_string('badgesnumber', 'tool_customhub', $badges));
        $mform->setDefault('badges', $badgesnumber != -1);
        $mform->setType('badges', PARAM_INT);

        $mform->addElement('checkbox', 'issuedbadges', '',
            " " . get_string('issuedbadgesnumber', 'tool_customhub', $issuedbadges));
        $mform->setDefault('issuedbadges', $issuedbadgesnumber != -1);
        $mform->setType('issuedbadges', PARAM_INT);

        $mform->addElement('checkbox', 'participantnumberaverage', '',
            " " . get_string('participantnumberaverage', 'tool_customhub', $participantnumberaverage));
        $mform->setDefault('participantnumberaverage', $participantnumberaveragecfg != -1);
        $mform->setType('participantnumberaverage', PARAM_FLOAT);

        $mform->addElement('checkbox', 'modulenumberaverage', '',
            " " . get_string('modulenumberaverage', 'tool_customhub', $modulenumberaverage));
        $mform->setDefault('modulenumberaverage', $modulenumberaveragecfg != -1);
        $mform->setType('modulenumberaverage', PARAM_FLOAT);

        //check if it's a first registration or update
        $hubregistered = $registrationmanager->get_registeredhub($huburl);

        if (!empty($hubregistered)) {
            $buttonlabel = get_string('updatesite', 'tool_customhub',
                !empty($hubname) ? $hubname : $huburl);
            $mform->addElement('hidden', 'update', true);
            $mform->setType('update', PARAM_BOOL);
        } else {
            $buttonlabel = get_string('registersite', 'tool_customhub',
                !empty($hubname) ? $hubname : $huburl);
        }

        $this->add_action_buttons(false, $buttonlabel);
    }

}

