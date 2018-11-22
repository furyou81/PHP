#!/usr/bin/php
<?PHP
    if ($argc != 4)
        echo "Incorrect Parameters\n";
    else
    {
        if (trim($argv[2]) == "+")
            echo ($argv[1] + $argv[3]) . "\n";
        else if (trim($argv[2]) == "-")
            echo ($argv[1] - $argv[3]) . "\n";
        else if (trim($argv[2]) == "*")
            echo ($argv[1] * $argv[3]) . "\n";
        else if (trim($argv[2]) == "/")
            echo ($argv[1] / $argv[3]) . "\n";
        else if (trim($argv[2]) == "%")
			echo ($argv[1] % $argv[3]) . "\n";
    }
?>
