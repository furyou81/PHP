<?php
// Create connection
function db_update_products_img($name, $newname)
{
	if (!empty($name) && !empty($newname))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE products SET img='". $newname ."' WHERE name='". $name . "'";
		if (mysqli_query($conn, $sql)) {
		    return(1);
		} else {
			return(0);
		}

		mysqli_close($conn);
	}
}
?>
