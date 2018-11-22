<?php
function db_get_order_user($username)
{
	if (!empty($username))
	{
		$ret= [];
		// Create connection
		$servername = "localhost";
		$username = "root";
		$password = "ShopShop";
		$db_name = "rush";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $db_name);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT item, orderdate, orderwho FROM cmd";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["orderwho"] == $username)
				{
					$ret[] = $row;
				}
			}
		} else
		return ($ret);
	}
	return ($ret);
}
?>
