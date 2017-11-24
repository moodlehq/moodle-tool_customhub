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

/**
 * Class course_publication_form
 *
 * @package    tool_customhub
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 */

namespace tool_customhub;

use moodleform;
use html_writer;
use moodle_url;
use core_collator;
use license_manager;
use stdClass;
use webservice_xmlrpc_client;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * Course publication form
 *
 * @package    tool_customhub
 * @copyright  Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
class course_publication_form extends moodleform {

    public function definition() {
        global $CFG, $DB, $USER, $OUTPUT;

        $strrequired = get_string('required');
        $mform = & $this->_form;
        $huburl = $this->_customdata['huburl'];
        $hubname = $this->_customdata['hubname'];
        $course = $this->_customdata['course'];
        $advertise = $this->_customdata['advertise'];
        $share = $this->_customdata['share'];
        $page = $this->_customdata['page'];
        $site = get_site();

        //hidden parameters
        $mform->addElement('hidden', 'huburl', $huburl);
        $mform->setType('huburl', PARAM_URL);
        $mform->addElement('hidden', 'hubname', $hubname);
        $mform->setType('hubname', PARAM_TEXT);

        //check on the hub if the course has already been published
        $registrationmanager = new registration_manager();
        $registeredhub = $registrationmanager->get_registeredhub($huburl);
        $publicationmanager = new course_publish_manager();
        $publications = $publicationmanager->get_publications($registeredhub->huburl, $course->id, $advertise);

        if (!empty($publications)) {
            //get the last publication of this course
            $publication = array_pop($publications);

            $function = 'hub_get_courses';
            $options = new stdClass();
            $options->ids = array($publication->hubcourseid);
            $options->allsitecourses = 1;
            $params = array('search' => '', 'downloadable' => $share,
                'enrollable' => !$share, 'options' => $options);
            $serverurl = $huburl . "/local/hub/webservice/webservices.php";
            require_once($CFG->dirroot . "/webservice/xmlrpc/lib.php");
            $xmlrpcclient = new webservice_xmlrpc_client($serverurl, $registeredhub->token);
            try {
                $result = $xmlrpcclient->call($function, $params);
                $publishedcourses = $result['courses'];
            } catch (Exception $e) {
                $error = $OUTPUT->notification(get_string('errorcourseinfo', 'tool_customhub', $e->getMessage()));
                $mform->addElement('static', 'errorhub', '', $error);
            }
        }

        if (!empty($publishedcourses)) {
            $publishedcourse = $publishedcourses[0];
            $hubcourseid = $publishedcourse['id'];
            $defaultfullname = $publishedcourse['fullname'];
            $defaultshortname = $publishedcourse['shortname'];
            $defaultsummary = $publishedcourse['description'];
            $defaultlanguage = $publishedcourse['language'];
            $defaultpublishername = $publishedcourse['publishername'];
            $defaultpublisheremail = $publishedcourse['publisheremail'];
            $defaultcontributornames = $publishedcourse['contributornames'];
            $defaultcoverage = $publishedcourse['coverage'];
            $defaultcreatorname = $publishedcourse['creatorname'];
            $defaultlicenceshortname = $publishedcourse['licenceshortname'];
            $defaultsubject = $publishedcourse['subject'];
            $defaultaudience = $publishedcourse['audience'];
            $defaulteducationallevel = $publishedcourse['educationallevel'];
            $defaultcreatornotes = $publishedcourse['creatornotes'];
            $defaultcreatornotesformat = $publishedcourse['creatornotesformat'];
            $screenshotsnumber = $publishedcourse['screenshots'];
            $privacy = $publishedcourse['privacy'];
            if (($screenshotsnumber > 0) and !empty($privacy)) {
                $page->requires->yui_module('moodle-block_community-imagegallery',
                    'M.blocks_community.init_imagegallery',
                    array(array('imageids' => array($hubcourseid),
                        'imagenumbers' => array($screenshotsnumber),
                        'huburl' => $huburl)));
            }
        } else {
            $defaultfullname = $course->fullname;
            $defaultshortname = $course->shortname;
            $defaultsummary = clean_param($course->summary, PARAM_TEXT);
            if (empty($course->lang)) {
                $language = get_site()->lang;
                if (empty($language)) {
                    $defaultlanguage = current_language();
                } else {
                    $defaultlanguage = $language;
                }
            } else {
                $defaultlanguage = $course->lang;
            }
            $defaultpublishername = $USER->firstname . ' ' . $USER->lastname;
            $defaultpublisheremail = $USER->email;
            $defaultcontributornames = '';
            $defaultcoverage = '';
            $defaultcreatorname = $USER->firstname . ' ' . $USER->lastname;
            $defaultlicenceshortname = 'cc';
            $defaultsubject = 'none';
            $defaultaudience = HUB_AUDIENCE_STUDENTS;
            $defaulteducationallevel = HUB_EDULEVEL_TERTIARY;
            $defaultcreatornotes = '';
            $defaultcreatornotesformat = FORMAT_HTML;
            $screenshotsnumber = 0;
        }

        //the input parameters
        $mform->addElement('header', 'moodle', get_string('publicationinfo', 'tool_customhub'));

        $mform->addElement('text', 'name', get_string('coursename', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->addRule('name', $strrequired, 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $defaultfullname);
        $mform->addHelpButton('name', 'name', 'tool_customhub');

        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        if ($share) {
            $buttonlabel = get_string('shareon', 'tool_customhub', !empty($hubname) ? $hubname : $huburl);

            $mform->addElement('hidden', 'share', $share);
            $mform->setType('share', PARAM_BOOL);
            $mform->addElement('text', 'demourl', get_string('demourl', 'tool_customhub'),
                array('class' => 'metadatatext'));
            $mform->setType('demourl', PARAM_URL);
            $mform->setDefault('demourl', new moodle_url("/course/view.php?id=" . $course->id));
            $mform->addHelpButton('demourl', 'demourl', 'tool_customhub');
        }

        if ($advertise) {
            if (empty($publishedcourses)) {
                $buttonlabel = get_string('advertiseon', 'tool_customhub', !empty($hubname) ? $hubname : $huburl);
            } else {
                $buttonlabel = get_string('readvertiseon', 'tool_customhub', !empty($hubname) ? $hubname : $huburl);
            }
            $mform->addElement('hidden', 'advertise', $advertise);
            $mform->setType('advertise', PARAM_BOOL);
            $mform->addElement('hidden', 'courseurl', $CFG->wwwroot . "/course/view.php?id=" . $course->id);
            $mform->setType('courseurl', PARAM_URL);
            $mform->addElement('static', 'courseurlstring', get_string('courseurl', 'tool_customhub'));
            $mform->setDefault('courseurlstring', new moodle_url("/course/view.php?id=" . $course->id));
            $mform->addHelpButton('courseurlstring', 'courseurl', 'tool_customhub');
        }

        $mform->addElement('text', 'courseshortname', get_string('courseshortname', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->setDefault('courseshortname', $defaultshortname);
        $mform->addHelpButton('courseshortname', 'courseshortname', 'tool_customhub');
        $mform->setType('courseshortname', PARAM_TEXT);
        $mform->addElement('textarea', 'description', get_string('description', 'tool_customhub'), array('rows' => 10,
            'cols' => 57));
        $mform->addRule('description', $strrequired, 'required', null, 'client');
        $mform->setDefault('description', $defaultsummary);
        $mform->setType('description', PARAM_TEXT);
        $mform->addHelpButton('description', 'description', 'tool_customhub');

        $languages = get_string_manager()->get_list_of_languages();
        core_collator::asort($languages);
        $mform->addElement('select', 'language', get_string('language', 'tool_customhub'), $languages);
        $mform->setDefault('language', $defaultlanguage);
        $mform->addHelpButton('language', 'language', 'tool_customhub');


        $mform->addElement('text', 'publishername', get_string('publishername', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->setDefault('publishername', $defaultpublishername);
        $mform->addRule('publishername', $strrequired, 'required', null, 'client');
        $mform->addHelpButton('publishername', 'publishername', 'tool_customhub');
        $mform->setType('publishername', PARAM_NOTAGS);

        $mform->addElement('text', 'publisheremail', get_string('publisheremail', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->setDefault('publisheremail', $defaultpublisheremail);
        $mform->addRule('publisheremail', $strrequired, 'required', null, 'client');
        $mform->addHelpButton('publisheremail', 'publisheremail', 'tool_customhub');
        $mform->setType('publisheremail', PARAM_EMAIL);

        $mform->addElement('text', 'creatorname', get_string('creatorname', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->addRule('creatorname', $strrequired, 'required', null, 'client');
        $mform->setType('creatorname', PARAM_NOTAGS);
        $mform->setDefault('creatorname', $defaultcreatorname);
        $mform->addHelpButton('creatorname', 'creatorname', 'tool_customhub');

        $mform->addElement('text', 'contributornames', get_string('contributornames', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->setDefault('contributornames', $defaultcontributornames);
        $mform->addHelpButton('contributornames', 'contributornames', 'tool_customhub');
        $mform->setType('contributornames', PARAM_NOTAGS);

        $mform->addElement('text', 'coverage', get_string('tags', 'tool_customhub'),
            array('class' => 'metadatatext'));
        $mform->setType('coverage', PARAM_TEXT);
        $mform->setDefault('coverage', $defaultcoverage);
        $mform->addHelpButton('coverage', 'tags', 'tool_customhub');



        require_once($CFG->libdir . "/licenselib.php");
        $licensemanager = new license_manager();
        $licences = $licensemanager->get_licenses();
        $options = array();
        foreach ($licences as $license) {
            $options[$license->shortname] = get_string($license->shortname, 'license');
        }
        $mform->addElement('select', 'licence', get_string('licence', 'tool_customhub'), $options);
        $mform->setDefault('licence', $defaultlicenceshortname);
        unset($options);
        $mform->addHelpButton('licence', 'licence', 'tool_customhub');

        $options = $publicationmanager->get_sorted_subjects();

        $mform->addElement('searchableselector', 'subject',
            get_string('subject', 'tool_customhub'), $options);
        unset($options);
        $mform->addHelpButton('subject', 'subject', 'tool_customhub');
        $mform->setDefault('subject', $defaultsubject);
        $mform->addRule('subject', $strrequired, 'required', null, 'client');

        $options = array();
        $options[HUB_AUDIENCE_EDUCATORS] = get_string('audienceeducators', 'tool_customhub');
        $options[HUB_AUDIENCE_STUDENTS] = get_string('audiencestudents', 'tool_customhub');
        $options[HUB_AUDIENCE_ADMINS] = get_string('audienceadmins', 'tool_customhub');
        $mform->addElement('select', 'audience', get_string('audience', 'tool_customhub'), $options);
        $mform->setDefault('audience', $defaultaudience);
        unset($options);
        $mform->addHelpButton('audience', 'audience', 'tool_customhub');

        $options = array();
        $options[HUB_EDULEVEL_PRIMARY] = get_string('edulevelprimary', 'tool_customhub');
        $options[HUB_EDULEVEL_SECONDARY] = get_string('edulevelsecondary', 'tool_customhub');
        $options[HUB_EDULEVEL_TERTIARY] = get_string('eduleveltertiary', 'tool_customhub');
        $options[HUB_EDULEVEL_GOVERNMENT] = get_string('edulevelgovernment', 'tool_customhub');
        $options[HUB_EDULEVEL_ASSOCIATION] = get_string('edulevelassociation', 'tool_customhub');
        $options[HUB_EDULEVEL_CORPORATE] = get_string('edulevelcorporate', 'tool_customhub');
        $options[HUB_EDULEVEL_OTHER] = get_string('edulevelother', 'tool_customhub');
        $mform->addElement('select', 'educationallevel', get_string('educationallevel', 'tool_customhub'), $options);
        $mform->setDefault('educationallevel', $defaulteducationallevel);
        unset($options);
        $mform->addHelpButton('educationallevel', 'educationallevel', 'tool_customhub');

        $editoroptions = array('maxfiles' => 0, 'maxbytes' => 0, 'trusttext' => false, 'forcehttps' => false);
        $mform->addElement('editor', 'creatornotes', get_string('creatornotes', 'tool_customhub'), '', $editoroptions);
        $mform->addRule('creatornotes', $strrequired, 'required', null, 'client');
        $mform->setType('creatornotes', PARAM_CLEANHTML);
        $mform->addHelpButton('creatornotes', 'creatornotes', 'tool_customhub');

        if ($advertise) {
            if (!empty($screenshotsnumber)) {

                if (!empty($privacy)) {
                    $baseurl = new moodle_url($huburl . '/local/hub/webservice/download.php',
                        array('courseid' => $hubcourseid, 'filetype' => HUB_SCREENSHOT_FILE_TYPE));
                    $screenshothtml = html_writer::empty_tag('img',
                        array('src' => $baseurl, 'alt' => $defaultfullname));
                    $screenshothtml = html_writer::tag('div', $screenshothtml,
                        array('class' => 'coursescreenshot',
                            'id' => 'image-' . $hubcourseid));
                } else {
                    $screenshothtml = get_string('existingscreenshotnumber', 'tool_customhub', $screenshotsnumber);
                }
                $mform->addElement('static', 'existingscreenshots', get_string('existingscreenshots', 'tool_customhub'), $screenshothtml);
                $mform->addHelpButton('existingscreenshots', 'deletescreenshots', 'tool_customhub');
                $mform->addElement('checkbox', 'deletescreenshots', '', ' ' . get_string('deletescreenshots', 'tool_customhub'));
            }

            $mform->addElement('hidden', 'existingscreenshotnumber', $screenshotsnumber);
            $mform->setType('existingscreenshotnumber', PARAM_INT);
        }

        $mform->addElement('filemanager', 'screenshots', get_string('addscreenshots', 'tool_customhub'), null,
            array('subdirs' => 0,
                'maxbytes' => 1000000,
                'maxfiles' => 3
            ));
        $mform->addHelpButton('screenshots', 'screenshots', 'tool_customhub');

        $this->add_action_buttons(false, $buttonlabel);

        //set default value for creatornotes editor
        $data = new stdClass();
        $data->creatornotes = array();
        $data->creatornotes['text'] = $defaultcreatornotes;
        $data->creatornotes['format'] = $defaultcreatornotesformat;
        $this->set_data($data);
    }

    function validation($data, $files) {
        global $CFG;

        $errors = array();

        if ($this->_form->_submitValues['subject'] == 'none') {
            $errors['subject'] = get_string('mustselectsubject', 'tool_customhub');
        }

        return $errors;
    }

}
