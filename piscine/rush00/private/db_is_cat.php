<?php
function db_is_cat($cat, $nb)
{
	if (!empty($cat) && !empty($nb))
	{
		$servername = "localhost";
		$username = "root";
		$password = "ShopShop";
		$db_name = "rush";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $db_name);
		if (!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT name, number FROM cat";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["name"] == $cat && $row["number"] == $nb)
				{
					return (1);
				}
			}
		} else
		return (0);
	}
	return (0);
}
?>
