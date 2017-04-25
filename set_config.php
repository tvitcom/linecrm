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
$host = 'localhost';
$db = 'linecrm-old';
$user = 'linecrm-old';
$pass = 'pass_to_linecrm';

$mysqli = new mysqli($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
    echo "<p><b>Подключится к БД не удалось!</b>";
    require_once('./set_foot.php');
    exit();
}

//установим кодировку использования:
if (!$mysqli->set_charset('utf8'))
    echo "Err set charset UTF-8!";

//Выводим ошибки страниц:
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
//ini_set('error_reporting', 'E_ALL');
//set_error_handler($func_name);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
