<?php
//include ("db_connect.php");
include ("db_is_item.php");
function db_insert_item($item)
{
	if (!empty($item))
	{
		$conn = db_connect();
		if (!$conn) {
			die();
		}
		if (db_is_item($item) == 0)
		{
			$inter = "', '";
			$value = "'" . $item["name"] . $inter . $item["cat"]. $inter . $item["cat2"]. $inter . $item["prix"] . $inter . $item["img"] . $inter . $item["label"] . $inter . $item["stock"] . "'";
			$sql = "INSERT INTO products (name, cat, cat2, prix, img, label, stock) VALUES (" . $value . ");";
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
	return (FALSE);
}
?>
