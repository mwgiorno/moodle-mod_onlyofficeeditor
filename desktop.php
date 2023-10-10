<?php

use mod_onlyofficeeditor\util;

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

global $CFG, $USER;

if (!util::desktop_detect()) {
    redirect($CFG->wwwroot);
}

$domain = "'" . $CFG->wwwroot . "'";
$displayname = "'" . \fullname($USER) . "'";
$provider = "'Moodle'";
$redirectUrl = "'" . $CFG->wwwroot . "'";

$js = <<< JAVASCRIPT
    if (!window['AscDesktopEditor']) {
        location.href = $redirectUrl;
    }

    var data = {
        displayName: $displayname,
        domain: $domain,
        provider: $provider,
    };

    window.AscDesktopEditor.execCommand('portal:login', JSON.stringify(data));

    location.href = $redirectUrl;
JAVASCRIPT;

echo html_writer::script($js);
