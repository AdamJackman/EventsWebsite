<?php
//already includes functions inside database
require('database.php');
require_once('libs/PasswordHash.php');

class Members {

  	function sec_session_start() {
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 

        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.     
    }

  	function login($username, $user_password, $db) {
        // Using prepared Statements means that SQL injection is not possible.

        $db->query("SELECT * FROM units WHERE username = ? LIMIT 1");
        $db->bind(1, $username); // Bind "$username" to parameter.
        $res = $db->fetchOne(); // Execute the prepared query.

        //if there was a result
        if($res) {
            //assign db info to variables
            $user_id        =   $res['id'];
            $unitID         =   $res['unitID'];
            $username       =   $res['username'];
            $db_password    =   $res['password'];
            $element        =   $res['element'];
            $unitName           =   $res['name'];

            if($db->rowCount() == 1) { // If one user was found
                // We check if the account is locked from too many login attempts
                if(self::checkbrute($user_id, $db) == true) { 
                    // Account is locked
                    // Send an email to user saying their account is locked
                    echo "too many log in attempts";
                    exit();
                    return false;
                } else {
                    // Initialize the hasher without portable hashes (this is more secure)
                    $hasher = new PasswordHash(8, false);
                    // Check if a user has provided the correct password by comparing what they typed with our hash
                    $confirmPass = $hasher->CheckPassword($user_password, $db_password); // false

                    if($confirmPass) { // Check if the password in the database matches the password the user submitted. 
                        // Password is correct!
                        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

                        $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
                        $_SESSION['user_id']        = $user_id;
                        $_SESSION['unitID']         = $unitID;
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
                        $_SESSION['username']       = $username;
                        $_SESSION['login_string']   = hash('sha512', $db_password.$user_browser);
                        $_SESSION['element']        = $element;
                        $_SESSION['unitName']       = $unitName;
                        // Login successful.
                        return true;    
                    } else {
                        // Password is not correct
                        // We record this attempt in the database
                        $now = time();
                        $db->query("INSERT INTO login_attempts (id, time) VALUES (?, ?)");
                        $db->bind(1, $user_id);
                        $db->bind(2, $now);
                        $db->execute();
                        return false;
                    }
                }
            } else {
            // No user exists. 
            return false;
            }
        }
    }

    function checkbrute($user_id, $db) {
        // Get timestamp of current time
        $now = time();
        // All login attempts are counted from the past 2 hours. 
        $valid_attempts = $now - (2 * 60 * 60); 

        //get all login attempts with the past 2 hours
        $db->query("SELECT time FROM login_attempts WHERE id = ? AND time > ?");
        $db->bind(1, $user_id); 
        $db->bind(2, $valid_attempts);

        $db->execute();

        // If there has been more than 5 failed logins
        if($db->rowCount() > 5) {
            return true;
        } else {
            return false;
        }
    }

    function login_check($db) {
        // Check if all session variables are set
        if(isset($_SESSION['user_profile'], $_SESSION['memberID'], $_SESSION['login_string'])) {
            $memberID        = $_SESSION['memberID'];
            $login_string   = $_SESSION['login_string'];

            $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

            $res = Functions::memberExists($db, $_SESSION['user_profile']['email']);

            if(!empty($res)) { // If the user exists
                $login_check = hash('sha512', "google".$user_browser);
                if($login_check == $login_string) {
                    // Logged In!!!!
                    //echo 'login valid';
                    return true;
                } else {
                    // Not logged in
                    echo "login string does not match";
                    return false;
                }
            } else {
                // Not logged in
                redirect('createProfile.php');
                //return true;
            }
        } else {
        // Not logged in
        return false;
    }
}
	
}

?>