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
include('set_title.php');
include('set_config.php');
//header('Location:reconstruct.php');

$yearnow = getdate();
$filter_year = isset($_COOKIE['year'])?$_COOKIE['year']:$yearnow['year'];
$yearsearch = isset($_POST["searchyear"])?$mysqli->real_escape_string($_POST['searchyear']):$filter_year;

//------------Для какого контакта выводится история:------------------------------------------

if (isset($_REQUEST['key'])) {
	$realkeycont = intval($_REQUEST['key']);
}
else {
	$realkeycont = 0;
}
$_SESSION['keycont'] = $realkeycont;
echo '<p><a href="listcont.php">Назад</a> История общения с контактом: ';
$whois_sql = sprintf('SELECT fio, whois FROM cont WHERE id=%1$u', intval($realkeycont));
$rowfio = $mysqli->query($whois_sql);
$rec = $rowfio->fetch_array();
$t = ($rec[1])?$rec[1]:$rec[0];
echo '<a href="/editcont.php?key='.$realkeycont.'">'.$t.'</a>';
$rowfio->free();
 //echo 'SQL: '.whois_sql;
 //echo 'realkeycont = '.$realkeycont;

//-----------------Формируем входные переметры-------------------------------------------------

if (isset($_REQUEST['key']) && $realkeycont > 0) {

	?>
	Вы также можете <a href="addtalk.php?key=<?php echo intval($realkeycont); ?>">добавить</a>новую запись.</p>
	<?php

}

//----------------Формируем сам запрос для вывода:---------------------------------------------

$talks_sql = sprintf('
	SELECT h.keycont, h.dateconn ,h.talk, h.status, h.ready, h.id, c.coin 
	FROM hist h LEFT JOIN cash c ON (h.id=c.keyhist) 
	WHERE keycont=%1$u AND %2$u=%2$u/*year(dateconn)=%2$u*/ ORDER BY dateconn',
		intval($mysqli->real_escape_string($realkeycont)),
		intval($yearsearch));
$search_sql_talks=$mysqli->query($talks_sql);
 //echo '<p>Запрос: '.$talks_sql."<br/>";
 //echo '<p>realkeycont = '.$realkeycont."<br/>";
?>
<!-- Выводим строки -->

<form name="Searchyeartalk" action="listtalk.php" method="POST">
	 <table>
		<td><input name="key" type="hidden" value="<?php  echo $realkeycont; ?>"></td>
		<td><input name="searchyear" type="text" maxlenght="4" value="<?php  echo 'Все';/*$yearsearch;*/ ?>"></td>
		<td><BUTTON name="filter" value="true" type="text" autofocus>Поиск по году общения</BUTTON></td></tr>
	 </table>
 </table>
<form>
	<?php 
if ($search_sql_talks->num_rows) {		echo '<table><th>Дата:</th><th>Событие:</th><th>Приход:</th><th>Статус:</th>';
	while ($row = $search_sql_talks->fetch_array(MYSQLI_ASSOC))	{
	
	   	echo "<tr><td>".'<a href="edittalk.php?id='.$row['id'].'">'.$row['dateconn'].'</a></td>';//дата и ссылка из неё
	   	echo "<td>".$row['talk']."</td>";//разговор
	   
	   if (empty($row['coin'])) echo "<td></td>";  else  echo "<td>".$row['coin']." грн.</td>";
	   	echo "<td>готово:".$row['ready']."</td></tr>";
	 }
}
	echo '</table>';
	$search_sql_talks->free(); ?>
</form>
<?php 
$mysqli->close();
include('set_foot.php');
?>
