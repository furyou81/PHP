<?php
// Create connection
function db_update_user_pass($user, $oldpass, $newpass)
{
	if (!empty($user) && !empty($oldpass) && !empty($newpass))
	{
		// Check connection
		if (db_is_user($user, $oldpass))
		{
			$conn = db_connect();
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "UPDATE user SET passwd='". hash('whirlpool', $newpass) ."' WHERE login='". $user . "'";
			echo $sql."<br>";
			if (mysqli_query($conn, $sql)) {
			    return(1);
			} else {
				return(0);
			}

			mysqli_close($conn);
	}	}
}
?>
