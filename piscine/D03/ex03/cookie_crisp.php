<?PHP
	$action	= "";
	$name	= "";
	$value	= "";
	foreach ($_GET as $k => $v)
		if ($k == "action")
			$action = $v;
		else if ($k == "name")
			$name = $v;
		else if ($k == "value")
			$value = $v;
	switch ($action)
	{
		case "set":
			if ($name != "" && $value != "")
				setcookie($name, $value, time() + 3600);
			break ;
		case "get":
			if ($name != "")
			{
				$cook = "";
				foreach ($_COOKIE as $k => $v)
					if ($k == $name)
						$cook = $v;
				if ($cook != "")
					echo $cook . PHP_EOL;
			}
			break ;
		case "del":
			if ($name != "")
				setcookie($name, "", time() -3600, "/");
			break ;
}
?>
