<?PHP
    session_start();
    $logged_on_user = $_SESSION['logged_on_user'] ?? "";
    if ($logged_on_user != "")
    {
        $_SESSION['logged_on_user'] = NULL;
    }
?>