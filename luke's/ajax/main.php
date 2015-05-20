<?php
	const EMAIL_DESTINATOR = 'paquitin08@gmail.com';
	const CONTROLLER_FREE_CONSULTATION = 'free-consultation';
	const CONTROLLER_CREDIT_CONSULTATION = 'credit-consultation';
	const CONTROLLER_DEBT_CONSULTATION = 'debt-consultation';
	const CONTROLLER_BANKRUPCY_CONSULTATION = 'bankruptcy-consultation';

	$postRequest = $_POST;
	$errors = processRequest($postRequest);
	$phone;$option;
	

	function processRequest($request){
		$errors = array();
		$controller = isset($request['controller']) ? $request['controller'] : false;
		if(!$controller)
			$errors[] = array("cause" => "Bad request!");
		$name = isset($request['name']) ? $request['name'] : false;
		$phone = isset($request['phone']) ? $request['phone'] : false;
		if(!$name or !$phone)
			$errors[] = array("cause" => "Make sure you write your full name and your phone!");
		$option = isset($request['option']) ? $request['option'] : false;
		if(!$option)
			$errors[] = array("cause" => "Make sure you select a valid option for your consultation!");	

		if($errors){
			header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
			die(json_encode($errors));
		}

		$consultationForm = "";
		$optionLabel = "Consultation option";
		switch ($controller) {
			case CONTROLLER_FREE_CONSULTATION:
				$consultationForm= "Free consultation";
				break;
			case CONTROLLER_CREDIT_CONSULTATION:
				$consultationForm= "Credit consultation";
				$optionLabel="Best time to reach (PST)";
				break;
			case CONTROLLER_DEBT_CONSULTATION:
				$consultationForm= "Free Debt Consultation";
				$optionLabel="Debt amount";
				break;
			case CONTROLLER_BANKRUPCY_CONSULTATION:
				$consultationForm= "Bankruptcy consultation";
				$optionLabel="Best time to reach (PST)";
				break;			
			default:
				# code...
				break;
		}
		$mailText = "Hello\n
		A new consultation has been processed, here are the details:\n
		Form: $consultationForm\n
		Name: $name\n
		Phone: $phone\n
		$optionLabel: $option\n
		Consultation date: ".date("r")."\n
		IP Address: ".$_SERVER['REMOTE_ADDR']."\n
		--------------------------------------\n
		HAVE A NICE DAY.";
		
		mail(EMAIL_DESTINATOR, "New $consultationForm", $mailText);
	}

?>