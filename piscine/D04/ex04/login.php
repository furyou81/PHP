<?PHP
    include("auth.php");
    $login = $_POST['login'] ?? "";
    $passwd = $_POST['passwd'] ?? "";
    if ($login != "" && $passwd != "")
    {
        session_start();
        if (auth($login, $passwd))
        {
            $_SESSION['logged_on_user'] = $login;?>
                    <iframe src="chat.php" name="chat" width="100%" height="550px"></iframe>
                    <iframe src="speak.php" name="speak" width="100%" height="50px"></iframe>
            <?PHP
        }
        else
        {
            $_SESSION['logged_on_user'] = "";
            echo "ERROR\n";
        }
    }
?>