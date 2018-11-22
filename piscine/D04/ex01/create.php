<?PHP
    $submit = $_POST['submit'] ?? "";
        if ($submit == "OK")
        {
            $login = $_POST['login'] ?? "";
            $passwd = $_POST['passwd'] ?? "";
                if ($login != "" && $passwd != "")
                {
                    if (file_exists("../htdocs/private/passwd"))
                    {
                        $file = file_get_contents("../htdocs/private/passwd");
                        $bdd = unserialize($file);
                        foreach($bdd as $b)
                            if ($b['login'] == $login)
                            {
                                echo "ERROR\n";
                                return ;
                            }
                    }
                    else
                    {
                        if (file_exists("../htdocs") == 0)
                            mkdir("../htdocs");
                        if (file_exists("../htdocs/private") == 0)
                            mkdir("../htdocs/private");
                        $bdd = [];
                    }
                    $bdd[] = ['login' => $login, 'passwd' => hash('whirlpool', $passwd)];
                    $ser = serialize($bdd);
                    file_put_contents("../htdocs/private/passwd", $ser);
                    echo "OK\n";
                }
                else 
                    echo "ERROR\n";
        }
        else
          echo "ERROR\n";
?>