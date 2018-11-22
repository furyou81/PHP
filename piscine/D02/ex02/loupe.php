#!/usr/bin/php
<?PHP
function	ft_balise_a($file, $pos)
{

	if (preg_match("/^(<a){1}/", substr($file, $pos)))
		return (1);
	return (0);
}

function	ft_end_a($file, $pos)
{

	if (preg_match("/^(a>){1}/", substr($file, $pos)))
		return (1);
	return (0);
}

function	ft_title($file, $pos)
{
	if (preg_match("/^title=/", substr($file, $pos)))
		return (1);
	else
		return (0);	
}

if ($argc > 1)
{
	if (file_exists($argv[1]))
	{
		$file = "";
		$input = fopen($argv[1], 'r');
		while ($tmp = fgets($input))
			$file .= $tmp;
		$toprint = "";
		$a = 0;
		$i = 0;
		while (ord($file[$i]))
		{
			if (ft_balise_a($file, $i))
				$a = 1;
			if ($file[$i] == '>' && $a == 1)
			{
				while ($file[$i] && $file[$i] != '<')
					$toprint .= strtoupper($file[$i++]);
			}
			else if (ft_title($file, $i) && $a == 1)
			{
				$j = $i;
				$i += 7;
				while ($j < $i)
					$toprint .= $file[$j++];
				while ($file[$i] != '"')
					$toprint .= strtoupper($file[$i++]);
			}
			else if (ft_end_a($file, $i))
			{
				$toprint .= $file[$i++];
				$toprint .= $file[$i++];
				$a = 0;
			}
			else
				$toprint .= $file[$i++];
		}
		echo $toprint;
	}
}
?>
