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
//header('Location:./reconstruct.php');

//------------Для какого контакта выводится история:------------------------------------------

echo "<p>Багтрек лист. ";
echo '  Вы также можете создать<a href="addimpr.php">новую</a> запись в "TO-DO".';

//-----------------Формируем входные переметры-------------------------------------------------



//----------------Формируем сам запрос для вывода:---------------------------------------------

$improvelist_sql = "SELECT `id`, `todo`, `when`, `fix`, `fixdate`, `rev`, `developerid` FROM `impr`";

  //echo "<p>SQL: ".$improvelist_sql;

if ( $res = $mysqli->query($improvelist_sql)) {

//----------------- Выводим строки: -------------------------------------------------------------

   if ($res->num_rows) {
	echo "<table>";
	echo "<th>id</th><th>todo</th><th>time</th><th>fix</th><th>fixdate</th><th>revision</th><th>developerid</th>"; 


	while ($bugitem = $res->fetch_assoc()) {
		
		echo "<tr>";
		echo "<td><a href='editimprove.php?id=".$bugitem['id']."'>".$bugitem['id']."</a></td>";
		echo "<td>".$bugitem['todo']."</td>";
		echo "<td>".$bugitem['when']."</td>";
		echo "<td>".$bugitem['fix']."</td>";
		echo "<td>".$bugitem['fixdate']."</td>";
		echo "<td>".$bugitem['revision']."</td>";
		echo "<td>".$bugitem['developerid']."</td>";
		echo "</tr>";
	   
	}

	echo "</table>";
   }

} else { echo '<p><font color="red">Запрос не выполнен!!!</font></p>';}

echo '<p><a href="./settings.php">Назад</a></p>';
include('./set_foot.php');
?>
