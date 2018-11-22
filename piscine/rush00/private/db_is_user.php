<?php

function db_is_user($username, $passwd)
{
	// Create connection
	//
	if (!empty($username) && !empty($passwd))
	{
		$conn = db_connect();
		if (!$conn) {
			die();
		}
		$sql = "SELECT id, login, passwd FROM user";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["login"] == $username)
				{
					if ($row['passwd'] == hash('whirlpool', $passwd))
						return ($row['id']);
					else
						return (-1);
				}
			}
		} else
			return (0);
	}
	return (0);
}
 ?>
