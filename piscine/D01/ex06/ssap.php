#!/usr/bin/php
<?PHP
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
        sort($tab);
		foreach ($tab as $t)
		{
			$t = trim($t) . "\n";
			if ($t != "\n")
				echo $t;
		}
}
?>
