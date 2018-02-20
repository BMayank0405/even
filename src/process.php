<?php
    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

$first_error = $last_error = $email_error = $pos_error = $file_error = $captcha_error = $form_error = '';
$first_name = $last_name = $email = '';

function sanitize($data)
{
    return htmlentities(strip_tags(trim($data)), ENT_QUOTES);
}

if (isset($_POST['submit'])) {
    // for first name
    if (!empty($_POST['first_name'])) {
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $first_name = sanitize($first_name);
        if (empty($first_name)) {
            $first_error = 'Enter correct first name';
        }
    } else {
        $first_error = 'First Name required';
    }

    // for last name
    if (!empty($_POST['last_name'])) {
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $last_name = sanitize($last_name);
        if (empty($last_name)) {
            $last_error = 'Enter correct last name';
        }
    } else {
        $last_error = 'Last Name required';
    }

    // validating email address
    if (!empty($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        } else {
            $email_error = 'Enter valid email';
        }
    } else {
        $email_error = 'EMail required';
    }

    // validating position
    if (!empty($_POST['position'])) {
        $position = filter_var($_POST['position'], FILTER_SANITIZE_STRING);
        $position = sanitize($position);
        if (empty($position)) {
            $pos_error = 'Enter correct Position';
        }
    } else {
        $pos_error = 'Position required';
    }

    // checking file upload
    if (isset($_FILES['resume']) && ($_FILES['resume']['error'] == 0)) {
        $file = $_FILES['resume'];
        $file_name = $file['name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $max_size = 104857600; // 5 * 1024 * 1024

        if ($file_size > $max_size) {
            $file_error = 'File size too large';
        } else {
            move_uploaded_file($_FILES['resume']['tmp_name'], 'upload/'.$_FILES['resume']['name']);
        }
    }

    // for validating recaptcha
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        if (!$captcha) {
            $captcha_error = 'Try to reload the captcha';
        } else {
            $secret = '6LefqTIUAAAAAJ-qa4SPXDZ4hoBNRpz0EB-e0rKp';
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha.'&remoteip='.$ip);
            $response_key = json_decode($response, true);
            if ($response_key['success'] === false) {
                $captcha_error = 'Please Try again';
            } elseif ($response_key['success'] === true) {
            }
        }
    }

    if (($first_error == '') || ($last_error == '') || ($email_error == '') || ($pos_error == '') || ($file_error == '') || ($captcha_error == '') || ($form_error == '')) {
        $mail = new PHPMailer();

        $mail->setFrom($email, $first_name.' '.$last_name);

        $mail->addAddress('contact@evencargo.in');

        $mail->Subject = 'Mail for Careers';
        $mail->Body = 'It is a mail from '.$first_name.' '.$last_name.' '.$email.' for career in Even Cargo';

        $mail->addAttachment("upload/$file_name");

        if ($mail->send()) {
        } else {
            echo $mail->ErrorInfo;
        }
    }
} else {
    $form_error = 'Form empty';
}
