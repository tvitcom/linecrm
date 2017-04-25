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
include('./set_title.php');
include('./set_config.php');
//header('Location:reconstruct.php');

//------------Создаем запрос на внесение данных: -------

if (isset($_POST['addbug']) && $_POST['addbug'] == true) {
	$addbug_sql = sprintf('INSERT INTO `impr` (`id`, `todo`, `when`) VALUES ( NULL, "%1$s", "%2$s")',
	$mysqli->real_escape_string($_POST['todo']),//1
	DATE('Y-m-d H:i:s'));//2
$mysqli->query($addbug_sql);
//echo "<p>sql: ".@$addbug_sql;
echo '<p><h4><font color="green">Сообщение об ошибке направлено разработчикам. Благодарим за помощь!</font><a href="./listcont.php">Вернутся!</a></h4>';
}


//----------- Выводим поля на страницу:-----------------
?>
<table>
    <form name="addbug" action="./addbug.php" method="POST">
    <tr><td><font color="red">*Описание ошибки:</font></td><td><textarea name="todo" id="todo" type="textarea" size="100" maxlenght="2000" ><?php  echo empty($_POST['todo'])?"":$_POST['todo'];?></textarea></td></tr>
    <tr><td>Время отправки:</td><td><input name="when" type="text" size="19" maxlenght="19" disabled value="<?php  echo empty($_POST['when'])?DATE('Y-m-d H:i:s'):$_POST['when'];?>"></td></tr>
    <tr><td></td><td><BUTTON name="addbug" value="true" type="submit" <?php  echo empty($_POST['addbug'])?"":"disabled";?>>Создать!</BUTTON></td></tr>
    <tr><td><a href="./listcont.php">К списку</a></td><td></td></tr>
    </form>
</table>
<?php 
include('./set_foot.php');
