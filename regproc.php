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
header('Location:reconstruct.php');

/*Если послан POST то:
0)Чистим присланные данные
1)проверим все данные на валидность требованиям иначе послать на логин-форму ошибку
2)посылаем подтверждение на мыло и отображаем страницу баннер регистрации.
3)Если прислан Get то значит пользователь подтверждает свой email
4)вносим подтверждение в базу и переадресовываем его на страницу входа для логина и пароля.
*/

//------------Здесь описываются необходимые функции и инициализации.------------------
$errUserfields = '';

function IsValidRegInfo($_POST) {
 //проверим почту:
	$regex = "/[a-z0-9-_]{2,64}\@[a-z0-9\-\_]{2,64}\.[a-z0-9]{2,6}/i";
	$foundgup = strpos( $_POST['mail'], ' '); //Попытка найти пробелы (хотя RFC'ы допускают пробелы в кавычках)

	if (!$foundgup && (preg_match($regex, $_POST['mail']))) {
		//echo "e-mail is correct!";
		//return TRUE;
	} else { 
		//echo '<font color="red">e-mail incorrect!</font> ';
		//return FALSE; 
		$errUserFields .= $errUserFields;
	}
}

//---------- Здесь реализуется логика скрипта:-----------------

if ( count($_POST)) {
	if (IsValidRegInfo($_POST)) { //проверка что присланные данные годны для работы сайта
		if ( mail($umail, $utheme, $utext)) {
			SetMailRequest($_POST); //В функции происходит установка значений в бд по зарегистрированному пользователю
			$str = "/regbanner.php?n=" . $_POST['name'] . "&m=" . $_POST['mail']; 
			Header("Location:$Str"); //Выход из скрипта и перенаправление на страницу баннер.
		}

	}
	else { //Описываем что произойдет если присланные данные не годны к работе.
		$str = "registartion.php?err=".$errUserfields;
		Header("Location:$Str");
	}
}
