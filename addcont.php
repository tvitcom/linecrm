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
if (isset($_POST["addrecord"]) && $_POST["addrecord"] == TRUE && strlen($_POST['whois']) >= 3) {
    $create_cont_sql = sprintf('INSERT INTO `cont` (fio ,whois, organis, emails, telh, fax, mob2, mob1, addr, addrh, addrw, web, birth, note, foto, cat) VALUES
 ("%1$s", "%2$s", "%3$s", "%4$s", "%5$s", "%6$s", "%7$s", "%8$s", "%9$s", "%10$s", "%11$s", "%12$s", "%13$s", "%14$s", "%15$s", "%16$s")', $mysqli->real_escape_string($_POST['fio']), //1
        $mysqli->real_escape_string($_POST['whois']), //2
        $mysqli->real_escape_string($_POST['organis']), //3
        $mysqli->real_escape_string($_POST['emails']), //4
        $mysqli->real_escape_string($_POST['telh']), //5
        $mysqli->real_escape_string($_POST['fax']), //6
        $mysqli->real_escape_string($_POST['mob2']), //7
        $mysqli->real_escape_string($_POST['mob1']), //8
        $mysqli->real_escape_string($_POST['addr']), //9
        $mysqli->real_escape_string($_POST['addrh']), //10
        $mysqli->real_escape_string($_POST['addrw']), //11
        $mysqli->real_escape_string($_POST['web']), //12
        $mysqli->real_escape_string($_POST['birth']), //13
        $mysqli->real_escape_string($_POST['note']), //14
        $mysqli->real_escape_string($_POST['foto']), //15
        $mysqli->real_escape_string($_POST['cat']));//16

    $mysqli->query($create_cont_sql);
//echo "<p>SQL=".$create_cont_sql;
    header('Location: ./listcont.php');
    exit();
}

include('./set_head.php');
include('./set_title.php');

?>
<h4>Создание нового контакта:&nbsp</h4>
<p>Поле <font color="orange">"Приметка"</font> заполнять обязательно.</p>
<?php

?>
<form name="CreateItem" action="/addcont.php" method="POST">
    <table border="0">
        <tr><td>ФИО:</td><td><input name="fio" type="text" id="fio" size="50" maxlenght="62" value="<?php echo isset($_POST['fio']) ? $_POST['fio'] : ''; ?>" ></input></td></tr>
        <tr><td>Приметка:</td><td><input name="whois" type="text" id="whois" size="50" maxlenght="80" value="<?php echo isset($_POST['whois']) ? $_POST['whois'] : ''; ?>" ></input></td></tr>
        <tr><td>Организация:</td><td><input name="organis" type="text" id="organis" size="50" maxlenght="93" value="<?php echo isset($_POST['organis']) ? $_POST['organis'] : ''; ?>" ></input></td></tr>
        <tr><td>Почта:</td><td><input name="emails" type="text" id="emails" size="50" maxlenght="57" value="<?php echo isset($_POST['emails']) ? $_POST['emails'] : ''; ?>" ></input></td></tr>
        <tr><td>Телефон:</td><td><input name="telh" type="text" id="telh" size="16" maxlenght="16" value="<?php echo isset($_POST['telh']) ? $_POST['telh'] : ''; ?>" ></input></td></tr>
        <tr><td>Рабочий:</td><td><input name="fax" type="text" id="fax" size="16" maxlenght="16" value="<?php echo isset($_POST['fax']) ? $_POST['fax'] : ''; ?>" ></input></td></tr>
        <tr><td>Другой:</td><td><input name="mob2" type="text" id="mob2" size="16" maxlenght="16" value="<?php echo isset($_POST['mob2']) ? $_POST['mob2'] : ''; ?>" ></input></td></tr>
        <tr><td>Мобильный:</td><td><input name="mob1" type="text" id="mob1" size="16" maxlenght="16" value="<?php echo isset($_POST['mob1']) ? $_POST['mob1'] : ''; ?>" ></input></td></tr>
        <tr><td>Проживает:</td><td><input name="addr" type="text" id="addr" size="100" maxlenght="148" value="<?php echo isset($_POST['addr']) ? $_POST['addr'] : ''; ?>" ></input></td></tr>
        <tr><td>Домашний:</td><td><input name="addrh" type="text" id="addrh" size="100" maxlenght="100" value="<?php echo isset($_POST['addrh']) ? $_POST['addrh'] : ''; ?>" ></input></td></tr>
        <tr><td>Рабочий:</td><td><input name="addrw" type="text" id="addrw" size="100" maxlenght="80" value="<?php echo isset($_POST['addrw']) ? $_POST['addrw'] : ''; ?>" ></input></td></tr>
        <tr><td>Сайт:</td><td><input name="web" type="text" id="web" size="50" maxlenght="43" value="<?php echo isset($_POST['web']) ? $_POST['web'] : ''; ?>" ></input></td></tr>
        <tr><td>Дата рождения:</td><td><input name="birth" type="text" id="birth" size="10" maxlenght="10" value="<?php echo isset($_POST['birth']) ? $_POST['birth'] : ''; ?>" ></input></td></tr>
        <tr><td>Заметки:</td><td><textarea name="note" type="text" maxlenght="4000" id="note"><?php echo isset($_POST['note']) ? $_POST['note'] : ''; ?></textarea></td></tr>
        <tr><td>Фото:</td><td><input name="foto" type="text" id="foto" size="50" maxlenght="255" value="<?php echo isset($_POST['foto']) ? $_POST['foto'] : ''; ?>" ></input></td></tr>
        <tr><td>Категории:</td><td><input name="cat" type="text" id="cat" size="50" maxlenght="255" value="<?php echo isset($_POST['cat']) ? $_POST['cat'] : ''; ?>" ></input></td></tr>
        <tr><td></td><td><BUTTON name="addrecord" value="true" type="submit" autofocus >Создать!</BUTTON></td></tr>
    </table>
</form>
<p><a href="/listcont.php">К списку</a></p>
<?php include('./set_foot.php'); 