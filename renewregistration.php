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
 * The administrator is redirect to this page from the hub to renew a registration
 * process because
 *
 * @package    tool_customhub
 * @author     Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$url = optional_param('url', '', PARAM_URL);
$hubname = optional_param('hubname', '', PARAM_TEXT);
$token = optional_param('token', '', PARAM_TEXT);

admin_externalpage_setup('tool_customhub');

//check that we are waiting a confirmation from this hub, and check that the token is correct
$registrationmanager = new tool_customhub\registration_manager();
$registeredhub = $registrationmanager->get_unconfirmedhub($url);
if (!empty($registeredhub) and $registeredhub->token == $token) {

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('renewregistration', 'tool_customhub'), 3, 'main');
    $hublink = html_writer::tag('a', $hubname, array('href' => $url));

    $registrationmanager->delete_registeredhub($url);

    $deletedregmsg = get_string('previousregistrationdeleted', 'tool_customhub', $hublink);

    $button = new single_button(new moodle_url('/admin/tool/customhub/index.php'),
        get_string('restartregistration', 'tool_customhub'));
    $button->class = 'restartregbutton';

    echo html_writer::tag('div', $deletedregmsg . $OUTPUT->render($button),
        array('class' => 'mdl-align'));

    echo $OUTPUT->footer();
} else {
    throw new moodle_exception('wrongtoken', 'tool_customhub',
        $CFG->wwwroot . '/' . $CFG->admin . '/tool/customhub/index.php');
}
