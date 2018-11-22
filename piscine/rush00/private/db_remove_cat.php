<?php
function db_remove_cat($cat, $nb)
{
	if (!empty($cat) && !empty($nb))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// sql to delete a record
		$sql = "DELETE FROM cat WHERE name='". $cat . "' AND number='". $nb . "'";

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
