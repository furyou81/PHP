#!/usr/bin/php
<?PHP
$input = fopen("php://stdin", 'r');
echo "Entrez un nombre: ";
while ($tmp = fgets($input))
{
	$tmp = str_replace("\n", "",$tmp);
	if (is_numeric($tmp))
	{
		if ($tmp[strlen($tmp) - 1] % 2 == 0)
			echo "Le chiffre " . $tmp . " est Pair\n";
		else
			echo "Le chiffre " . $tmp . " est Impair\n";
	}
	else
		echo "'" . $tmp . "' n'est pas un chiffre\n";
	echo "Entrez un nombre: ";
}
	echo "\n";
fclose($input);
?>
