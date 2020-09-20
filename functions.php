<?php
	include 'my.php';
	function auth(){
		//header("AuthToken : wpjnd4uvoce1hy08b7aqtfzg3l5krmix962s");
		//vzis847hom5yw0qlg36afjntbuekpc21xr9d
		//print_r(getallheaders());
		//$authtoken  = 'jbraxzd3476k5pumielqs8gv1cw9h20ftony'; //authenticATION TOKEN ATTACHED FROM HEADERS

		if(isset(getallheaders()['AuthToken'])){
		$authtoken = getallheaders()['AuthToken'];
			
			if(strlen($authtoken)<10){
				say(403,"Invalid Authentication Token");
			}
			else {
				 	$sql = query("SELECT * FROM tokens WHERE token='$authtoken' ");
				 	$check = check($sql);
				 	if($check<1){
				 		say(205,"Invalid Authentication Token"); //returns to login
				 	}
	 	else {
	 		//echo $check;
	 		$row = fetch($sql);
	 		$userid = $row['issuedto'];
	 		$finduser = query("SELECT * FROM chronyusers WHERE userid='$userid' ");//verifies if user account still exists
	 		if(check($finduser)<1){
	 			say(205,'You need to login to authenticate');//userid is missing ,So we refer back to login;This is almost a near impossible case 
	 		}
	 		//tokens expires in 2 hours so hour-hour
	 		//02:53-07/09/2020
	 		//We check the exipry of the token 
	 		 $hournow = date('H');
	 		 $daynow = date('d')*1;
	 		 $date = $row['expiry'];
	 		 $hou = explode(':',$date);
	 		 $arr = explode('-', $date);
	 		 $sec = explode('/',$arr[1]);
	 		 $day = $sec[0];
	 		 if($day!=$daynow){
	 		 	say(205,'You need to login to authenticate: SESSION EXPIRED');
	 		 	exit();
	 		 }
	 		 $hour = $hou[0]*1;
	 		 $diff = abs($hournow-$hour);
	 		 if($diff>2){
	 		 	say(205,'You need to login to authenticate:Session  Expired');
	 		 	exit();
	 		 }
	 		 else {
	 		 	return $userid; //returns the userid of the user to the caller function
	 		 }

	 	}
			}
		}
		else {
			say(404,"Forbidden Request");
		}	
	}
	function checkup($e){
		if(empty($e)||$e==""){
			return false;
		}
		else {
			return true;
		}
	}
	function emailExists($email){
		//this function checks if an email address already exist in the database
		$sql = query("SELECT * FROM chronyusers WHERE useremail='$email' ");
		//return $email.check($sql);
		//exit();
		if(check($sql)<1){
			return false;
		}
		else {
			return true;
		}	
	}
	function validateInput($email){ //this functions validates email address
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return $email;
		}
		else {
			say(203,"Invalid Email Address");
		}
	} 
	//auth();
?>