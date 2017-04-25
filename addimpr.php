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

//------------ Входные пареметры: ----------------------

echo '<p><h4>Страница создания записи в план "TO-DO" системы "MyCRM"</h4></p>';

//------------Создаем запрос на внесение данных: -------

if (isset($_POST['addimprove']) && $_POST['addimprove'] == TRUE) {
	$addbug_sql = sprintf('INSERT INTO `impr` (`id`, `todo`, `when`, `fix`, `fixdate`, `rev`) VALUES ( NULL, "%1$s", "%2$s", %3$u, "%4$s", "%5$s")',
	$mysqli->real_escape_string($_POST['todo']),//1
	$mysqli->real_escape_string($_POST['when']),//2
	intval($mysqli->real_escape_string($_POST['fix'])),//3
	$mysqli->real_escape_string($_POST['fixdate']),//4
	$mysqli->real_escape_string($_POST['rev']));//5
	  //echo "<p>sql: ".@$addbug_sql;

	if ($mysqli->query($addbug_sql)) {
		echo '<p><h4><font color="green"></font></h4><p>';
	header('Location:./listimpr.php');
	}
}
?>
<table>
    <form name="addimprove" action="/addimpr.php" method="POST">
    <tr><td></td><td><input name="when" type="hidden" size="19" maxlenght="19" value="<?php echo DATE('Y-m-d H:i:s');?>"></td></tr>
    <tr><td>Планируемое:</td><td><textarea name="todo" id="todo" type="textarea" size="100" maxlenght="2000" ><?php echo empty($_POST['todo'])?"":$_POST['todo'];?></textarea></td></tr>
    <tr><td>на дату:</td><td><input name="fixdate" id="fixdate" type="text" size="14" maxlenght="14" value="<?php echo empty($_POST['fixdate'])?"":$_POST['fixdate'];?>"></td></tr>
    <tr><td>в версии:</td><td><input name="rev" id="rev" type="text" size="10" maxlenght="10" value="<?php echo empty($_POST['rev'])?"":$_POST['rev'];?>"></td></tr>
    <tr><td></td><td><BUTTON name="addimprove" value="true" type="submit">Создать!</BUTTON></td></tr>
    <tr><td><a href="/settings.php">К списку</a></td><td></td></tr>
    </form>
</table>
<?
include('./set_foot.php');
