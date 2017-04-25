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
//Критерии фильтрации - Задаем начальное значение переменной поиска
$up_word = isset($_SESSION['searchword'])?$_COOKIE['searchword']:'клиент';
$keysearch = isset($_POST["searchstring"])?$mysqli->real_escape_string($_POST['searchstring']):$up_word;
//setcookie('searchword',$keysearch);

$search_sql1='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `fio` like "%'.$keysearch.'%"';
$search_sql2='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `whois` like "%'.$keysearch.'%"';
$search_sql3='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `telh` like "%'.$keysearch.'%"';
$search_sql4='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `fax` like "%'.$keysearch.'%"';
$search_sql5='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `mob1` like "%'.$keysearch.'%"';
$search_sql6='SELECT `id`, `fio` ,`whois`, `telh`, `fax`, `mob1`,`mob2` FROM `cont` where `mob2` like "%'.$keysearch.'%"';

//В форму можно вводить поисковое слово или номера по которым будет выведены контакты 
//по вхождению этого набора.
$search_sql_union=$search_sql1." union ".$search_sql2." union ".$search_sql3." union ".$search_sql4." union ".$search_sql5." union ".$search_sql6;
$search_sql_complete=$mysqli->query($search_sql_union);
?>

<form name="Searchcont" action="./listcont.php" method="POST">
<p><input name="searchstring" type="search" placeholder="Введите текст для поиска" size="25" style="color:grey" autofocus>
<BUTTON name="search" value="true" type="text">Поиск!</BUTTON>  Вы также можете <a href="./addcont.php">добавить</a> новый контакт.
</form>
<?php  echo '<table>';
while ($row = $search_sql_complete->fetch_array(MYSQLI_NUM))	{
	echo '<tr><td><a href="/listtalk.php?key='.$row[0].'">#</a></td>';
	echo '<td><a href="/editcont.php?key='.$row[0].'">'.(($row[2]=='')?'Noname':$row[2]).'</a>&nbsp';
	echo $row[1].' ';
	echo ($row[3]=='')?'':$row[3]."&nbsp";
	echo ($row[4]=='')?'':$row[4]."&nbsp";
	echo ($row[5]=='')?'':$row[5]."&nbsp";
	echo ($row[6]=='')?'':$row[6]."</td></tr>";
	} echo '</table>'; 
$search_sql_complete->free();
include('./set_foot.php');?>
