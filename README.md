Hub registration plugin
-----------------------

This plugin will allow sites to register and publish courses on custom hubs in Moodle 3.4.1
and above.

Functionality to register on custom hubs was present in Moodle 3.3 but was removed in Moodle 3.4

* Make sure php_xmlrpc is installed on your server, xmlrpc protocol is required for hub communication
* Place the source code of this plugin into admin/tool/customhub
* Complete installation in CLI or on the website
* Login as admin and go to: Site administration > Server > Hubs
* Enter the URL of the custom hub (without trailing / ) and password if applicable
* Fill and submit the registration form
* Now your site is registered with the custom hub
* Go to the course and find in the administration menu (or settings cog) the item "Publish on hub"
* Advertise or share the course on custom hub same way you were able to in Moodle 3.3 and below

If the site was registered with custom hub and courses were published before upgrade to Moodle 3.4
information about it will not be lost after upgrade, even if this plugin is not installed straight away.
However without this plugin managers will not be able to manage registration, view published courses
or publish new courses.

Capability 'tool/customhub:publishcourse' controls who is able to publish courses on custom hubs.
Capability 'moodle/site:config' is required to register site on custom hubs.

To search courses from custom hubs another plugin https://github.com/moodlehq/moodle-block_customhub
is required.

These two plugins can be found on moodlehq github, however Moodle HQ will not actively support them.
Pull requests will be reviewed and merged.
