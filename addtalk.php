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
include('./set_config.php');

if (isset($_POST["addtalk"]) && ($_POST["addtalk"] == TRUE) && (strlen($_POST['talk']) >= 3)) {
    $create_talk_sql = sprintf('INSERT INTO `hist` (keycont, dateconn, talk, work, status, schedule, ready, id) VALUES (%1$u, "%2$s", "%3$s","%4$s", 0, "%5$s", %6$u, NULL)', intval($_POST['keycont']), //1
        $mysqli->real_escape_string($_POST['dateconn']), //2
        $mysqli->real_escape_string($_POST['talk']), //3
        $mysqli->real_escape_string($_POST['work']), //4
        $mysqli->real_escape_string($_POST['schedule']), //5
        empty($_POST['ready']) ? 0 : 1);//6
    $mysqli->query($create_talk_sql);
//echo "Запрос: ".$create_talk_sql;

    if (isset($_POST['addtalk']) && $_POST['coin'] > 0) {
        $add_cash_sql = sprintf('INSERT INTO `cash` (coin, keyhist) VALUES ( %1$u ,%2$u)', intval($_POST['coin']), $mysqli->insert_id);
        $mysqli->query($add_cash_sql);
//echo "<p>Запрос: ".$add_cash_sql."</p>";
    }

    $keycont = isset($_GET['key']) ? intval($_GET['key']) : intval($_POST['keycont']);
//    echo 'S<p>$keycont = ' . $keycont;
    header("Location: ./listtalk.php?key=$keycont");
    exit();
}

include('./set_head.php');
include('./set_title.php');

//header('Location:reconstruct.php');

echo "<p>Создание общения с человеком: <b>";
//пришлось повозится с сохранением и инициализацией $keycont
@$who_sql = sprintf('SELECT fio, whois FROM cont WHERE id=%1$u', $keycont = intval($_GET['key']));
$rowfio = $mysqli->query($who_sql);
$rec = $rowfio->fetch_assoc();
echo ($rec['fio'] === '') ? $rec['whois'] : $rec['fio'];
echo "</b></p>";
$rowfio->free();

?>
<form name="Createtalk" action="" method="POST">
    <table border="0">
        <tr><td></td><td><input name="keycont" type="hidden" id="keycont" value="<?php echo isset($_GET['key']) ? $_GET['key'] : $_POST['keycont']; ?>" ></input></td></tr>
        <tr><td>Дата (гггг-мм-дд):</td><td><input name="dateconn" type="text" id="dateconn" size="10" maxlenght="10" value="<?php echo isset($_POST['dateconn']) ? $_POST['dateconn'] : date('Y-m-d'); ?>" ></input></td></tr>
        <tr><td>Суть:</td><td><textarea name="talk" type="text" maxlenght="2000"  size="110" id="talk"><?php echo isset($_POST['talk']) ? $_POST['talk'] : ''; ?></textarea></td></tr>
        <tr><td>Назначение (гггг-мм-дд):</td><td><input name="schedule" type="text" id="schedule" maxlenght="10"  value="<?php echo isset($_POST['schedule']) ? $_POST['schedule'] : date('Y-m-d'); ?>"></input></td></tr>
        <tr><td>Работа:</td><td><textarea name="work" type="text" maxlenght="2000" id="work"><?php echo isset($_POST['work']) ? $_POST['work'] : @$itemtalk['work']; ?></textarea></td></tr>
        <tr><td>Выполнено:</td><td><label><input name="ready" type="checkbox" id="ready"<?php
if (isset($_POST['ready']) && ($_POST['ready'] === 'on')) {
    echo "checked";
}

?> ><span>Готово</span></label></td></tr>
        <tr><td>Приход:</td><td><input name="coin" type="text" id="coin" size="10" maxlenght="4" value="<?php echo isset($_POST['coin']) ? $_POST['coin'] : ''; ?>" ></input></td></tr>
        <tr><td></td><td><BUTTON name="addtalk" value="true" type="submit" autofocus >Создать!</BUTTON></td></tr>
    </table>
</form>
<?php
@$link = empty($keycont) ? ($keycont = $_POST['keycont']) : $keycont;
echo "<p><a href=" . '"/listtalk.php?key=' . $link . '">К списку</a>';
include('./set_foot.php');

