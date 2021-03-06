<?php

/**
 * User Directory
 *   Copyright (c) 2008, 2011, 2019 Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *
 *   https://www.phpexperts.pro/
 *   https://gitlab.com/phpexperts/user_directory
 *
 * The following code is licensed under a modified BSD License.
 * All of the terms and conditions of the BSD License apply with one
 * exception:
 *
 * 1. Every one who has not been a registered student of the "PHPExperts
 *    From Beginner To Pro" course (http://www.phpexperts.pro/) is forbidden
 *    from modifing this code or using in an another project, either as a
 *    deritvative work or stand-alone.
 *
 * BSD License: http://www.opensource.org/licenses/bsd-license.php
 */

use PHPExperts\UserDirectory\Controllers\ControllerCommandFactory;
use PHPExperts\UserDirectory\Controllers\SecurityController;
use PHPExperts\UserDirectory\Managers\UserManager;

require '../vendor/autoload.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$view   = isset($_GET['view']) ? $_GET['view'] : 'index';

$view_file = $view . '.tpl.php';

if (!file_exists("../src/Views/$view_file")) {
    $view_file = '404.tpl.php';
}

if ($view == 'browse') {
    $action = 'browse';
} else {
    if ($view == 'search') {
        $action = 'search';
    }
}

// Initialize form variables
$result = $username = $password = $confirm = $firstName = $lastName = $email = '';

session_start();

$guard = new SecurityController();
if ($guard->isLoggedIn()) {
    $login_status = UserManager::LOGGED_IN;
}
unset($guard);

$data = ControllerCommandFactory::execute($action);

// Extract $data to global namespace.
if (!is_null($data)) {
    extract($data);
}
require '../src/Views/_header.tpl.php';
require '../src/Views/' . $view_file;
require '../src/Views/_footer.tpl.php';
