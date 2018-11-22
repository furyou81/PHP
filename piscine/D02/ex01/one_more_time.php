#!/usr/bin/php
<?PHP
    date_default_timezone_set("Europe/Paris");
    if ($argc == 1 || $argc > 2)
        return ;
    if (preg_match("/^([L|l]undi|[M|m]ardi|[M|m]ercredi|[J|j]eudi|[V|v]endredi|[S|s]amedi|[D|d]imanche){1} (0?[1-9]|[1-2][0-9]|[3][0-1]) ([J|j]anvier|[F|f]evrier|[M|m]ars|[A|a]vril|[M|m]ai|[J|j]uin|[J|j]uillet|[A|a]out|[S|s]eptembre|[O|o]ctobre|[N|n]ovembre|[D|d]ecembre){1} (19[7-9][0-9]|20[0-2][0-9]|20[0-3][0-8]) ([01][0-9]|2[0-3])(:[0-5][0-9]){2}$/", $argv[1]))
    {
        $month = array("Janvier"=>1, "Fevrier"=>2, "Mars"=>3, "Avril"=>4, "Mai"=>5, "Juin"=>6, "Juillet"=>7, "Aout"=>8, "Septembre"=>9,"Octobre"=>10, "Novembre"=>11, "Decembre"=>12,
        "janvier"=>1, "fevrier"=>2, "mars"=>3, "avril"=>4, "mai"=>5, "juin"=>6, "juillet"=>7, "aout"=>8, "septembre"=>9,"octobre"=>10, "novembre"=>11, "decembre"=>12);
        $tab = preg_split("/ /", $argv[1]);

        $YY = intval($tab[3]);
        $MM = intval($month[$tab[2]]);
        $DD = intval($tab[1]);
        if (!checkdate($MM, $DD, $YY))
            echo "Wrong Format";
        else
        {
            $tab2 = preg_split("/:/", $tab[4]);
            $hh = intval($tab2[0]);
            $mm = intval($tab2[1]);
            $ss = intval($tab2[2]);
            echo mktime($hh, $mm, $ss, $MM, $DD, $YY) . "\n";
        }
    }
    else
        echo "Wrong Format";
?>