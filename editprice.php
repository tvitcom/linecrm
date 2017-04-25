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

//Обработка входных параметров полученных на страницу

@$realkey=isset($_POST['key'])?intval($_POST['key']):intval($_GET['key']);

//Тут формируется данные для начального вывода на страницу:

$priceitem_sql=sprintf('SELECT id, name, descript, state, delivery, warranty, cost, terms FROM price WHERE id = %1$u', $realkey);

$res = $mysqli->query($priceitem_sql);
  //echo '<p>'.$priceitem_sql;

if (!mysqli_connect_errno()) { 
	$Item = $res->fetch_array(MYSQLI_ASSOC);
} else exit();

//тут форимируется обновление для price:

if (isset($_POST['saveprice']) && $_POST['saveprice']=='true')
{
	$saveprice_sql=sprintf('UPDATE price SET name="%1$s", descript="%2$s", state = "%3$s", delivery = "%4$s", warranty = "%5$s",cost = %6$u, terms="%7$s" WHERE id=%8$u',
	$mysqli->real_escape_string($_POST['name']),//1
	$mysqli->real_escape_string($_POST['descript']),//2
	$mysqli->real_escape_string($_POST['state']),//3
	$mysqli->real_escape_string($_POST['delivery']),//4
	$mysqli->real_escape_string($_POST['warranty']),//5
	intval($mysqli->real_escape_string($_POST['cost'])),//6	
	$mysqli->real_escape_string($_POST['terms']),//7	
	intval($mysqli->real_escape_string($_POST['id'])));//8
	
	$mysqli->query($saveprice_sql);
	echo '<p><font color="green">Сохранено!</font>';
	//echo '<p>'.$saveprice_sql;
};

if (isset($_POST['deleteprice']) && $_POST['deleteprice'] == 'true') {
	$deleteprice_sql = sprintf( 'DELETE FROM price WHERE id = %1$u', intval( $mysqli->real_escape_string( $_POST['id'] )));
	$mysqli->query($deleteprice_sql);
	//echo '<p>'.$deleteprice_sql;
	header('Location: ./pricelist.php');
}

//Тут происходит вывод данных на страницу:
?>
<h4>Страница редактирования прайса:<h4><p><font color = "orange">Для услуг графа "Состояние" не заполняется!</font>
<table><form action="./editprice.php" method="post">
<tr><td></td><td><input name="id" type="hidden" id="id" value="<?php echo isset($_POST['id'])?$_POST['id']:$realkey;?>" ></input></td></tr>
<tr><td>Вид</td><td><input name="name" type="text" id="name" size="16" maxlenght="16" value="<?php echo isset($_POST['name'])?$_POST['name']:$Item['name'];?>" ></input></td></tr>
<tr><td>Описание</td><td><input name="descript" type="descript" id="addrw" size="99" maxlenght="99" value="<?php echo isset($_POST['descript'])?$_POST['descript']:$Item['descript'];?>" ></input></td></tr>
<tr><td>Состояние</td><td><input name="state" type="text" id="state" size="12" maxlenght="12" value="<?php echo isset($_POST['state'])?$_POST['state']:$Item['state'];?>" ></input></td></tr>
<tr><td>Доставка</td><td><input name="delivery" type="text" id="delivery" size="10" maxlenght="10" value="<?php echo isset($_POST['delivery'])?$_POST['delivery']:$Item['delivery'];?>" ></input></td></tr>
<tr><td>Гарантия</td><td><input name="warranty" type="text" id="warranty" size="6" maxlenght="6" value="<?php echo isset($_POST['warranty'])?$_POST['warranty']:$Item['warranty'];?>" ></input></td></tr>
<tr><td>Цена</td><td><input name="cost" type="text" id="cost" size="7" maxlenght="7" value="<?php echo isset($_POST['cost'])?$_POST['cost']:$Item['cost'];?>" ></input></td></tr>
<tr><td>Условия</td><td><input name="terms" type="text" id="terms" size="30" maxlenght="30" value="<?php echo isset($_POST['terms'])?$_POST['terms']:$Item['terms'];?>" ></input></td></tr>
<?php if (!isset($_POST['deleteprice'])) {
   echo '<tr><td><BUTTON name="saveprice" value="true" id="editprice" action="./editprice.php" autofocus>Сохранить!</BUTTON></td><td><BUTTON name="deleteprice" value="true" id="deleteprice" action="editprice.php">Удалить!</BUTTON></td></tr></form></table><p><a href="./pricelist.php?key='.$realkey;
   echo '">К списку</a></p>';
}
include('./set_foot.php');
?>
