<?php

/** Exemple of a form sent to the same url */
// Error messages
$messages = array();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    display_form();
    break;
  case "POST":
    do_post();
    break;
  default:
    die("Not implemented");
}

function display_form() {
  
  // Print the form
  print <<<END_FORM
  <html>

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form flex-sb flex-w" action = "" method = "POST">
                    <span class="login100-form-title">
						Register
					</span>

                    <div class="username">
                        <span class="txt1">
							Firstname
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Firstname is required">
                        <input class="input100" type="text" name="firstname">
                        <span class="focus-input100"></span>
                    </div>
					
					<div class="username">
                        <span class="txt1">
							Lastname
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validat	e="Lastname is required">
                        <input class="input100" type="text" name="name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="username">
                        <span class="txt1">
                                Email
                            </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Email is required">
                        <input class="input100" type="email" name="email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="password">
                        <span class="txt1">
							Password
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type = "submit" 
               name = "register">
						Register
						</button>
                    </div>


                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="vendor/animsition/js/animsition.min.js"></script>

    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="vendor/select2/select2.min.js"></script>

    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>

    <script src="vendor/countdowntime/countdowntime.js"></script>

    <script src="js/main.js"></script>
    <script src="js/login.js"></script>

</body>

</html>
END_FORM;
}

function do_post() {
global $messages;
  
    /* Load the class accessing the DB */
require_once("UserModel.php");
try {
		
	if (isset($_POST['register']) && !empty($_POST['firstname']) 
               && !empty($_POST['name']) && !empty($_POST["email"]) && !empty($_POST["password"])  )
    {
		$firstname = trim($_POST["firstname"]);
		//echo $firstname;
		$token = md5(uniqid(rand(), true));
	    $user = UserModel::register($_POST["firstname"],$_POST["name"],$_POST["email"],$_POST["password"], $token);
		echo "$user";
		

		if($user){
			
		$message = "User Registered";
		echo "<script type='text/javascript'>alert('$message');</script>";

		$msg = "You have been registed";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);

		// send email
		mail($_POST["email"],"Registered",$msg);
		
		}
		display_form();
	}
  /* Access the db with PDO and get one row by its id */

} catch (PDOException $exc) {
  /* Each time we access a DB, an exception may occur */
  $msg = $exc->getMessage();
  $code = $exc->getCode();
  print "$msg (error code $code)";
  }
  
  
}
