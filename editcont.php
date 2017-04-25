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
@$Editid=$_GET['key']?$mysqli->real_escape_string($_GET['key']):$_POST['key'];
$Result=$mysqli->query("SELECT * FROM `cont` WHERE `id` =".intval($Editid));
$Item=$Result->fetch_assoc();
?>
<h4>Редактирование контакта:&nbsp</h4>
<?php if (isset($_POST["saverecord"]) && $_POST["saverecord"]==TRUE)    {

$update_edit_cont=sprintf('UPDATE `cont` SET fio="%1$s", whois="%2$s", organis="%3$s", emails="%4$s", telh="%5$s", fax="%6$s", mob2="%7$s", mob1="%8$s", addr="%9$s", addrh="%10$s", addrw="%11$s", web="%12$s", birth="%13$s", note="%14$s", foto="%15$s", cat="%16$s" WHERE `id`=%17$u',
	$mysqli->real_escape_string($_POST['fio']),//1
	$mysqli->real_escape_string($_POST['whois']),//2
	$mysqli->real_escape_string($_POST['organis']),//3
	$mysqli->real_escape_string($_POST['emails']),//4
	$mysqli->real_escape_string($_POST['telh']),//5
	$mysqli->real_escape_string($_POST['fax']),//6
	$mysqli->real_escape_string($_POST['mob2']),//7
	$mysqli->real_escape_string($_POST['mob1']),//8
	$mysqli->real_escape_string($_POST['addr']),//9
	$mysqli->real_escape_string($_POST['addrh']),//10
	$mysqli->real_escape_string($_POST['addrw']),//11
	$mysqli->real_escape_string($_POST['web']),//12
	$mysqli->real_escape_string($_POST['birth']),//13
	$mysqli->real_escape_string($_POST['note']),//14
	$mysqli->real_escape_string($_POST['foto']),//15
	$mysqli->real_escape_string($_POST['cat']),//16
	$Editid);//17

$mysqli->query($update_edit_cont); //or die('</font color="red">Обновление данных не выполнено из-за ошибки!</font>'.'<p><a href="listcont.php">Назад</a></p>');
//echo '<p>Запрос на обновление:'.$update_edit_cont.'</p>';	
echo '<p><font color="green">Данные успешно сохранены!</font><br>';	 }
   
   elseif (isset($_POST["deleterecord"]) && $_POST["deleterecord"]==TRUE) {

	$delete_record_sql=sprintf('DELETE FROM `cont` WHERE `id`=%1$u',intval($Editid));
	$mysqli->query($delete_record_sql);
	//echo "SQL_UPDATE: ".$delete_record_sql;
	echo '<p><font color="orange">Запись успешно УДАЛЕНА!</font></p>';	  
                                                                             }

?>
 <form name="EditItem" action="./editcont.php" method="POST">
 <table border="0">
	<tr><td></td><td><input name="key" type="hidden" value="<?php echo isset($_POST['key'])?$_POST['key']:$Item['id'];?>" ></input></td></tr>
	<tr><td></td><td><input name="searchstring" type="hidden" value="<?php echo isset($_POST['serchstring'])?$_POST['searchstring']:'searchsword';?>" ></input></td></tr>
	<tr><td>ФИО:</td><td><input name="fio" type="text" id="fio" size="50" maxlenght="62" value="<?php echo isset($_POST['fio'])?$_POST['fio']:$Item['fio'];?>" ></input></td></tr>
	<tr><td>Приметка:</td><td><input name="whois" type="text" id="whois" size="80" maxlenght="80" value="<?php echo isset($_POST['whois'])?$_POST['whois']:$Item['whois'];?>" ></input></td></tr>
	<tr><td>Организация:</td><td><input name="organis" type="text" id="organis" size="80" maxlenght="93" value="<?php echo isset($_POST['organis'])?$_POST['organis']:$Item['organis'];?>" ></input></td></tr>
	<tr><td>Почта:</td><td><input name="emails" type="text" id="emails" size="50" maxlenght="57" value="<?php echo isset($_POST['emails'])?$_POST['emails']:$Item['emails'];?>" ></input></td></tr>
	<tr><td>Телефон:</td><td><input name="telh" type="text" id="telh" size="16" maxlenght="16" value="<?php echo isset($_POST['telh'])?$_POST['telh']:$Item['telh'];?>" ></input></td></tr>
	<tr><td>Рабочий:</td><td><input name="fax" type="text" id="fax" size="16" maxlenght="16" value="<?php echo isset($_POST['fax'])?$_POST['fax']:$Item['fax'];?>" ></input></td></tr>
	<tr><td>Другой:</td><td><input name="mob2" type="text" id="mob2" size="16" maxlenght="16" value="<?php echo isset($_POST['mob2'])?$_POST['mob2']:$Item['mob2'];?>" ></input></td></tr>
	<tr><td>Мобильный:</td><td><input name="mob1" type="text" id="mob1" size="16" maxlenght="16" value="<?php echo isset($_POST['mob1'])?$_POST['mob1']:$Item['mob1'];?>" ></input></td></tr>
	<tr><td>Проживает:</td><td><input name="addr" type="text" id="addr" size="100" maxlenght="148" value="<?php echo isset($_POST['addr'])?$_POST['addr']:$Item['addr'];?>" ></input></td></tr>
	<tr><td>Домашний:</td><td><input name="addrh" type="text" id="addrh" size="100" maxlenght="100" value="<?php echo isset($_POST['addrh'])?$_POST['addrh']:$Item['addrh'];?>" ></input></td></tr>
	<tr><td>Рабочий:</td><td><input name="addrw" type="text" id="addrw" size="100" maxlenght="80" value="<?php echo isset($_POST['addrw'])?$_POST['addrw']:$Item['addrw'];?>" ></input></td></tr>
	<tr><td>Сайт:</td><td><input name="web" type="text" id="web" size="50" maxlenght="43" value="<?php echo isset($_POST['web'])?$_POST['web']:$Item['web'];?>" ></input></td></tr>
	<tr><td>Дата рождения:</td><td><input name="birth" type="text" size="10" id="birth" maxlenght="10" value="<?php echo isset($_POST['birth'])?$_POST['birth']:$Item['birth'];?>" ></input></td></tr>
	<tr><td>Заметки:</td><td><textarea name="note" type="text" maxlenght="4000" id="note"><?php echo isset($_POST['note'])?$_POST['note']:$Item['note'];?></textarea></td></tr>
	<tr><td>Фото:</td><td><input name="foto" type="text" id="foto" size="100" maxlenght="255" value="<?php echo isset($_POST['foto'])?$_POST['foto']:$Item['foto'];?>" ></input></td></tr>
	<tr><td>Категории:</td><td><input name="cat" type="text" id="cat" size="100" maxlenght="255" value="<?php echo isset($_POST['cat'])?$_POST['cat']:$Item['cat'];?>" ></input></td></tr>
	 <?php if (!isset($_POST["deleterecord"])){ echo '<tr><td><BUTTON name="saverecord" value="TRUE" type="submit" autofocus>Подтвердить</BUTTON></td><td><BUTTON name="deleterecord" value=TRUE type="submit">Удалить запись!</BUTTON></td></tr>';} ?>
	<tr><td></td><td></td></tr>
	<tr><td><a href="./listcont.php">К списку</a></td><td><a href="./listtalk.php?key=<?php echo $Item['id']; ?>">История</a></td></tr>
</table>
   </form>
<?php include('./set_foot.php');
