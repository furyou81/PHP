<?php

function db_insert_user($username, $passwd)
{
	//include ("db_connect.php");
	//include ("db_is_user.php");
	if (!empty($username) && !empty($passwd))
	{
		$servername = "localhost";
		$user = "root";
		$password = "ShopShop";
		$db_name = "rush";

		// Create connection
		$conn = mysqli_connect($servername, $user, $password, $db_name);
		// // Check connection
		if (!$conn) {
	    	die("Connection failed: " . mysqli_connect_error());
		}
		if (db_is_user($username, $passwd) == 0)
		{
			$username = mysqli_real_escape_string($conn, $username);
			$sql = "INSERT INTO user (login, passwd, rights) VALUES ("."'".$username."'".", "."'".hash('whirlpool', $passwd)."','0')";
			if (mysqli_query($conn, $sql)) {
				mysqli_close($conn);
				return (TRUE);
			} else {
				mysqli_close($conn);
				return (FALSE);
			}
		}
	}
	return (FALSE);
}
 ?>
