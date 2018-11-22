<?PHP
    $val = $_POST['validerc'] ?? "";
    if ($val == "v")
    {
        $bask = $_SESSION['basket'] ?? "";
        $log = $_SESSION['login'] ?? "";
        if ($log != "" && $bask != "")
        {
            $count = 0;
            foreach ($bask as $bb)
                $count++;
            if ($bask != "" && $count > 0)
            {
                db_insert_order(serialize($bask), $log);
                unset($_SESSION['basket']);
                $_SESSION['basket'] = array();
            }
        }

    }
?>
