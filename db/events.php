<?php

$observers = array(
    array(
        'eventname' => '\core\event\user_loggedin',
        'callback'  => 'onlyofficeeditor_login_handler',
        'includefile' => '/mod/onlyofficeeditor/lib.php'
    )
);