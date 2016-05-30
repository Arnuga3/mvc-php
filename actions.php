<?php
	include("functions.php");
	
	if ($_GET["action"] == "loginSignup") {
		
		$error = "";
		
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$password = isset($_POST['password']) ? $_POST['password'] : "";
		
		if ($email == "") {
			$error = "An email is required.";
		} elseif ($password == "") {
			$error = "A password is required.";
		} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$error = "Email is not valid.";
		}
		
		if ($error != "") {
			echo $error;
			exit();
		} 
		if ($_POST["optionActive"] == "0") {
				
			$query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $email)."' LIMIT 1";
			$result = mysqli_query($link, $query);
			if (mysqli_num_rows($result) > 0) {
				$error = "That email is already taken.";
			} else {
				$query = "INSERT INTO users (email, password) VALUES ('". mysqli_real_escape_string($link, $email)."','". mysqli_real_escape_string($link, $password)."')";
				if (mysqli_query($link, $query)) {
					
					$_SESSION["id"] = mysqli_insert_id($link);
					
					$query = "UPDATE users SET password = '".md5(md5($_SESSION["id"]).$password)."' WHERE id = ".$_SESSION["id"]." LIMIT 1";
					mysqli_query($link, $query);					
					echo 1;
					
				} else {
					$error = "Couldn't create a user - please try again.";
				}
			}
			
		} else {
			$query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $email)."' LIMIT 1";
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_assoc($result);
			
			if ($row["password"] == md5(md5($row["id"]).$password)) {
				
				$_SESSION["id"] = $row["id"];
				
				echo 1;
			} else {
				$error = "An email or a password is not correct. Please try again.";
			}
		}
		if ($error != "") {
			echo $error;
			exit();
		}
	}
?>