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
include('./set_head.php');
//header('Location:reconstruct.php');
?>
<br><b><font color = "red">Line</font>CRM</b><br><hr>
<h3>Страница входа на сайт</h3>

<form method="POST" action="./loginproc.php">
<table>
<tr><td>Пользователь</td><td>:</td><td><input type="text" name="login" size="20"></td></tr>
<tr><td>Пароль</td><td>:</td><td><input type="password" name="pass" size="20"></td></tr>
<tr><td></td><td></td><td><input type="submit" value="ВОЙТИ" autofocus></td></tr>
</table>
</form>

<p>Если вы хотите зарегистрироватся то нажмите <a href="./registration.php">тут</a></p>

<?php include('./set_foot.php');