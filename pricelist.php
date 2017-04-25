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
include('set_head.php');
include('set_config.php');
include('set_title.php');
//header('Location:reconstruct.php');
?>
<form name="criteria" action="listcont.php" method="POST"><p>
<input name="group" type="text" maxlenght="16" autofocus value="">
<BUTTON name="search" value="true" type="text">Выбрать</BUTTON> Вы также можете <a href="addprice.php">добавить</a> новую позицию прайса</p>
</form>
<?php 
//Задаем критерии для вывода именно услуг:


//Формируем запрос по услугам (не по товарам.товары имеют поля заполненные поля состояние и доставка):
$price_sql='SELECT `id`,`name`,`descript`,`state`,`delivery`,`warranty`,`cost`,`terms` FROM `price`';
  //echo "SQL = ".$price_sql;
if ($price=$mysqli->query($price_sql))
{
	while ($row = $price->fetch_array(MYSQLI_NUM)) {	
		echo '<table><tr><td><a href="inventories.php?key='.$row[0].'">#</a></td><td>';
		echo '<a href="editprice.php?key='.$row[0].'">'.(($row[2]==='')?'Noname':$row[1]).'</a> ';
		echo $row[2].' ';
		echo ($row[3]=='')?'':$row[3]." ";
		echo ($row[4]=='')?'':$row[4]." ";
		echo ($row[5]=='')?'':$row[5]." ";
		echo ($row[6]=='')?'':$row[6].' грн.<td></tr></table>';}
	$price->free();
}
include('set_foot.php');
?>
