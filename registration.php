<!DOCTYPE html>
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
?>
<head>
<title>Система управления взаимоотношениями: LineCRM</title>
 <meta http-equiv="content-type" content="text/html;charset=utf-8">
 <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
<?php 
//include('./set_title.php');
//include('./set_config.php');
//header('Location:reconstruct.php');
SESSION_START();//if (!isset($_SESSION['username'])): header('Location: logout.php');endif;
?>
<br><b>TEST <font color="red">Line</font>CRM</b><br><hr>
<h3>Страница регистрации в LineCRM</h3>
<p><font color="green" >Красным выделяются поля в которых есть ошибки в написании!</font></p>
<form method="POST" action="/reconstruct.php" enctype="multipart/form-data">
<table>
<tr><td colspan="2"><h4><font color="orange">Представьтесь</font></h4></td><td>
<tr valign="center"><td>Имя (Отчество):</td><td><input type="text" name="name" size="30" autofocus required></td></tr>
<tr><td>Дата рождения:</td><td><input type="date" name="birth" required></td></tr>
<tr><td>Город (откуда Вы пишите):</td><td><input type="text" name="province" size="18"></td></tr>
<tr><td>Род деятельности:</td><td><input type="text" name="activity" size="28"></td></tr>
<tr><td>Официальный сайт:</td><td><input type="url" name="web" size="20"></td></tr>
<tr><td>Вы хотите использовать CRM?</td><td><select name="note" required>
<option value="">
<option value="Ознакомлюсь">Ознакомлюсь
<option value="Не сейчас">Не сейчас
<option value="Можно">Можно
<tr><td>Фотография:</td><td><input type="file" name="foto" required></td></tr>
</td></tr>
<tr><td colspan="2"><h4><font color="orange">Контактная информация</font></h4></td><td>
<tr><td>Телефон:</td><td><input type="tel" name="tel" size="20" disabled></td></tr>
<tr><td>E-mail:</td><td><input type="email" name="email" size="30" required></td></tr>
<tr><td>Пароль:</td><td><input type="password" name="pass" size="22" required></td></tr>
<tr><td>и еще раз пароль:</td><td><input type="password" name="reenterpass" size="22" required></td></tr>
<tr><td></td><td><input type="submit" name="submit" value="Регистрация" autofocus></td></tr>
</table>
</form>
<p><a href='./index.php'>Назад</a>
<?php 
include('set_foot.php');
?>
