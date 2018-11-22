#!/usr/bin/php
<?PHP
    $keyval = [];
    $tofind = "";
    if ($argc > 2)
    {
        $tofind = trim($argv[1]);
        $i = 2;
        while ($i < $argc)
        {
            $tmp = explode(":", $argv[$i]);
            $keyval[$tmp[0]] = $tmp[1];
            $i++;
        }
        if (array_key_exists($tofind, $keyval))
        echo $keyval[$tofind] . "\n";
    }
?>