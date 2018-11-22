<?php
// Create connection
function db_update_cat_name($cat, $catnb, $newname)
{
	if (!empty($cat) && !empty($cat) && !empty($newname))
	{
		$conn = db_connect();
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE cat SET name='". $newname ."' WHERE name='". $cat . "' AND number='". $catnb . "'";
		echo $sql."<br>";
		if (mysqli_query($conn, $sql)) {
		    return(1);
		} else {
			return(0);
		}

		mysqli_close($conn);
	}
}
?>
