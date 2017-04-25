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
if (!isset($_SESSION['username'])) header('Location: ./logout.php');
?>
<h4>Планируемые отчёты:</h4>
<p>Прошлые заказы [за период]</p>
<p>Протокол заказов клиента</p>
<p>Доход за период</p>
<p>Доходность по клиентам(клиент-сумма)</p>
<p>Рейтинг Клиентов (топы доходности/убыточности)</p>
<p>Давние клиенты (звонили дольше чем [])</p>
<p>Изучение показателей: средний доход за обслуживание, показатели месяца,года</p>
<?php  include('./set_foot.php');