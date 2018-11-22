#!/usr/bin/php
<?PHP
function    ft_tolower($c1)
{
	if ($c1 >= 65 && $c1 <= 90)
		$c1 = $c1 + 32;
	return ($c1);
}
function    ft_conv($c1)
{
	if ($c1 >= 65 && $c1 <= 90)
		$c1 = $c1 + 32;
	else if ($c1 >= 97 && $c1 <= 122)
		$c1 = $c1;
	else if ($c1 >= 48 && $c1 <= 57)
		$c1 = $c1 + 500;
	else $c1 = $c1 + 1000;
	return ($c1);
}
function    ft_strcmp($s1, $s2)
{
	$i = 0;

	$len1 = strlen($s1);
	$len2 = strlen($s2);
	$min = min($len1, $len2);
	while (ft_tolower(ord($s1[$i])) == ft_tolower(ord($s2[$i])) && $i < $min)
		$i++;
	if ($i == $min)
	{
		if ($len1 < $len2)
			return (-ft_conv(ord($s2[$i])));
		else
			return (ft_conv(ord($s1[$i])));
	}
	return (ft_conv(ord($s1[$i])) - ft_conv(ord($s2[$i])));
}
if ($argc > 1)
{
	$tab = [];
	$i = 1;
	while ($i < $argc)
	{
		$split = preg_split("/\s+/", trim($argv[$i]));
		$tab = array_merge($split, $tab);
		$i++;
	}
	usort($tab, "ft_strcmp");

	foreach ($tab as $t)
	{
		$t = trim($t) . "\n";
		if ($t != "\n")
			echo $t;
	}
}
?>
