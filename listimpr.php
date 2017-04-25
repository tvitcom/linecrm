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

?>
<?php //------------Для какого контакта выводится история:------------------------------------------?>

<p>
    Багтрек лист. Вы также можете: создать<a href="addimpr.php">новую</a> запись в "TO-DO"
ознакомится с <a href = "/editfile.php">README</a>
 Запуск процесса <a href="/reconstruct.php">ETL</a>
</p>

<?php //----------------Формируем сам запрос для вывода TO-DO:--------------------------------------

    $improvelist_sql = ""
        . "SELECT `id`, `todo`, `when`, `fix`, `fixdate`, `rev`, `developerid` "
        . "FROM `impr` "
        . "WHERE `fix` <> 1 AND `rev` <> '' "
        . "ORDER BY `fixdate` ASC"
        . "";
?>

<!--p>SQL: <?php echo $improvelist_sql;?></p-->

<?php if ( $res = $mysqli->query($improvelist_sql)) { ?>

<?php //----------------- Выводим строки TO-DO  запроса: --------------------------------------------------------?>

<?php if ($res->num_rows) { ?>
	<table>
	<th>###</th>
    <th>Запланировано:</th>
    <th>На когда:</th>
    <th>Версия:</th>


	<?php while ($impritem = $res->fetch_assoc()) { ?>
		
		<tr>
		<td>
            <a href='/editimpr.php?id=<?php echo $impritem['id']?>'><?php echo $impritem['id'];?></a></td>
		<td>
		<?php if (($impritem['fixdate'] < date('Y-m-d')) 
                && ($impritem['fixdate']<>'0000-00-00')) { ?> 
			
			<font color="red">Просрочено:</font>
	   
        <?php } ?>
	   
		<?php if ($impritem['fixdate']==='0000-00-00') { ?>
		    <font color='blue'>
                <?php echo $impritem['todo'] ?>
            </font>
        <?php } else { ?> 
		    <?php echo $impritem['todo'] ?>
        </td>
        <?php } ?>
		    
		<td>
        <?php if ($impritem['fixdate']=='0000-00-00') { ?>
		   <font color='blue'>
                <?php echo $impritem['fixdate']?>
            </font> 
        <?php } else { ?>
		    <?php echo $impritem['fixdate'] ?> 
        <?php } ?>
        </td>
        <td>
            <?php echo $impritem['rev']; ?>
        </td>
        </tr>
	   
	<?php } ?>

	</table>
  <?php  } ?>

<?php } else { ?>
    <p>
        <font color="red">Запрос не выполнен!!!</font>
    </p>
<?php } ?>
<?php $res->free(); ?>
 <p><a href="settings.php">Назад</a></p>

<?php 
//----------------Формируем сам запрос для вывода BUG:---------------------------------------------

$buglist_sql = "
            SELECT `id`, `todo`, `when`, `fix` 
            FROM `impr` 
            WHERE `rev` = '' AND `fix` = 0 
            ORDER BY `when` DESC
            ";
?>
<?php  //echo "<p>SQL: ".$buglist_sql; ?>

<?php if ( $res = $mysqli->query($buglist_sql)) { ?>

<?php //----------------- Выводим строки TO-DO  запроса: --------------------------------------------------?>

    <?php if ($res->num_rows) { ?>
        <hr>
        <p><h4><font color="red">Зарегистрированые ошибки:</font></h4></p>';
        <table>
        <th>Время:</th>
        <th>Описание ошибки:</th>

        <?php while ($bugitem = $res->fetch_assoc()) { ?>

            <tr bgcolor="yellow">
            <td>
                <a href="/editimpr.php?id=<?php echo $bugitem['id']?>">
                    <?php echo $bugitem['when']?>
                </a>
            </td>
            <td><?php $bugitem['todo']?></td>
            </tr>

        <?php } ?>

        </table>
    <?php } ?>

<?php } else { ?> 
    <p><font color="red">Запрос не выполнен!!!</font></p>
<?php } ?>

<?php include('set_foot.php');