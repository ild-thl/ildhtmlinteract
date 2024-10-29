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
 * ildhtmlinteract module admin settings and defaults
 *
 * @package    mod_ildhtmlinteract (copy of the resource plugin)
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @copyright  2018 Stefan Bomanns, ILD, Technische Hochschule Lübeck, <stefan.bomanns@th-luebeck.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once("$CFG->libdir/resourcelib.php");

    $displayoptions = resourcelib_get_displayoptions(array(RESOURCELIB_DISPLAY_AUTO,
                                                          ));
    $defaultdisplayoptions = array(RESOURCELIB_DISPLAY_AUTO,
                                  );

    //--- general settings -----------------------------------------------------------------------------------
    // $settings->add(new admin_setting_configtext('ildhtmlinteract/framesize',
        //get_string('framesize', 'ildhtmlinteract'), get_string('configframesize', 'ildhtmlinteract'), 400, PARAM_INT));

    //--- modedit defaults -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('ildhtmlinteractmodeditdefaults', get_string('modeditdefaults', 'admin'), get_string('condifmodeditdefaults', 'admin')));


    $settings->add(new admin_setting_configmultiselect('ildhtmlinteract/displayoptions',
        get_string('displayoptions', 'ildhtmlinteract'), get_string('configdisplayoptions', 'ildhtmlinteract'),
        $defaultdisplayoptions, $displayoptions));

    $settings->add(new admin_setting_configcheckbox('ildhtmlinteract/printintro',
        get_string('printintro', 'ildhtmlinteract'), get_string('printintroexplain', 'ildhtmlinteract'), 0));
    //$settings->add(new admin_setting_configselect('ildhtmlinteract/display',
      //  get_string('displayselect', 'ildhtmlinteract'), get_string('displayselectexplain', 'ildhtmlinteract'), RESOURCELIB_DISPLAY_AUTO,
        //$displayoptions));
    $settings->add(new admin_setting_configcheckbox('ildhtmlinteract/showsize',
        get_string('showsize', 'ildhtmlinteract'), get_string('showsize_desc', 'ildhtmlinteract'), 0));
    $settings->add(new admin_setting_configcheckbox('ildhtmlinteract/showtype',
        get_string('showtype', 'ildhtmlinteract'), get_string('showtype_desc', 'ildhtmlinteract'), 0));
    $settings->add(new admin_setting_configcheckbox('ildhtmlinteract/showdate',
        get_string('showdate', 'ildhtmlinteract'), get_string('showdate_desc', 'ildhtmlinteract'), 0));
    $settings->add(new admin_setting_configtext('ildhtmlinteract/framewidth',
        get_string('framewidth', 'ildhtmlinteract'), get_string('popupwidthexplain', 'ildhtmlinteract'), 700, PARAM_INT, 7));
    $settings->add(new admin_setting_configtext('ildhtmlinteract/frameheight',
        get_string('frameheight', 'ildhtmlinteract'), get_string('popupheightexplain', 'ildhtmlinteract'), 400, PARAM_INT, 7));
    $options = array('0' => get_string('none'), '1' => get_string('allfiles'), '2' => get_string('htmlfilesonly'));
    $settings->add(new admin_setting_configselect('ildhtmlinteract/filterfiles',
        get_string('filterfiles', 'ildhtmlinteract'), get_string('filterfilesexplain', 'ildhtmlinteract'), 0, $options));
}
