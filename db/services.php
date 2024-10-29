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
 * ildhtmlinteract external functions and service definitions.
 *
 * @package    mod_ildhtmlinteract (copy of the resource plugin)
 * @category   external 
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @copyright  2018 Stefan Bomanns, ILD, Technische Hochschule Lübeck, <stefan.bomanns@th-luebeck.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_ildhtmlinteract_view_ildhtmlinteract' => array(
        'classname'     => 'mod_ildhtmlinteract_external',
        'methodname'    => 'view_ildhtmlinteract',
        'description'   => 'Simulate the view.php web interface ildhtmlinteract: trigger events, completion, etc...',
        'type'          => 'write',
        'capabilities'  => 'mod/ildhtmlinteract:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),
    'mod_ildhtmlinteract_get_ildhtmlinteracts_by_courses' => array(
        'classname'     => 'mod_ildhtmlinteract_external',
        'methodname'    => 'get_ildhtmlinteracts_by_courses',
        'description'   => 'Returns a list of files in a provided list of courses, if no list is provided all files that
                            the user can view will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/ildhtmlinteract:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
