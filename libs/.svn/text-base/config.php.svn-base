<?php
	require("libs/Members.php"); 	//Gets session function

	$db = new Database();			//Generates new instance of database
	$functions = new Functions();
	Members::sec_session_start();			//Starting session for this landing page

	//if memberID session has not been set yet, set it
	if(!isset($_SESSION['memberID'])) {
		$functions->getSessionID($db, $_SESSION['user_profile']['email']);
	}

	if(!Members::login_check($db)) {
		redirect('login.html');
	}
?>