<?php

require "libs/Members.php";

Members::sec_session_start();
// Unset all session values
$_SESSION = array();
// get session parameters 
$params = session_get_cookie_params();
// Delete the actual cookie.
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// Session Seppuku
session_destroy();
redirect('login.html');

?>