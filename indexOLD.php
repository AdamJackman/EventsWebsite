<?php
	require ("libs/config.php");
	$_SESSION["memberID"]=51;


	$functions = new Functions();

	$email="adam@test.com";
	$identity="adam";
	$age=21;
	$gender="male";
	$occupation="student";
	$isOrganiser="false";
	$eventName="Studying";
	$tag = "fun";
	$memberID = 51;
	
	// ----- END OF SET UP ------//
	//------ TESTING CASES ------//
	

	// pr("ALL Events");
	// $res = $functions->showAllEvents($db);
	// pr($res);

	// pr("Search My Events");
	// $res2 = $functions->searchMyEvents($db, $eventName);
	// pr($res2);

	// pr("My Events");
	// $res3 = $functions->myEvents($db, $email);
	// pr($res3);

	// pr("Search");
	// $res4 = $functions->search($db, $tag);
	// pr($res4);

	// pr("Show Ratings");
	// $res5 = $functions->showRatings($db);
	// pr($res5);

	// pr("Show the member");
	// $res6 = $functions->showMyMember($db);
	// pr($res6);

	// pr("Show action Details");
	// $res7 = $functions->showActionDetails($db, $eventName);
	// pr($res7);

	// pr("Show a User Profile");
	// $res8 = $functions->showProfile($db, $memberID);
	// pr($res8);

	// pr("Average the Ratings");
	// $res9 = $functions->averageRating($db, $memberID);
	// pr($res9);

	// pr("Total the Ratings");
	// $res10 = $functions->totalRating($db, $memberID);
	// pr($res10);

	// pr("Show the minAttend");
	// $res11 = $functions->showMinAttend($db, $eventName);
	// pr($res11);

	// pr("show the friends listing");
	// $res12 = $functions->getFriendsWithInfo($db, $memberID);
	// pr($res12);

	pr("show the friends listing");
	$res12 = $functions->getUpcomingForFriends($db, $memberID);
	pr($res12);

	//------ END TEST CASES -----//
	/*
	$email = "test";

	$db->query("SELECT * FROM users WHERE email = ? LIMIT 1");
	$db->bind(1, $email); // Bind "$username" to parameter.
	$res = $db->fetchOne(); // Execute the prepared query.

	pr($res);

	$db->query("SELECT * FROM users");
	$res = $db->fetchAll(); // Execute the prepared query.

	pr($res);

		echo "<table>";

	foreach ($res as $key => $value) {
		echo "<tr>";
		echo "<td>" . $value["eventname"] . "</td>";
		echo "<td>" . $value["description"] . "</td>";
		echo "</tr>";
	}

	echo "</table>";

	*/
?>