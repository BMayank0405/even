<?php 
$errors = [];//empty array for errors

function sanitize(string $data) {
	return htmlentities(strip_tags(trim($data)),ENT_QUOTES);
}


if(isset($_POST['submit'])){

	// for first name
	if(!empty($_POST['first_name'])){
		$first_name =  filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
		$first_name =  sanitize($first_name);
		if(empty($first_name)){
			$errors = 'Enter correct first name';
		}
	}
	else {
		$errors = 'First Name required';
	}

	// for last name
	if(!empty($_POST['last_name'])){
		$last_name = filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
		$last_name =  sanitize($last_name);
		if(empty($last_name)){
			$errors = 'Enter correct last name';
		}
	}
	else{
		$errors = 'Last Name required';
	}

	// validating email address
	if(!empty($_POST['email'])){
		$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){

		}
		else {
			$errors = 'Enter valid email';
		}
	}
	else {
		$errors = 'EMail required';
	}

	// validating position
	if(!empty($_POST['position'])){
		$position = filter_var($_POST['position'],FILTER_SANITIZE_STRING);
		$position = sanitize($position);
		if(empty($position)){
			$errors = 'Enter correct Position';
		}
	}
	else {
		$errors = 'Position required';
	}

	// checking file upload
	if(isset($_FILES["resume"]) && ($_FILES["resume"]["errors"] == 0) ){
		$file = $_FILES["resume"];
		$path  = "uploads/";
		$file_name = $file["name"] ;
		$file_type = $file["type"];
		$file_size = $file["size"];
		$extension =  pathinfo($file_name,PATHINFO_EXTENSION);
		$max_size = 5242880; // 5 * 1024 * 1024 

		if($file_size > $max_size){
			$errors = 'File size too large'; 	
		}
		else {
			move_uploaded_file($_FILES["resume"]["temp"] , "uploads/".$_FILES["resume"]["name"])
		}
	}

	// for validating recaptcha 
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
		if(!$captcha){
			$errors = 'Try to reload the captcha';
		}
		else {
			$secret = "6LefqTIUAAAAAJ-qa4SPXDZ4hoBNRpz0EB-e0rKp";
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $ip);
			$response_key = json_decode($response, true);
			if($response_key["success"] === false){
				$errors = 'Please Try again';
			}
			else if($response_key["success"] === true){

			}
		}
	}
}
else {
	$errors = 'Form empty';
}
if(empty($errors)) {
	require_once "./vendor/autoload.php";

	$mail = new PHPMailer;

	$mail->From = $email;
	$mail->FromName = $first_name . ' ' . $last_name;	

	$mail->addAddress ('mayankadv1@gmail.com','Mayank');

	$mail->subject = 'New Email for carrer';

	//$mail->addAttachements("")


		if($mail->send()){
			echo 'successful';
		}
		else {
			echo $mail->ErrorInfo;
		}
	}
		else {
			echo 'errors';
		}
	?>