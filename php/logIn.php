		<?php
			###########################
			#connect to the database: #
			###########################
			$authenticated = true;
			$formData = array();
			$pass = $_POST['pass'];
			$user = $_POST['user'];

			// foreach($_POST as $key => $val) {

			// 	$formData[$key] = htmlentities($val,ENT_QUOTES,'UTF-8');

			// 	if (!isset($formData[$key])) {

			// 		break;
			// 	}

			// }

			//die ($username . "&" . $password);

			$db = mysqli_connect("localhost","cupcaker","nomnomnom","customcupcakes");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_errno());
				exit();
			}
			############################################################
			#Check user credentials against known users: Query database#
			############################################################

			$requestString = "SELECT email,password FROM users WHERE(email = '$user' && password = '$pass')";

			$request = mysqli_query($db,$requestString);

			$requestAsArray = mysqli_fetch_array($request);

			if (mysqli_num_rows($request) == 0) {
				$authenticated = false;
			}	

			mysql_close($con);

			if ($authenticated) {
				session_start();
				$_SESSION['uname'] = $user;
			}

			$postData = array('success' => $authenticated);

			//header("js/mainScript.js");
			echo json_encode($postData);

		?>