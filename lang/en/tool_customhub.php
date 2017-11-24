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

defined('MOODLE_INTERNAL') || die;

$string['addscreenshots'] = 'Add screenshots';
$string['advertise'] = 'Advertise this course for people to join';
$string['advertised'] = 'Advertised';
$string['advertiseon'] = 'Advertise this course on {$a}';
$string['advertiseonhub'] = 'Share this course for people to join';
$string['advertisepublication_help'] = 'Advertising your course on a community hub server allows people to find this course and come here to enrol.';
$string['audience'] = 'Audience';
$string['audience_help'] = 'Select the intended audience for the course.';
$string['audienceadmins'] = 'Moodle administrators';
$string['audienceeducators'] = 'Educators';
$string['audiencestudents'] = 'Students';
$string['badgesnumber'] = 'Number of badges ({$a})';
$string['badurlformat'] = 'Bad URL format';
$string['contributornames'] = 'Other contributors';
$string['contributornames_help'] = 'You can use this field to list the names of anyone else who contributed to this course.';
$string['coursename'] = 'Name';
$string['coursepublished'] = 'This course has been published successfully on \'{$a}\'.';
$string['courseshortname'] = 'Shortname';
$string['courseshortname_help'] = 'Enter a short name for your course. It does not need to be unique.';
$string['coursesnumber'] = 'Number of courses ({$a})';
$string['courseunpublished'] = 'The course {$a->courseshortname} is no longer published on {$a->hubname}.';
$string['courseurl'] = 'Course URL';
$string['courseurl_help'] = 'It is the URL of your course. This URL is displayed as a link in a search result.';
$string['creatorname'] = 'Creator';
$string['creatorname_help'] = 'The creator is the course creator.';
$string['creatornotes'] = 'Creator notes';
$string['creatornotes_help'] = 'Creator notes are a guide for teachers on how to use the course.';
$string['customhub:publishcourse'] = 'Publish courses on custom hubs';
$string['deletescreenshots'] = 'Delete these screenshots';
$string['deletescreenshots_help'] = 'Delete all the currently uploaded screenshots.';
$string['demourl'] = 'Demo URL';
$string['demourl_help'] = 'Enter the demo URL of your course. By default it is the URL of your course. The demo URL is displayed as a link in a search result.';
$string['description'] = 'Description';
$string['description_help'] = 'This description text will be showing in the course listing on the hub.';
$string['detectednotexistingpublication'] = '{$a->hubname} is listing a course that does not exist any more. Alert this hub administrator that the publication number {$a->id} should be removed.';
$string['educationallevel'] = 'Educational level';
$string['educationallevel_help'] = 'Select the most appropriate educational level that the course fits into.';
$string['edulevelassociation'] = 'Association';
$string['edulevelcorporate'] = 'Corporate';
$string['edulevelgovernment'] = 'Government';
$string['edulevelother'] = 'Other';
$string['edulevelprimary'] = 'Primary';
$string['edulevelsecondary'] = 'Secondary';
$string['eduleveltertiary'] = 'Tertiary';
$string['errorcourseinfo'] = 'An error occurred when retrieving course metadata from the hub ({$a}). Please try again to retrieve the course metadata from the hub by reloading this page later. Otherwise you can decide to continue the registration process with the following default metadata. ';
$string['errorcoursepublish'] = 'An error occurred during the course publication ({$a}). Please try again later.';
$string['errorcoursewronglypublished'] = 'A publication error has been returned by the hub. Please try again later.';
$string['errorcron'] = 'An error occurred during registration update on "{$a->hubname}" ({$a->errormessage})';
$string['errorcronnoxmlrpc'] = 'XML-RPC must be enabled in order to update the registration.';
$string['errorregistration'] = 'An error occurred during registration, please try again later. ({$a})';
$string['errorunpublishcourses'] = 'Due to an unexpected error, the courses could not be deleted on the hub. Try again later (recommended) or contact the hub administrator.';
$string['existingscreenshotnumber'] = '{$a} existing screenshots. You will be able to see these screenshots on this page, only once the hub administrator enables your course.';
$string['existingscreenshots'] = 'Existing screenshots';
$string['forceunregister'] = 'Yes, clean registration data';
$string['forceunregisterconfirmation'] = 'Your site cannot reach {$a}. This hub could be temporarily down. Unless you are sure you want to continue to remove registration locally, please cancel and try again later.';
$string['hub'] = 'Hub';
$string['hubs'] = 'Hubs';
$string['issuedbadgesnumber'] = 'Number of issued badges ({$a})';
$string['language'] = 'Language';
$string['language_help'] = 'The main language of this course.';
$string['lasttimechecked'] = 'Last time checked';
$string['licence'] = 'Licence';
$string['licence_help'] = 'Select the licence you want to distribute your course under.';
$string['licence_link'] = 'licenses';
$string['modulenumberaverage'] = 'Average number of course modules ({$a})';
$string['moodlenetnotsupported'] = 'Registration on moodle.net is not supported by this tool.';
$string['mustselectsubject'] = 'You must select a subject';
$string['name'] = 'Name';
$string['name_help'] = 'This name will be showing in the course listing.';
$string['neverchecked'] = 'Never checked';
$string['nocheckstatusfromunreghub'] = 'The site is not registered on the hub so the status can not be checked.';
$string['notregisteredonhub'] = 'Your administrator needs to register this site with at least one hub before you can publish a course. Contact your site administrator.';
$string['operation'] = 'Actions';
$string['participantnumberaverage'] = 'Average number of participants ({$a})';
$string['pluginname'] = 'Hub registration';
$string['postaladdress'] = 'Postal address';
$string['postaladdress_help'] = 'Postal address of this site, or of the entity represented by this site.';
$string['postsnumber'] = 'Number of posts ({$a})';
$string['previousregistrationdeleted'] = 'The previous registration has been deleted from {$a}. You can restart the registration process. Thank you.';
$string['privacy'] = 'Privacy';
$string['privacy_help'] = 'The hub may want to display a list of registered sites. If it does then you can choose whether or not you want to appear on that list.';
$string['privatehuburl'] = 'Private hub URL';
$string['publicationinfo'] = 'Course publication information';
$string['publishcourse'] = 'Publish on hub';
$string['publishcourseon'] = 'Publish on {$a}';
$string['publishedon'] = 'Published on';
$string['publisheremail'] = 'Publisher email';
$string['publisheremail_help'] = 'The publisher email address allows the hub administrator to alert the publisher about any changes to the status of the published course.';
$string['publishername'] = 'Publisher';
$string['publishername_help'] = 'The publisher is the person or organisation that is the official publisher of the course.  Unless you are publishing it on behalf of someone else, it will usually be you.';
$string['publishon'] = 'Share on';
$string['questionsnumber'] = 'Number of questions ({$a})';
$string['readvertiseon'] = 'Update advertising information on {$a}';
$string['registeredon'] = 'Where your site is registered';
$string['registersite'] = 'Register with {$a}';
$string['registerwith'] = 'Register with a hub';
$string['registrationconfirmed'] = 'Site registration confirmed';
$string['registrationconfirmedon'] = 'Thank you for registering your site. Registration information will be kept up to date by the \'Update registration on hubs\' scheduled task.';
$string['registrationinfo'] = 'Registration information';
$string['removefromhub'] = 'Remove from hub';
$string['renewregistration'] = 'Renew registration';
$string['resourcesnumber'] = 'Number of resources ({$a})';
$string['restartregistration'] = 'Restart registration';
$string['roleassignmentsnumber'] = 'Number of role assignments ({$a})';
$string['screenshots'] = 'Screenshots';
$string['screenshots_help'] = 'Any screenshots of the course will be displayed in search results.';
$string['selecthub'] = 'Select hub';
$string['selecthubinfo'] = 'A community hub is a server that lists courses. You can only share your courses on hubs that this Moodle site is registered with.  If the hub you want is not listed below, please contact your site administrator.';
$string['sendfollowinginfo'] = 'More information';
$string['sendfollowinginfo_help'] = 'The following information will be sent to contribute to overall statistics only.  It will not be made public on any site listing.';
$string['sendingcourse'] = 'Sending course';
$string['sendingsize'] = 'Please wait the course file is uploading ({$a->total}Mb)...';
$string['sent'] = '...finished';
$string['share'] = 'Share this course for people to download';
$string['shared'] = 'Shared';
$string['shareon'] = 'Upload this course to {$a}';
$string['shareonhub'] = 'Upload this course to a hub';
$string['sharepublication_help'] = 'Uploading this course to a community hub server will enable people to download it and install it on their own Moodle sites.';
$string['siteadmin'] = 'Administrator';
$string['siteadmin_help'] = 'The full name of the site administrator.';
$string['sitecountry'] = 'Country';
$string['sitecountry_help'] = 'The country your organisation is in.';
$string['sitedesc'] = 'Description';
$string['sitedesc_help'] = 'This description of your site may be shown in the site listing.  Please use plain text only.';
$string['siteemail'] = 'Email address';
$string['siteemail_help'] = 'You need to provide an email address so the hub administrator can contact you if necessary.  This will not be used for any other purpose. It is recommended to enter a email address related to a position (example: sitemanager@example.com) and not directly to a person.';
$string['sitegeolocation'] = 'Geolocation';
$string['sitegeolocation_help'] = 'In future we may provide location-based searching in the hubs. If you want to specify the location for your site use a latitude/longitude value here (eg: -31.947884,115.871285).  One way to find this is to use Google Maps.';
$string['sitelang'] = 'Language';
$string['sitelang_help'] = 'Your site language will be displayed on the site listing.';
$string['sitename'] = 'Name';
$string['sitename_help'] = 'The name of the site will be shown on the site listing if the hub allows that.';
$string['sitephone'] = 'Phone';
$string['sitephone_help'] = 'Your phone number will only be seen by the hub administrator.';
$string['siteprivacy'] = 'Privacy';
$string['siteprivacylinked'] = 'Publish the site name with a link';
$string['siteprivacynotpublished'] = 'Please do not publish this site';
$string['siteprivacypublished'] = 'Publish the site name only';
$string['siteregistrationcontact'] = 'Contact form';
$string['siteregistrationcontact_help'] = 'If you allow it, other people may be able to contact you via a contact form on the hub.  They will never be able to see your email address.';
$string['siteregistrationemail'] = 'Email notifications';
$string['siteregistrationemail_help'] = 'If you enable this the hub administrator may email you to inform you of important news like security issues.';
$string['siteregistrationupdated'] = 'Site registration updated';
$string['siterelease'] = 'Moodle release';
$string['siterelease_help'] = 'Moodle release number of this site.';
$string['siteupdatedcron'] = 'Site registration updated on "{$a}"';
$string['siteurl'] = 'Site URL';
$string['siteurl_help'] = 'The URL is the address of this site.  If privacy settings allow people to see site addresses then this is the URL that will be used.';
$string['siteversion'] = 'Moodle version';
$string['siteversion_help'] = 'The Moodle version of this site.';
$string['status'] = 'Hub listing';
$string['statuspublished'] = 'Listed';
$string['statusunpublished'] = 'Not listed';
$string['subject'] = 'Subject';
$string['subject_help'] = 'Select the main subject area which the course covers.';
$string['tags'] = 'Tags';
$string['tags_help'] = 'Tags help to further categorise your course and help it to be found. Please use simple, meaningful words and separate them with a comma. Example: math, algebra, geometry';
$string['taskregistrationcron'] = 'Update registration on hubs';
$string['type'] = 'Advertised / Shared';
$string['unpublish'] = 'Unpublish';
$string['unpublishalladvertisedcourses'] = 'Remove all courses currently being advertised on a hub';
$string['unpublishalluploadedcourses'] = 'Removed all courses that were uploaded to a hub';
$string['unpublishconfirmation'] = 'Do you really want to remove the course "{$a->courseshortname}" from the hub "{$a->hubname}"';
$string['unpublishcourse'] = 'Unpublish {$a}';
$string['unregister'] = 'Unregister';
$string['unregisterfrom'] = 'Unregister from {$a}';
$string['unregistrationerror'] = 'An error occurred when the site tried to unregister from the hub: {$a}';
$string['update'] = 'Update';
$string['updatesite'] = 'Update registration on {$a}';
$string['updatestatus'] = 'Check it now.';
$string['urlalreadyregistered'] = 'Your site seems to be already registered on this hub, which means something has gone wrong. Please contact the hub administrator to reset your registration so you can try again.';
$string['usersnumber'] = 'Number of users ({$a})';
$string['warning'] = 'WARNING';
$string['wrongtoken'] = 'The registration failed for some unknown reason (network?). Please try again.';
$string['xmlrpcdisabledpublish'] = 'The XML-RPC extension is not enabled on the server. You can not publish courses or manage published courses.';
$string['xmlrpcdisabledregistration'] = 'The XML-RPC extension is not enabled on the server. You will not be able to unregister or update your registration until you enable it.';
