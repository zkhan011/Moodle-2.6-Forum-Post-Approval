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
 * Jumps to a given relative or Moodle absolute URL.
 * Mostly used for accessibility.
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package mod-forum
 */

require('../../config.php');
require_once("lib.php");

$post = new stdClass();
$post->discussion = $_GET["discussionid"];                
$post->id = $_GET["itemid"];
$post->approved = $_GET["postapproved"];
$userid = $_GET['userid'];
$sessionkey = $_GET['sesskey'];

/* echo '<ul>';
echo '<li>Discussion ID: '. $post->discussion .'</li>';
echo '<li>Item ID: '. $post->id .'</li>';
echo '<li>Appoval Status: '. $post->approved .'</li>';
echo '<li>Session ID: '. $sessionkey .'</li>';
echo '</ul>'; */

switch ($post->approved) {
    case 0:
        $oldstatus = print_approval_status($post);
        //echo '<p>Confirm initial status for discussion post #'. $post->id .' is '. $oldstatus->approved .'</p>';
        $post->approved = 1;
        $newstatus = update_approve_status($post);
        //echo '<p>The new approval status for discussion post #'. $post->id .' is '. $newstatus->approved .'</p>';
        break;
    case 1:
        $oldstatus = print_approval_status($post);
        //echo '<p>Confirm initial status for discussion post #'. $post->id .' is '. $oldstatus->approved .'</p>';
        $post->approved = 0;
        $newstatus = update_approve_status($post);
        //echo '<p>The new approval status for discussion post #'. $post->id .' is '. $newstatus->approved .'</p>';
        break;
}

//echo '<a href="'. $CFG->wwwroot .'/mod/forum/discuss.php?d='. $post->discussion .'">Continue</a>';

redirect(new moodle_url($CFG->wwwroot .'/mod/forum/discuss.php?d='. $post->discussion));

function print_approval_status($post) {
    global $CFG, $DB;
    $sql = 'SELECT mdl_forum_posts.approved FROM mdl_forum_posts WHERE mdl_forum_posts.id = '. $post->id;
    $approvalstatus = $DB->get_record_sql($sql);
    return $approvalstatus;      
}

function update_approve_status($post) {
    global $CFG, $DB;
    $DB->update_record('forum_posts', $post);
    $sql = 'SELECT mdl_forum_posts.approved FROM mdl_forum_posts WHERE mdl_forum_posts.id = '. $post->id;
    $approvalstatus = $DB->get_record_sql($sql);
    return $approvalstatus;
}
