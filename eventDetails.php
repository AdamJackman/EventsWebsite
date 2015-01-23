<?php

require("libs/config.php");

$res = $functions->getEventDetails($db, $_GET['actionID']);

echo json_encode($res);

?>