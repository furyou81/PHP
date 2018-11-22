<?php
// Create connection
function db_update_user_log($user, $newlog)
{
	if (!empty($user) && !empty($newlog))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE user SET login='". $newlog ."' WHERE login='". $user . "'";
		echo $sql."<br>";
		if (mysqli_query($conn, $sql)) {
		    return(1);
		} else {
			return(0);
		}

		mysqli_close($conn);
	}
}
?>
