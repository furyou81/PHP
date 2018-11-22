<html>
    <body>
<?PHP
    date_default_timezone_set("Europe/Paris");
    if (file_exists("../htdocs/private/chat"))
    {
        $fd = fopen("../htdocs/private/chat", 'r');
        if (flock($fd, LOCK_SH))
        {
            $file = file_get_contents("../htdocs/private/chat");
            $chat = unserialize($file);
            foreach ($chat as $c)
            {
                echo "[" . date("H:i", $c['time']) . "]" . " <b>" . $c['login'] . "</b>: " .  $c['msg'] . "></br>";
            }
        }
        if ($fd > 0)
        {
            flock($fd, LOCK_UN);
            fclose($fd);
        }
    }
?>
    </body>
</html>