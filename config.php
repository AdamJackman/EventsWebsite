<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$host_name = substr($_SERVER['PHP_SELF'], 1); //gets current url
$pos = strchr($host_name, '/', true); //finds last instance of '/'
$length = strlen($pos); //length of string
$devName = substr($host_name, 0, $length); //removes '/' and gets filename

$googleData = array(
	"sam"		=> array(
		"id"		=> "232648931334.apps.googleusercontent.com",
		"secret"	=> "bSzABNN6m-e3wF7vYrVmy_y5"
	),

	"zubair"	=> array(
		"id"		=> "232648931334-n9avqhts887g5rlfd258pnvbrnjoouha.apps.googleusercontent.com",
		"secret"	=> "5cZyyJ-miAYEEcFXcZYdfkYD"
	),

	"darren"	=> array(
		"id"		=> "232648931334-8pcqpe83k2o5rrkplhr339poulvf37h6.apps.googleusercontent.com",
		"secret"	=> "NhL7YjwHl6zYKbAQ-x0FaQ3m"
	),

	"adam"		=> array(
		"id"		=> "232648931334-of312r42p65e999esoiokct7ocn8218o.apps.googleusercontent.com",
		"secret"	=> "77scJdyMxijFWa9MlqC1OEWH"
	)
);

$id 	= $googleData[$devName]["id"];
$secret = $googleData[$devName]["secret"];

$base_url = "http://localhost/" . $devName . "/csc309project/hybridauth/index.php";

$config =array(
		"base_url" => $base_url, 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => $id, "secret" => $secret ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "XXXXXXXXX", "secret" => "XXXXXXXX" ), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "XXXXXXXX", "secret" => "XXXXXXX" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);
