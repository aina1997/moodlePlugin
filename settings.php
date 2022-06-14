<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_category('local_helloworld_settings', new lang_string('pluginname', 'local_helloworld')));
    $settingspage = new admin_settingpage('managelocalhelloworld', new lang_string('manage', 'local_helloworld'));

    if ($ADMIN->fulltree) {
        $settingspage->add(new admin_setting_configcheckbox(
            'local_helloworld/showinnavigation',
            new lang_string('showinnavigation', 'local_helloworld'),
            new lang_string('showinnavigation_desc', 'local_helloworld'),
            1
        ));
    }

    $ADMIN->add('localplugins', $settingspage);
}