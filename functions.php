<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "", "mvc");
	
	if (mysqli_connect_errno()) {
		print_r(mysqli_connect_error());
		exit();
	}
	if (isset($_GET["function"]) == "logout") {
		session_unset();
	}
	
	function humanTiming($time) {
		$time = time() - $time; // to get the time since that moment
		$time = ($time < 1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'min',
			1 => 's'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits > 1)?'s':'');
		}

	}
	
	function displayTweets($type) {
		global $link;
		if ($type == "public") {
			$whereClause = "";
		}
		$query = "SELECT * FROM tweets".$whereClause." ORDER BY date DESC LIMIT 10";
		$result = mysqli_query($link, $query);
		
		if (mysqli_num_rows($result) == 0) {
			echo "There are no tweets to display.";
		} else {
			while($row = mysqli_fetch_assoc($result)) {
				
				$userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row["userid"])." LIMIT 1";
				$userQueryResult = mysqli_query($link, $userQuery);
				$user = mysqli_fetch_assoc($userQueryResult);
				
				echo "<p>".$user["email"]." ".humanTiming(strtotime($row["date"]))." ago</p>";
				
				echo $row["tweet"];
			}
		}
	}
?>