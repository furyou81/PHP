#!/usr/bin/php
<?PHP
    $cleaned = trim(preg_replace("/[ \t]+/", " ", $argv[1]), " ");
	if ($argc > 1)
	{
		if (trim($cleaned) != "")
			echo $cleaned . "\n";
	}
?>
