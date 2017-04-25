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

echo '<p><h4>Все незакрытые дела на сегодняшний день:</h4>';
if (isset($_GET['key'])) {
    $realkeycont = $_GET['key'];
} else {
    $realkeycont = 0;
}
//echo ' Вы можете ';
//echo '<a href="addtalk.php?key='.intval($realkeycont).'">добавить</a>&nbspновую запись.</p>';
//Критерии фильтрации списка: Задаем начальное значение переменной поиска
$tasks_sql = sprintf('SELECT h.keycont, h.dateconn, c.fio, h.talk, h.status, h.schedule, h.ready, h.id, c.id FROM hist h LEFT JOIN cont c ON (h.keycont=c.id) WHERE c.id>0 AND h.ready<>1 AND h.schedule<>"0000-00-00" ORDER BY dateconn', intval($mysqli->real_escape_string($realkeycont)));
$search_sql_tasks = $mysqli->query($tasks_sql);
//echo 'Запрос: '.$tasks_sql."<br/>";

echo '<table>';
while ($row = $search_sql_tasks->fetch_array(MYSQLI_NUM)) {
    echo "<tr><td>" . '<a href="./listtalk.php?key=' . $row[8] . '">' . $row[1] . '</a></td>';//дата и ссылка из неё
    echo "<td>" . $row[2] . "</td>";//фио контакта
    echo "<td>" . $row[3] . "</td>";//задача
    echo "<td>готово:" . $row[6] . "</td></tr>";
}
echo '</table>';
$search_sql_tasks->free();

?>
</form>
<?php include('./set_foot.php'); ?>
