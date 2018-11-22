<?php
function db_isempty_cat($cat, $catnb)
{
	// Create connection
	if (!empty($cat) && !empty($catnb))
	{
		$conn = db_connect();
		if (!$conn) {
			die();
		}
		$sql = "SELECT cat, cat2 FROM products";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if (($catnb == '1' && $row["cat"] == $cat) ||
				 		($catnb == '2' && $row["cat2"] == $cat))
				{
					return (FALSE);
				}
			}
		}
		return (TRUE);
	}
	return (-1);
}
?>
