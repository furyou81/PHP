<?php
function db_insert_order($basket, $username)
{
	if(!empty($basket) && !empty($username))
	{
		$servername = "localhost";
		$user= "root";
		$password = "ShopShop";
		$db_name = "rush";

		// Create connection
		$conn = mysqli_connect($servername, $user, $password, $db_name);
		// // Check connection
		if (!$conn) {
	    	die("Connection failed: " . mysqli_connect_error());
		}
		$inter = "', '";
		$value = "'" . $basket . $inter . $username . "'";
		$sql = "INSERT INTO cmd (item, orderwho) VALUES (" . $value . ");";
		if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
			return (TRUE);
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			mysqli_close($conn);
			return (FALSE);
		}
	}
}
?>
