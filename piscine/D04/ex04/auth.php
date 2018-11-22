<?PHP
    function auth($login, $passwd)
    {
        if (file_exists("../htdocs/private/passwd"))
        {
            $file = file_get_contents("../htdocs/private/passwd");
            $bdd = unserialize($file);
            foreach ($bdd as $b)
            {
                if ($b['login'] == $login)
                {
                    if ($b['passwd'] == hash('whirlpool', $passwd))
                    {
                        return (TRUE);
                    }
                    else
                        return (FALSE);
                }
            }
        }
        return (FALSE);
    }
?>