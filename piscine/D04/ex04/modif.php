<?PHP
    $submit = $_POST['submit'] ?? "";
        if ($submit == "OK")
        {
            $login = $_POST['login'] ?? "";
            $oldpw = $_POST['oldpw'] ?? "";
            $newpw = $_POST['newpw'] ?? "";
            if ($login != "" && $oldpw != "" && $newpw != "")
            {
                    if (file_exists("../htdocs/private/passwd"))
                    {
                        $file = file_get_contents("../htdocs/private/passwd");
                        $bdd = unserialize($file);
                        $found = 0;
                        foreach($bdd as $k => $b)
                            if ($b['login'] == $login)
                            {
                                $found = 1;
                                if ($b['passwd'] != hash('whirlpool', $oldpw))
                                {
                                    echo "ERROR\n";
                                    exit ;
                                }
                                else
                                {
                                    if ($_POST['newpw'] == "")
                                    {
                                        echo "ERROR\n";
                                        exit ;
                                    }
                                    else
                                    {                       
                                        $bdd[$k]['passwd'] = hash('whirlpool', $newpw);
                                        $ser = serialize($bdd);
                                        file_put_contents("../htdocs/private/passwd", $ser);
                                        echo "OK\n";
                                        header("Location: index.html");
                                        exit ;
                                    }
                                }
                            }
                        if ($found == 0)
                        {
                            echo "ERROR\n";
                            exit ;
                        }
                    }
                    else
                        echo "ERROR\n";
            }
            else
                echo "ERROR\n";
        }
        else
          echo "ERROR\n";
?>