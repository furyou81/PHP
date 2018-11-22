<?php
	//include ("db_connect.php");
function db_select_item_cat($cat)
{
	$conn = db_connect();
	if (!$conn) {
		die();
	}
	$sql = "SELECT id, name, cat, cat2, prix, img, label, stock FROM products WHERE cat2 = '" . $cat . "'";
	$result = mysqli_query($conn, $sql);
	$ret = [];
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$ret[] = ["id" => $row["id"], "name" => $row["name"], "cat" => $row["cat"], "cat2" => $row["cat2"], "prix" => $row["prix"], "img" => $row["img"], "label" => $row["label"], "stock" => $row["stock"]];
		}
		mysqli_close($conn);
		return ($ret);
	}
	mysqli_close($conn);
	return ("");
}
?>