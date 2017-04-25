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
?>
<p>Создание прайса: 
<p><font color="orange">Поля "описание" и "цена" заполнять обязательно!</font></p>
<?php
if (isset($_POST["addprice"]) && $_POST["addprice"]== TRUE && strlen($_POST['descript'])>=3 && $_POST['cost']>0) {
	$create_price_sql=sprintf('INSERT INTO `linecrm`.`price` ( `name`, `descript`, `state`, `delivery`, `warranty`, `cost`, `terms`) VALUES ("%1$s", "%2$s", "%3$s", "%4$s", "%5$s", %6$u, "%7$s")',
	$mysqli->real_escape_string($_POST['name']),//1
	$mysqli->real_escape_string($_POST['descript']),//2
	$mysqli->real_escape_string($_POST['condition']),//3
	$mysqli->real_escape_string($_POST['delivery']),//4
	$mysqli->real_escape_string($_POST['warranty']),//5
	intval($_POST['cost']),//6
	$mysqli->real_escape_string($_POST['terms']));//7
	if ($mysqli->query($create_price_sql)) {
		header('Location: ./pricelist.php');
	}
		echo "<p>Ошибка!";
		echo "<p>Запрос: ".$create_price_sql;
} else {
?>
<form name="createprice" action="/addprice.php" method="POST">
<table>
<tr><td></td><td>
<tr><td>Продукт:</td><td><input name="name" type="text" id="name" size="16" maxlenght="16" value="<?php echo isset($_POST['name'])?$_POST['name']:"";?>" ></input></td></tr>
<tr><td>Описание:</td><td><input name="descript" type="text" id="descript" size="60" maxlenght="99" value="<?php echo isset($_POST['descript'])?$_POST['descript']:"";?>" ></input></td></tr>
<tr><td>Состояние:</td><td><input name="condition" type="text" id="condition" size="12" maxlenght="12" value="<?php echo isset($_POST['condition'])?$_POST['condition']:"";?>"></input></td></tr>
<tr><td>Доставка:</td><td><input name="delivery" type="text" id="delivery" size="10" maxlenght="10" value="<?php echo isset($_POST['delivery'])?$_POST['delivery']:"";?>" ></input></td></tr>
<tr><td>Гарантия:</td><td><input name="warranty" type="text" id="warranty" size="10" maxlenght="6" value="<?php echo isset($_POST['warranty'])?$_POST['warranty']:"";?>" ></input></td></tr>
<tr><td>Цена:</td><td><input name="cost" type="text" id="cost" size="10" maxlenght="5" value="<?php echo isset($_POST['cost'])?$_POST['cost']:0;?>"></input></td></tr>
<tr><td>Условие:</td><td><input name="terms" type="text" id="terms" size="30" maxlenght="30" value="<?php echo isset($_POST['terms'])?$_POST['terms']:"";?>" ></input></td></tr>
<tr><td></td><td><BUTTON name="addprice" value="true" type="submit" autofocus >Создать!</BUTTON></td></tr>
</table>
   </form>
 <a href="/pricelist.php">К списку</a>
<?php
}
include('./set_foot.php');