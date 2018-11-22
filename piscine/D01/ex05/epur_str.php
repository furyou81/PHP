#!/usr/bin/php
<?PHP
    if ($argc == 2)
    {
        $tmp = trim(preg_replace("/\s+/", " ", $argv[1]));
		$tmp = trim($tmp) .  "\n";
		if ($tmp != "\n")
			echo $tmp;
    }
?>
