<?php
// Create connection
function db_update_user_rights($user, $rights)
{
	if (!empty($user))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE user SET rights=". $rights ." WHERE login='". $user . "'";
		if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
		  return(1);
		} else {
			mysqli_close($conn);
			return(0);
		}
	}
}
?>
