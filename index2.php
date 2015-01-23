<?php
	require ("libs/config.php");
	$_SESSION["memberID"]=48;
	$functions = new Functions();

/*	$query = "SELECT * FROM TestTable";
	$res = $functions->getUsers($db, $query);
	pr($res);

*/
	function populateTest($db){
		$functions = new Functions();

		$email="Zubair@test";
		$identity="darren";
		$age=20;
		$gender="male";
		$occupation="student";
		$isOrganiser=true;
		$eventName="the test";
		$tagName="DC";
		$expertise="Nothing, Nothing at all.";
		$today = date("2012-m-d");

		/*
		$functions->addMember($db,"Zubair@test","Zubair",89,"male","student");
		$functions->addMember($db,"Sam@test","Sam",4,"male?","student");
		$functions->addMember($db,"Darren@test","Darren",20,"male","student");
		$functions->addMember($db,"Adam@test","Adam",21,"male","student");
		*/

		$_SESSION["memberID"]=48;
		$functions->addExpertise($db,$expertise);
		
		$_SESSION["memberID"]=49;
		$functions->addExpertise($db,$expertise);
		$_SESSION["memberID"]=50;
		$functions->addExpertise($db,$expertise);
		$_SESSION["memberID"]=51;
		$functions->addExpertise($db,$expertise);

		
		$functions->addEvent($db, "party", '2012-02-1', '2013-07-9', "I finally get to leave school","Windsor,Ontario", "None");
		$_SESSION["memberID"]=49;
		$functions->addEvent($db, "Studying", '2014-03-03', '2014-05-23', "Have to stay up till 4am every single night to do 309 project","Anywhere and everywhere", "None");

		$functions->addTag($db,"party","no school");		
		$functions->addTag($db,"party","fun");
		$functions->addTag($db,"Studying","4.0");
		$functions->addTag($db,"Studying","Straight A's here we come");

		$_SESSION["memberID"]=48;
		$functions->addParticipant($db,"party",false);
		$_SESSION["memberID"]=49;
		$functions->addParticipant($db,"party",false);
		$_SESSION["memberID"]=50;
		$functions->addParticipant($db,"party",false);
		$_SESSION["memberID"]=51;
		$functions->addParticipant($db,"party",false);
		
		$_SESSION["memberID"]=48;
		$functions->addParticipant($db,"Studying",false);
		$_SESSION["memberID"]=49;
		$functions->addParticipant($db,"Studying",true);
		$_SESSION["memberID"]=50;
		$functions->addParticipant($db,"Studying",false);
		$_SESSION["memberID"]=51;
		$functions->addParticipant($db,"Studying",false);
		





	
	}


	//populateTest($db);




	$email="Zubair@test";
	$identity="darren";
	$age=20;
	$gender="male";
	$occupation="student";
	$isOrganiser=true;
	$eventName="the test";
	$tagName="DC";
	$expertise="Nothing, Nothing at all.";
	$today = date("2012-m-d");
	//$functions->addEvent($db, "Staying Up Late", '2014-03-03', '2013-03-13', "Have to stay up till 4am every single night to do 309 project","Anywhere and everywhere", "None");

	$res2 = $functions->membersNeeded($db, "party");
	pr($res2);

	//	$functions->addFriend($db, "Adam@test");

	/*$res2 = $functions->buildUserMatrix($db);
	pr("hello");
	pr($res2);
	$res3 = $functions->calculateSimilarities($db,$res2);
	pr($res3);*/
	//$res2 = $functions->occupiedDate($db,'2014-03-03');
	//pr($res2);

	//$functions->removeEvent($db, "Studying");
	//$functions->removeEvent($db, "party");
	//$functions->addRating($db,49, 5,"I like");
	//$functions->addMember($db,$email,$identity,$age,$gender,$occupation);

	//$res2 = $functions->addParticipant($db,"Staying Up Late",$isOrganiser);
	//pr($res2);

	//$res2 = $functions->removeParticipantUser($db,$eventName);
	//pr($res2);

	//$res2 = $functions->addEvent($db, "ma ma i'm coming home", "After last exam", "end of summer break", "I finally get to leave school","Windsor,Ontario", "None");
//	$res2 = $functions->mostRecent($db, 2);

//	pr($res2);

	//$res2 = $functions->removeExpertise($db);
	//pr($res2);
/*

	$query = "SELECT * FROM TestTable";
	$res = $functions->getUsers($db, $query);
	pr($res);
*/

	

	/*
	$res2=$functions->getSessionID($db,$email);
	pr($res2);

	$res3=$functions->memberExists($db,$email);
	pr($res3);
	*/
	/*
	echo "session"; 
	pr($_SESSION);
	*//*
	String query = "INSERT INTO memberProfile(email,identity,age,gender,occupation) VALUES(?,?,?,?,?);";
			
			PreparedStatement ps=con.prepareStatement(query);
			ps.setString(1, email);
			ps.setString(2, identity);
			ps.setInt(3, age);
			ps.setString(4, gender);
			ps.setString(5, occupation);
			
			ps.executeUpdate();
			ps.close();

			ResultSet rs;
			String output = null;
			query = "SELECT memberID FROM memberProfile WHERE email='"+email+"';";
			ps = con.prepareStatement(query);
			rs = ps.executeQuery();
			while (rs.next()){
				output = rs.getString("memberID");
			}
			rs.close();
			return output;
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
            System.err.println("SQLException: " + e.getMessage());
            
		}
		return "error";*/
?>