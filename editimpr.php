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

//------------ Входные пареметры: -----------------------

echo '<p><h4>Страница изменения записи "TO-DO":</h4></p>';

//----------- Запрос на извлечение исходных данных: ------

$improveid_sql = "SELECT `id`, `when`,`todo`, `fix`, `fixdate`, `rev`,`developerid` FROM `impr` WHERE `id` = ".@intval($_GET['id']);
$res = $mysqli->query($improveid_sql);
  //echo '<p>$improveid_sql :'.$improveid_sql;
$item = $res->fetch_assoc();

//------------Создаем запрос на обновление данных: -------

if (isset($_POST['editimprove']) && $_POST['editimprove'] =='true') {
	$todo_sql = sprintf('UPDATE `impr` SET `todo` = "%1$s",`fix`= %2$u,`fixdate` = "%3$s",`rev` = "%4$s" WHERE `id` = %5$u',
	$mysqli->real_escape_string($_POST['todo']),//1
	intval($_POST['fix']),//2
	$mysqli->real_escape_string($_POST['fixdate']),//3
	$mysqli->real_escape_string($_POST['rev']),//4
	intval($_POST['id']));//5
	//	echo "<p>sql: ".@$todo_sql;

	if  ($mysqli->query($todo_sql)) {
		echo '<p><h4><font color="green"></font></h4><p>';
		header("Location:./settings.php");
	}
}
?>
<table>
    <form name="editimprove" action="editimpr.php" method="POST">
    <tr><td></td><td><input name="id" id="id" type="hidden" value="<?php echo $item['id'];?>"></td></tr>
    <tr><td>Описание:</td><td><textarea name="todo" id="todo" type="textarea" size="100" maxlenght="2000" ><?php echo empty($item['todo'])?"":$item['todo'];?></textarea></td></tr>
    <tr><td>Готово:</td><td><input name="fix" id="fix" type="text" size="1" maxlenght="1" value="<?php echo empty($item['fix'])?"":$item['fix'];?>"></td></tr>
    <tr><td>дата фикса:</td><td><input name="fixdate" id="fixdate" type="text" size="14" maxlenght="14" value="<?php echo empty($item['fixdate'])?date('Y-m-d'):$item['fixdate'];?>"></td></tr>
    <tr><td>Версия:</td><td><input name="rev" id="rev" type="text" size="10" maxlenght="10" value="<?php echo empty($item['rev'])?"":$item['rev'];?>"></td></tr>
    <tr><td></td><td><BUTTON name="editimprove" value="true" type="submit">Сохранить!</BUTTON></td></tr>
    <tr><td><a href="./listimpr.php">К списку</a></td><td></td></tr>
    </form>
</table>
<?php 
include('./set_foot.php');
