<?php
function db_insert_cat($cat, $nb)
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
			die("Connection failed " . mysqli_connect_error());
		if (db_is_cat($cat, $nb) == 0)
		{
			$value = "'" . $cat ."'";
			$sql = "INSERT INTO cat (name, number) VALUES (" . $value . ", ".$nb.");";
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
}
?>
