#!/usr/bin/php
<?PHP
    if ($argc > 1)
    {
        $split = preg_split("/\s+/", trim($argv[1]));
        $tmp = $split[0];
        $str = "";
        array_splice($split, 0, 1);
        foreach($split as $word)
            $str .= $word . " ";
		$str .= trim($tmp) . "\n";
		if ($str != "\n")
        	echo $str;
    }
?>
