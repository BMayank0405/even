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

?>
<!DOCTYPE html>
<html lang="en" style="font-family: sans-serif;">

<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109029601-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109029601-1');
</script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" /> 
	<meta name="description" content="At Even we strongly " />

	<!-- open graph -->
	<meta property="og:image" content="logo.png" />
	<meta property="og:title" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="EvenCargo" />


	<meta property="twitter:title" content="Women First Parcel Delivery Service Aiming to Attain Gender Parity | Even Cargo" />
	<meta property="twitter:card" content="" />
	<meta property="twitter:description" content="Women First Parcel Delivery Service Aiming to Attain Gender Parity" />
	<meta property="twitter:image:src" content="logo.png" />


	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" type="image/png" href="favicon-72x72.png" sizes="72x72">
	<link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon.png">

	<title>Life | Career At Even</title>
	<link rel="preconnect" href='https://evencargo.in'>
	<link rel='dns-prefetch' href='https://fonts.google.com/'>

	<!-- preloaded content  -->
<!-- 	<link rel="preload" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700i|Raleway:300,400&amp;subset=latin-ext" as="font" crossorigin="crossorigin" /> -->

	<link rel="preload" as="style" href="./css/common.css">
	<link href="./css/carrer.css" rel="preload" as="style" />



	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="./css/common.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="./css/carrer.css" type="text/css" rel="stylesheet" media="screen,projection" />

	
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Raleway:300,400&amp;subset=latin-ext" rel="stylesheet">

	<script type="text/javascript">
	      var onloadCallback = function() {
	        grecaptcha.render('recaptcha-1', {
	          'sitekey' : '6LefqTIUAAAAAOG-_A2JjoX7ynJJTln-4NSqafgU',
	          'type':'image'
	        });
	        grecaptcha.render('recaptcha-2', {
	          'sitekey' : '6LefqTIUAAAAAOG-_A2JjoX7ynJJTln-4NSqafgU',
	          'type':'image'
	        });
	        grecaptcha.render('recaptcha-3', {
	          'sitekey' : '6LefqTIUAAAAAOG-_A2JjoX7ynJJTln-4NSqafgU',
	          'type':'image'
	        });
	      };
	</script>

</head>

<body>

	<section class="first-sight z-depth-5">
		<!-- backgorund -->
		<article class="background-slider">
			<img src="./img/hire/mainhire.jpg" alt="">
		</article>
		
		<?php 
        require_once './navbar.php';
        ?>
		
		<!-- heading -->
		<header class="main-heading">
         <h1>Create Equity For All.</h1>
      </header>

	</section>

  <!-- main content -->
  <main>
		
		<!--open post -->
		<section class="open-post">
			<header class="heading" style="align-self:flex-start;">
			  <h2>Working Here At Even</h2>
			</header>
			<p class="text"> We are currently hiring for two roles: <span>Marketing Intern</span> and <span>Research Associate</span> </p>
			<article class="posts">
				
				<div class="post-1">
					
					<div class="post-heading">
						<h3>Marketing Intern</h3>
					</div>

					<img src="./img/hire/mkt.jpg" class="responsive-img z-depth-5" alt="">
					<p>We are looking for an amazing, data-driven inbound marketer to own most of the marketing funnel for our company. As a marketing Intern, you will work to create scalable processes that ensure best practices in lead generation and database management. You will be managing our social media accounts by implementing strategies and tactics that grow our followers, engage and retain them, and help convert them into leads, customers, and active fans and promoters of our company. 
					</p>
				</div>

				<div class="post-2">
					
					<div class="post-heading">
						<h3>Research Associate</h3>
					</div>

					<img src="./img/hire/research.jpg" class="responsive-img z-depth-5" alt="">
					<p>The Research Associate will be responsible for the management and coordination of internal and external research work and projects across Even Cargo and for giving specialist guidance and advice to the business. S/he should be organized, analytical, results-driven and the type of person who thrives in a fast-paced environment. The job holder will collate and analyse data and provide evidence based recommendations which will be used to contribute to the delivery of our strategic goals.</p>					
				
				</div>

			</article>
			
         <button class="btn waves-effect waves-light submit-btn"  name="action">Apply Here
		   	<i class="material-icons right">launch</i>
		   </button>
		</section>

		<!-- together at even -->
		<section class="together">
			<div class="heading">
        		<h2>Together At Even</h2>
      	</div>
			<p class="text">With a passionate belief in equality for the genders, <span>EvenCargo</span>  works to
				bring this equality in practice, moving the discussion from the tables, bringing it to the field. </p>
			<article class="img-container">
				<img src="img/1.jpg" alt="" class="img-1 responsive-img" alt="">
				<img src="img/htcrop.jpg" alt="" class="img-2 responsive-img" alt="">
				<img src="img/3.jpg" alt="" class="img-3 responsive-img" alt="">
			</article>			
		</section>

  		<!-- form content -->
		<section class="carrer container">
			<div class="heading">
			  <h2>Carrers With Us</h2>
			</div>
			<nav class="transparent" id="formnav">
				<div class="nav-wrapper">
					<ul id="nav-mobile">
					  <li>
					  	<div class="carrersLinks activeLinks">Rider</div>
					  </li>
					  <li>
					  	<div class="carrersLinks">Staff</div>
					  </li>
					  <li>
					  	<div class="carrersLinks">Intern</div>
					  </li>
					</ul>
				</div>
		   </nav>
	
			<!-- sections to be hidden -->
			<section class="form-content active-field container">
				<?php 
                 require './form_temp.php';
                ?>
				<div id="recaptcha-1"></div>
			   <button class="btn waves-effect waves-light submit-btn modal-trigger" type="submit" name="submit" data-target="modal4" >	Submit
					<i class="material-icons right">send</i>
				</button>
				</form>
			</section>
			
			<!-- section to be hidden -->
			<section class="form-content container">
				<?php 
                 require './form_temp.php';
                ?>
			   <div id="recaptcha-2"></div>
			   <button class="btn waves-effect waves-light submit-btn modal-trigger" type="submit" name="submit" data-target="modal4">	Submit
					<i class="material-icons right">send</i>
				</button>
				</form>
			</section>

			<section class="form-content container">
				<?php 
                 require './form_temp.php';
                ?>
				<div id="recaptcha-3"></div>
				<button class="btn waves-effect waves-light submit-btn modal-trigger" type="submit" name="submit" data-target="modal4">	Submit
					<i class="material-icons right">send</i>
				</button>
				</form>
			</section>
		</section>



		<section class="faq">
			<div class="heading">
        		<h2>Frequently Asked Questions</h2>
      	</div>
			<div class="container">
		      <div class="row col s12">
		        <div class="col l6 s12">
		          <ul class="collapsible popout" data-collapsible="accordion">
		            <li style="margin-bottom:10px;" class="z-depth-1">
		              <div class="collapsible-header"> <i class="material-icons">question_answer</i>What is the profile of candidates we look for?</div>
		              <div class="collapsible-body">
		                <span>We are looking for someone who has good talent and provides competitive advantage. We emphasize on recruiting the right talent. We look for someone who is a: <br>
		                  1.) Team player <br>
		                  2.) Has entrepreneurial spirit <br>
		                  3.) Managerial/leadership competencies <br>
		                  We want someone who is self-motivated and has passion for excellence. We appreciate people with strong business knowledge and takes initiative to achieve results.
		                </span>
		              </div>
		            </li>

		            <li style="margin-bottom:10px;" class="z-depth-1">
		              <div class="collapsible-header"> <i class="material-icons">question_answer</i>
		                Why should I work at Even Cargo?
		              </div>
		              <div class="collapsible-body"><span class="address_adjust">In Even cargo we are providing employment to the marginalized women of the society. We provide them training and employing them as goods delivery personnel, that is, they have to deliver products within Delhi.</span></div>
		            </li>

		          </ul>

		        </div>

		        <div class="col l6 s12">

		          <ul class="collapsible popout" data-collapsible="accordion">
		            <li style="margin-bottom:10px;" class="z-depth-1">
		              <div class="collapsible-header"> <i class="material-icons">question_answer</i>How do careers at Even Cargo advance?</div>
		              <div class="collapsible-body">
		                <span>
		                  There is no limit or obstacle to the growth. Depending on the potential, and who exhibits performance can grow in the organization through the following paths: <br>
		                  1.) Lateral Growth:- Cross-functional assignments within the department or within various business verticals. <br>
		                  2.) Vertical Growth:- Career promotion and higher levels of responsibility in the same function
		              </span>
		            </div>
		            </li>

		            <li style="margin-bottom:10px;" class="z-depth-1">
		              <div class="collapsible-header"> <i class="material-icons">question_answer</i>What makes Even Cargo different from other logistics solution companies?</div>
		              <div class="collapsible-body">
		                <span>Even Cargo is a social enterprise that aims to be a leading logistics service provider driven by a confident team of female delivery personnel at its forefront. Our social vision is to work towards attaining gender parity through the empowerment of women by engaging them in professions traditionally inaccessible to them.</span>
		              </div>
		            </li>
		          </ul>

		        </div>

		      </div>
		    </div>
		</section>
  </main>

	<?php 
    require_once './footer.php';
    ?>	
  
  <!--  Scripts-->
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
  <script src="js/init.js"></script>
</body>
</html>  
