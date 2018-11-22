<?PHP
    session_start();
    $logged_on_user = $_SESSION['logged_on_user'];
    if ($logged_on_user != "")
    {
        if ($_SESSION['logged_on_user'] != NULL)
            echo $logged_on_user . "\n";
        else
            echo "ERROR\n";
    }
    else
        echo "ERROR\n";

?>