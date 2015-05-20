<?php
	const EMAIL_DESTINATOR = 'paquitin08@gmail.com';
	const CONTROLLER_CONTACT = 'contact_form';

	$postRequest = $_POST;
	$errors = processRequest($postRequest);	

	function processRequest($request){
		$errors = array();
		$name = isset($request['name']) ? $request['name'] : false;
		$phone = isset($request['phone']) ? $request['phone'] : false;
		$email = isset($request['email']) ? $request['email'] : false;
		$message = isset($request['message']) ? $request['message'] : false;
		if(!$name or !$email)
			$errors[] = array("cause" => "Make sure you write your full name and your email!");
		if(!$message)
			$errors[] = array("cause" => "Make sure you write your message!");	
				
		if($errors){
			header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
			die(json_encode($errors));

		}		
		$mailText = "Hello\n
		A new contact message has been sent, these are the details:\n
		Name: $name\n
		Phone: $phone\n
		Email: $email\n
		Message: $message\n
		Mesage date: ".date("r")."\n
		IP Address: ".$_SERVER['REMOTE_ADDR']."\n
		************************************\n
		HAVE A NICE DAY.";
		mail(EMAIL_DESTINATOR, "New contact message", $mailText);
		
	}

?>