#!/usr/bin/php
<?PHP
    $i = 1;
    while ($i < $argc)
	{
		if ($argv[$i] != "")
        	echo $argv[$i] . "\n";
        $i++;
    }
?>
