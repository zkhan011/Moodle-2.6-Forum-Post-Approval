Forum Post Approval INFORMATION
===============================

BGEA required an option to approve posts before they
would use the forums. The entire Moodle directory is
included in this GIT repository in case modification
was required of files outside of root/mod/forum.

In the current development the approval process works
for all but 'A single, simple discussion.'
This will be fixed as time permits.

As of 3 June 2014 the files affected are:
mod/forum/approval.php - New
mod/forum/db/access.php
mod/forum/db/install.xml
mod/forum/db/upgrade.php
mod/forum/lang/en/forum.php
mod/forum/lib.php
mod/forum/mod_form.php
mod/forum/post.php
mod/forum/version.php

QUICK INSTALL
=============

For the impatient, here is a basic outline of the
installation process, which normally takes me only
a few minutes:

1) Move the Moodle files into your web directory.

2) Create a single database for Moodle to store all
   its tables in (or choose an existing database).

3) Visit your Moodle site with a browser, you should
   be taken to the install.php script, which will lead
   you through creating a config.php file and then
   setting up Moodle, creating an admin account etc.

4) Set up a cron task to call the file admin/cron.php
   every five minutes or so.


For more information, see the INSTALL DOCUMENTATION:

   http://docs.moodle.org/en/Installing_Moodle


Good luck and have fun!
Martin Dougiamas, Lead Developer

