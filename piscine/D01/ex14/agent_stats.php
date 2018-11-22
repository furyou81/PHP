#!/usr/bin/php
<?PHP
	$file = [];
	$input = fopen("php://stdin", 'r');
	$a = 0;
	$m = 0;
	$count_nb = 0;
	while ($tmp = fgets($input))
	{
		if ($a == 0)
			$a = 1;
		else
			array_push($file, $tmp);
	}
	fclose($input);
	$csv = [];
	foreach ($file as $f)
		array_push($csv, str_getcsv($f, ';'));
	if ($argv[1] == "moyenne")
	{
		foreach ($csv as $c)
		{
			if ($c[2] != "moulinette" && preg_match("/^[0-9]+$/", $c[1]))
			{
				$count_nb++;
				$m += $c[1];
			}
		}
		echo $m / $count_nb . "\n";
	}
	else if ($argv[1] == "moyenne_user")
	{
		$tmp = [];
		foreach ($csv as $c)
		{
			array_push($tmp, $c[0]);
		}
		$tmp = array_unique($tmp, SORT_STRING);
		sort($tmp);
		foreach($tmp as $k => $t)
		{
			$moy = 0;
			$nb = 0;
			foreach ($csv as $c)
			{
				if ($c[0] == $t && preg_match("/^[0-9]+$/", $c[1]) && $c[2] != "moulinette")
				{
					$count_nb++;
					$moy += $c[1];
					$nb++;
				}
			}
			if ($nb == 0)
				unset($tmp[$k]);
			else
				$tmp[$k] .= ":" . $moy / $nb;
		}
		foreach ($tmp as $t)
				echo $t . "\n";
	}
	else if ($argv[1] == "ecart_moulinette")
	{
		$tmp = [];
		foreach ($csv as $c)
		{
			array_push($tmp, $c[0]);
		}
		$tmp = array_unique($tmp, SORT_STRING);
		sort($tmp);
		foreach($tmp as $k => $t)
		{
			$moy = 0;
			$nb = 0;
			$nbm = 0;
			$mouli = 0;
			foreach ($csv as $c)
			{
				if ($c[0] == $t && preg_match("/^[0-9]+$/", $c[1]) && $c[2] != "moulinette")
				{
					$count_nb++;
					$moy += $c[1];
					$nb++;
				}
				else if ($c[0] == $t && preg_match("/^[0-9]+$/", $c[1]) && $c[2] == "moulinette")
				{
					$mouli += $c[1];
					$nbm++;
				}
			}
			if ($nb == 0 && $nbm == 0)
					unset($tmp[$k]);
			else
				$tmp[$k] .= ":" . ($moy / $nb - $mouli / $nbm);
		}
		foreach($tmp as $t)
			echo $t . "\n";
	}
?>
