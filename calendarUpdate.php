<?php

require("libs/config.php");
require("includes/calendar.php");

$cal = new Calendar($db, $functions, $_GET['month'], $_GET['year']);
$res = $cal->generateCalendar();

echo $res;


?>