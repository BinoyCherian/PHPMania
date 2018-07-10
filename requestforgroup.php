<!DOCTYPE html>
<html>

<head>
    <title>Join</title>
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
                <form class="login100-form validate-form flex-sb flex-w" method="POST" action="welcome.php" id="myform">
                    <span class="login100-form-title">
						Request to join group
					</span>

                    <div class="username">
                        <span class="txt1">
							User Id
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="password">
                        <span class="txt1">
							Group
						</span>
                    </div>
                    
					<div class="wrap-input100 validate-input">
					<select name="grp_id" class="input100" id="grp_id">
					<option value="">--Select--</option>
					<?php
					          $db = mysqli_connect('localhost','root','','sql_skills')
							  or die('Error connecting to MySQL server.');
							  
							  $a = mysqli_query($db,"SELECT DISTINCT name FROM usergroup") or die('BAD SQL.');							  
							  
							  while($row = mysqli_fetch_array($a))
							  {
								  $selected = ( $row['name']=="id_for_compare" ? ' selected' : '' );
								  echo '
								  <option value="'.$row['name'].'"'.$selected.'>'.$row['name'].'</option>';
							  }
							  						  
							  
					?>
					</select>
					</div>
					
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
							Join
						</button>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                                Back
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