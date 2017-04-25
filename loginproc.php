<?php
// This file is part of LineCRM - http://linecrm.org/
//
// LineCRM is free software: you can redistribute it and/or modify
// it under the terms of the Attribution-ShareAlike 3.0 Unported
// (CC BY-SA 3.0) as published by Creative Commons nonprofit organization.
//
// LineCRM is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// Creative Commons legal text for more details.
//
// You should have received a copy of the Attribution-ShareAlike 3.0 Unported legal text
// along with LineCRM code. If not, see <http://creativecommons.org/licenses/by-sa/3.0/legalcode/>.

/**
 * The administration and management interface for the cache setup and configuration.
 *
 * This file is part of LineCRM source code.
 *
 * @package    main
 * @category   CRM
 * @copyright  2012 tvitcom
 * @license    http://creativecommons.org/licenses/by-sa/3.0/legalcode/ Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)
 */
require('./set_config.php');
SESSION_START();
//echo "<p>login: ".$_POST['login']." pass: ".$_POST['pass']." varpass = ".$varpass;
///*
$login_sql = sprintf('SELECT id FROM users WHERE ( name ="%1$s" ) AND (pass= md5("%2$s"))', 
$mysqli->real_escape_string($_POST['login']), 
$mysqli->real_escape_string($_POST['pass'])
);

try
{
    $login = $mysqli->query($login_sql);

    if ((isset($login->num_rows)) && ($login->num_rows == 1)) {

        $_SESSION['username'] = $_POST['login'];
//echo 'ready!';
        header('Location:./listtask.php');
    } else {
        header('Location: logout.php');
        exit();
//echo "SQL: ".$login_sql;
    }
}
catch (Exception $ex)
{
    exit();
}

