<?php
	include 'functions.php';
	//this function returns profile information 
	//the token is verified in the auth() function declared in function.php 
	if(auth()){
		$userid = auth();
		$sql = query("SELECT useremail,username FROM chronyusers WHERE userid='$userid'  ");
		$row = fetch($sql);//fetch result row with fetch() function declared in my.php
		say(200,$row);
	}
?>