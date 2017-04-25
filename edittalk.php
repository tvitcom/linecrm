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

//-----------------Обработка сохраняемых данных в таблицы: hist и cash--------------------------

@$editid = $_GET['id'] ? intval($mysqli->real_escape_string($_GET['id'])) : intval($_POST['id']);
$edittalk_sql = "SELECT h.keycont, h.dateconn, h.talk, h.status, h.ready, h.id, h.schedule, h.work, c.coin FROM hist h LEFT JOIN cash c ON (c.keyhist=h.id) WHERE h.id=" . intval($editid);
//echo "<p>hist.id = $editid SQL: $edittalk_sql";
$resultid = $mysqli->query($edittalk_sql);
$itemtalk = $resultid->fetch_assoc();
if (isset($_POST["savetalk"]) && ($_POST["savetalk"] == "true")) {
    //тут форимируется обновление для hist
    $update_talk_sql = sprintf('UPDATE `hist` SET `dateconn`="%1$s", `talk`="%2$s", `status`=%3$u,`ready`=%4$u, `schedule`="%5$s", `work`="%6$s" WHERE `id`=%7$u', $mysqli->real_escape_string($_POST['dateconn']), //1
        $mysqli->real_escape_string($_POST['talk']), //2
        $itemtalk['status'], //3
        empty($_POST['ready']) ? 0 : 1, //4
        $mysqli->real_escape_string($_POST['schedule']), //5
        $mysqli->real_escape_string($_POST['work']), //6
        intval($_POST['id']));//7
    $mysqli->query($update_talk_sql);
    // echo "<p>Запрос: ".$update_talk_sql."</p>";

    $is_coin_sql = 'SELECT id FROM cash WHERE keyhist=' . $editid;
    $coin_is = $mysqli->query($is_coin_sql);

    if ($coin_is->num_rows) {
        if (empty($_POST['coin'])) {
            $delete_cash_sql = sprintf('DELETE FROM `cash` WHERE `keyhist` = %1$u', intval($editid));
            $mysqli->query($delete_cash_sql);
            //echo "<p> SQL: ".$delete_cash_sql;
        } else {

            $update_cash_sql = sprintf('UPDATE `cash` SET `coin` = %1$u WHERE `keyhist` = %2$u', intval($_POST['coin']), //1
                $editid);//2
            $mysqli->query($update_cash_sql);
            //echo "<p>SQL: ".$update_cash_sql;
        }
    } else {

        $insert_cash_sql = 'INSERT INTO `cash` (coin, keyhist) VALUES (' . intval($_POST['coin']) . ' ,' . $editid . ')';
        $mysqli->query($insert_cash_sql);
        // echo "<p>Запрос: ".$insert_cash_sql."</p>";
    }
    $keycont = $itemtalk['keycont'];
    header("Location: ./listtalk.php?key=$keycont");
    exit();
}
//echo '<font color="green">Данные успешно сохранены!</font><br>';

if (isset($_POST["deletetalk"]) && ($_POST["deletetalk"] == "true")) {
    $delete_talk_sql = 'DELETE FROM hist WHERE id=' . intval($editid);
    $mysqli->query($delete_talk_sql);
    $delete_cash_sql = 'DELETE FROM cash WHERE keyhist=' . intval($editid);
    $mysqli->query($delete_cash_sql);
    //echo "Данные id = ".$editid." подготовлены к Удалению: ".$delete_cash_sql;
    //echo '<font color="orange">Запись общения успешно УДАЛЕНА!</font><br>';
    $keycont = $itemtalk['keycont'];
    header("Location: ./listtalk.php?key=$keycont");
    exit();
}

include('./set_head.php');
include('./set_title.php');

//header('Location:reconstruct.php');


echo "<p>Редактирование записи общения для";
$whois_sql = sprintf('SELECT fio, whois FROM cont WHERE id=%1$u', intval(isset($_POST['keycont']) ? $_POST['keycont'] : @$itemtalk['keycont']));
if ($rowfio = $mysqli->query($whois_sql)) {
    $rec = $rowfio->fetch_array();
    $t = ($rec[1]) ? $rec[1] : $rec[0];
    echo '<a href="./editcont.php?key=' . (isset($_POST['keycont']) ? $_POST['keycont'] : @$itemtalk['keycont']) . '">' . $t . '</a>';
    $rowfio->free();
} else {
    echo "Error!";
}

?>
<form name="edittalkid" action="./edittalk.php" method="POST">
    <table border="0">
        <tr><td></td><td><input name="id" type="hidden" value="<?php echo isset($_POST['id']) ? $_POST['id'] : $itemtalk['id']; ?>" ></input></td></tr>
        <tr><td></td><td><input name="keycont" type="hidden" value="<?php echo isset($_POST['keycont']) ? $_POST['keycont'] : $itemtalk['keycont']; ?>" ></input></td></tr>
        <tr><td>Дата (гггг-мм-дд):</td><td><input name="dateconn" type="text" id="dateconn" maxlenght="10" value="<?php echo isset($_POST['dateconn']) ? $_POST['dateconn'] : $itemtalk['dateconn']; ?>" ></input></td></tr>
        <tr><td>Суть:</td><td><textarea name="talk" type="text" maxlenght="2000" id="talk"><?php echo isset($_POST['talk']) ? $_POST['talk'] : $itemtalk['talk']; ?></textarea></td></tr>
        <tr><td>Назначение (гггг-мм-дд):</td><td><input name="schedule" type="text" id="schedule" maxlenght="10" value="<?php echo ($itemtalk['schedule'] === "0000-00-00") ? "" : $itemtalk['schedule']; ?>" ></input></td></tr>
        <tr><td>Работа:</td><td><textarea name="work" type="text" maxlenght="2000" id="work"><?php echo isset($_POST['work']) ? $_POST['work'] : $itemtalk['work']; ?></textarea></td></tr>
        <tr><td>Выполнено:</td><td><label><input name="ready" type="checkbox" id="ready" <?php if ($itemtalk['ready'] == 1) echo "checked"; ?>><span>Готово</span></label></td></tr>
        <tr><td>Приход:</td><td><input name="coin" type="text" id="coin" maxlenght="8" value="<?php echo isset($_POST['coin']) ? $_POST['coin'] : $itemtalk['coin']; ?>"></input></td></tr>
                <?php if (!isset($_POST["deletetalk"])) echo '<tr><td><BUTTON name="savetalk" value="true" type="submit" autofocus >Подтвердить</BUTTON></td><td><BUTTON name="deletetalk" value="true" type="submit">Удалить запись!</BUTTON></td></tr>'; ?>
        <tr><td></td><td></td></tr>
        <tr><td><a href="./listtalk.php?key=<?php echo $itemtalk['keycont']; ?>">К списку истории</a></td><td></a></td></tr>
    </table>
</form>
<?php
$mysqli->close();
include('./set_foot.php');

?>
