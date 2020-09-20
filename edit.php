<?php

	include 'functions.php';//include global functions declared for easy and fast usage
	//this file is for changing usernames 
	//iT ACCEPT NEW USERNAME with the token attached in the header
	//the token is verified in the auth() function declared in function.php 
	// $dat = '{"username":"newusername"}';//sample of expected request body 
	$data = json_decode(file_get_contents('php://input')); ///Data sent from request body
	//$data = json_decode($dat); //decoding the string into JSON 
	if(auth()){
		$userid = auth(); //function auth() takes the header information and use the token to return the userid 
		if(checkup($data)){ //function checkup checks for empty strings
			$username = $data->username;
			if (!preg_match("/^[a-zA-Z ]*$/",$username)) { //check the username for non-alphabetic symbols

			  say(203,"Only letters  allowed in the username field"); //returns validation message 
			}
			else {
				$sql = query("UPDATE chronyusers SET username='$username' WHERE userid='$userid' ");
				if(!$sql){
					say(203,"Request Failed: ERR205");
				}
				else {
					say(200,"Username have been successfully changed");
				}
			}
		}
		else {
			say(203,"Empty Username Field");
		}
	}	


?>