#!/usr/bin/php
<?PHP
$i = 0;
$nb1 = "";
$nb2 = "";
$op = "";

if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	$tmp = preg_split("/\s+/", trim($argv[1]));
	$cleaned = "";
	foreach ($tmp as $t)
		$cleaned .= trim($t);
	if (preg_match("/^\s*[-+]{0,1}[0-9]+\s*[+-\\\\\\/\\\\\\*\\\\\\%]{1}\s*[+-]{0,1}[0-9]+\s*$/", $argv[1]) === 0)
	{	
		echo "Syntax Error\n";
		return ;
	}
	$nb1 .= $cleaned[$i++];	
	while (is_numeric($cleaned[$i]) == 1)
		$nb1 .= $cleaned[$i++];
	$op = $cleaned[$i++];
	while ($cleaned[$i])
		$nb2 .= $cleaned[$i++];
	if ($op == "+")
		echo $nb1 + $nb2 . "\n";
	else if ($op == "-")
		echo $nb1 - $nb2 . "\n";
	else if ($op == "*")
		echo $nb1 * $nb2 . "\n";
	else if ($op == "/")
		echo $nb1 / $nb2 . "\n";
	else if ($op == "%")
		echo $nb1 % $nb2 . "\n";
}
?>
