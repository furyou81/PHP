<?PHP
    session_start();
    date_default_timezone_set("Europe/Paris");
    $logged_on_user = $_SESSION['logged_on_user'] ?? "";
    if ($logged_on_user != NULL)
    {
        $msg = $_POST['msg'] ?? "";
        $submit = $_POST['submit'] ?? "";
            if ($msg != "" && $submit != "")
            {
                    if (file_exists("../htdocs/private/chat"))
                    {
                        $fd = fopen("../htdocs/private/chat", 'r');
                        if (flock($fd, LOCK_EX))
                        {
                            $file = file_get_contents("../htdocs/private/chat");
                            $chat = unserialize($file);
                        }
                    }
                    else
                    {
                        if (file_exists("../htdocs") == 0)
                            mkdir("../htdocs");
                        if (file_exists("../htdocs/private") == 0)
                            mkdir("../htdocs/private");
                        $chat = array();
                        $fd = 0;
                    }
                    $chat[] = array('login' => $logged_on_user, 'time' => time(), 'msg' => $msg);
                    $ser = serialize($chat);
                    file_put_contents("../htdocs/private/chat", $ser);
                    if ($fd > 0)
                    {
                        flock($fd, LOCK_UN);
                        fclose($fd);
                    }
            }
    }
?>
<html>
    <head> <script langage="javascript">top.frames['chat'].location = 'chat.php';</script> </head>
    <body>
        <form method="post" action="speak.php">
            <label> Message: </label><input type="text" name="msg" value=""/>
            <input type="submit" name="submit" value="OK" />
        </form>
    </body>
</html>