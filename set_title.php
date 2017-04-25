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
if (empty($_SESSION['username'])) {
    header('Location:./logout.php');
} else {
    echo '<p align="center"> | <a href="/listcont.php">Контакты</a> | <a href="/listtask.php">Дела</a> | <a href="/pricelist.php?price=service">Услуги</a> | <a href="/pricelist.php?price=goods">Товары</a> | <a href="/reports.php">Отчёты</a> | <a href="/settings.php">Настройки</a> |  <a href="/addbug.php">Bug</a> | <a href="/logout.php">Выход</a> | </p>';
}

?>
<br><b>Line<font color = "red">CRM</font></b><br><hr>
