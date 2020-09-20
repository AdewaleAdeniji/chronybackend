<?php
	 include 'functions.php';

	 	//$dat = '{"email":"email@dev.com","password":"password"}';		sample data 
		$data = json_decode(file_get_contents('php://input')); ///Data sent from request body
		//$data = json_decode($dat); //decoding the string into JSON 

		if(checkup($data)){ //
			$email = parse($data->email);
			$password = parse($data->password);
			$arr = [$email,$password];
		//validates the request body for empty strings 
		$labels = ['Email Address','Password']; //labels for inputs
		for($i=0;$i<count($arr);$i++){
			if(empty($arr[$i])){
				$validationMessage = $labels[$i]." is empty";
				say(203,$validationMessage); //returns if an input is empty
			}

		}
		$email = validateInput($email);
		if(emailExists($email)){
			$sql = query("SELECT * FROM chronyusers WHERE useremail='$email' ");
			$row = fetch($sql);
			$userpassword = $row['userpassword'];
			if(password_verify($password,$userpassword)){ //verify the passsword against the hashed password 
				$token = gen(); // generate token
				if($row['status']=='0'){
					say(207,"Please Verify your email address,If you do not get a mail,then you can request for a new mail");
				}
				else {
					$userid = $row['userid'];
					$r = now();
					$u = query("DELETE FROM tokens WHERE issuedto='$userid' "); //delete all previous tokens
					$newsql = query("INSERT INTO tokens(token,issuedto,expiry) VALUES('$token','$userid','$r')");//then insert a new one 


					say(200,$token);//return token to be cached and used for authentication
				}
			}	
			else {
				say(203,"Incorrect Email Address or Password");
			}
		}
		else {
			say(203,"Incorrect Email or Password");
		}

		}
		else {
			say(403,"Empty request Body epa");
		}


?>