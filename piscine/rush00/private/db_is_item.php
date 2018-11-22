<?php
function db_is_item($item)
{
	// Create connection
	if (!empty($item))
	{
		$conn = db_connect();
		if (!$conn) {
			die();
		}
		$sql = "SELECT name FROM products";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["name"] == $item["name"])
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
