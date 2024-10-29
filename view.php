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
 * ildhtmlinteract module version information
 *
 * @package    mod_ildhtmlinteract (copy of the resource plugin)
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @copyright  2018 Stefan Bomanns, ILD, Technische Hochschule Lübeck, <stefan.bomanns@th-luebeck.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot.'/mod/ildhtmlinteract/lib.php');
require_once($CFG->dirroot.'/mod/ildhtmlinteract/locallib.php');
require_once($CFG->libdir.'/completionlib.php');

$id       = optional_param('id', 0, PARAM_INT); // Course Module ID
$r        = optional_param('r', 0, PARAM_INT);  // ildhtmlinteract instance ID
$redirect = optional_param('redirect', 0, PARAM_BOOL);
$forceview = optional_param('forceview', 0, PARAM_BOOL);


if ($r) {
    if (!$ildhtmlinteract = $DB->get_record('ildhtmlinteract', array('id'=>$r))) {
        ildhtmlinteract_redirect_if_migrated($r, 0);
        print_error('invalidaccessparameter');
    }
    $cm = get_coursemodule_from_instance('ildhtmlinteract', $ildhtmlinteract->id, $ildhtmlinteract->course, false, MUST_EXIST);

} else {
    if (!$cm = get_coursemodule_from_id('ildhtmlinteract', $id)) {
        ildhtmlinteract_redirect_if_migrated(0, $id);
        print_error('invalidcoursemodule');
    }
    $ildhtmlinteract = $DB->get_record('ildhtmlinteract', array('id'=>$cm->instance), '*', MUST_EXIST);
}

$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);

require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/ildhtmlinteract:view', $context);

// Completion and trigger events.
ildhtmlinteract_view($ildhtmlinteract, $course, $cm, $context);

$PAGE->set_url('/mod/ildhtmlinteract/view.php', array('id' => $cm->id));

if ($ildhtmlinteract->tobemigrated) {
    ildhtmlinteract_print_tobemigrated($ildhtmlinteract, $cm, $course);
    die;
}

$fs = get_file_storage();
$files = $fs->get_area_files($context->id, 'mod_ildhtmlinteract', 'content', 0, 'sortorder DESC, id ASC', false); // TODO: this is not very efficient!!
if (count($files) < 1) {
    ildhtmlinteract_print_filenotfound($ildhtmlinteract, $cm, $course);
    die;
} else {
    $file = reset($files);
    unset($files);
}

$ildhtmlinteract->mainfile = $file->get_filename();
$displaytype = ildhtmlinteract_get_final_display_type($ildhtmlinteract);
if ($displaytype == RESOURCELIB_DISPLAY_OPEN || $displaytype == RESOURCELIB_DISPLAY_DOWNLOAD) {
    $redirect = true;
}

// Don't redirect teachers, otherwise they can not access course or module settings.
if ($redirect && !course_get_format($course)->has_view_page() &&
        (has_capability('moodle/course:manageactivities', $context) ||
        has_capability('moodle/course:update', context_course::instance($course->id)))) {
    $redirect = false;
}

if ($redirect && !$forceview) {
    // coming from course page or url index page
    // this redirect trick solves caching problems when tracking views ;-)
    $path = '/'.$context->id.'/mod_ildhtmlinteract/content/'.$ildhtmlinteract->revision.$file->get_filepath().$file->get_filename();
    $fullurl = moodle_url::make_file_url('/pluginfile.php', $path, $displaytype == RESOURCELIB_DISPLAY_DOWNLOAD);
    redirect($fullurl);
}

switch ($displaytype) {
    case RESOURCELIB_DISPLAY_EMBED:
        ildhtmlinteract_display_embed($ildhtmlinteract, $cm, $course, $file);
        break;
    case RESOURCELIB_DISPLAY_FRAME:
        ildhtmlinteract_display_frame($ildhtmlinteract, $cm, $course, $file);
        break;
    default:
        ildhtmlinteract_print_workaround($ildhtmlinteract, $cm, $course, $file);
        break;
}

