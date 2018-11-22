<?php
function db_get_user_all()
{
	$ret= [];
	// Create connection
	$servername = "localhost";
	$user = "root";
	$password = "ShopShop";
	$db_name = "rush";

	// Create connection
	$conn = mysqli_connect($servername, $user, $password, $db_name);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "SELECT * FROM user";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
				$ret[] = $row;
		}
		return ($ret);
	} else{
	return ($ret);
	}
}
?>
