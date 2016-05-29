<?php
	$link = mysqli_connect("localhost", "root", "", "mvc");
	
	if (mysqli_connect_errno()) {
		print_r(mysqli_connect_error());
		exit();
	}
?>