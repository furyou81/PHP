#!/usr/bin/php
<?PHP
    date_default_timezone_set('Europe/Paris');
    function    ft_strcmpline($v1, $v2)
    {
        $s1 = $v1[line];
        $s2 = $v2[line];
        $i = 0;
        $len1 = strlen($s1);
        $len2 = strlen($s2);
        $min = min($len1, $len2);
        while (ord($s1[$i]) == ord($s2[$i]) && $i < $min)
            $i++;
            if ($i == $min)
            {
                if ($len1 < $len2)
                    return (-ord($s2[$i]));
                else
                    return (ord($s1[$i]));
            }
        return (ord($s1[$i]) - ord($s2[$i]));
    }
    $USER_PROCESS = 7;
    $input = fopen("/var/run/utmpx", 'r');
    $tab = [];
    while ($data = fread($input, 628))
        array_push($tab, unpack("a256name/a4id/a32line/ipid/itype/Lsec/Lmsec/a256host/i16tmp",$data));
        usort($tab, "ft_strcmpline");
    foreach ($tab as $t)
    {
        if ($t[type] == $USER_PROCESS)
            printf("%-8s %-8s %s\n", trim($t[name]), trim($t[line]), date('M d H:i', $t[sec]));
    }
    fclose($input);
?>
