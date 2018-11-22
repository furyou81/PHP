<?php
function db_remove_item($item)
{
	if (!empty($item))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// sql to delete a record
		$sql = "DELETE FROM products WHERE name='". $item . "'";

		if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
			return(1);
		} else {
			mysqli_close($conn);
			echo "Error deleting record: " . mysqli_error($conn);
			return (0);
		}
	}
}
?>
