<?PHP
    require_once('./config/database.php');

    $db_camagru = './config/db_camagru.sql';
    $db = new PDO('mysql:host=localhost;charset=utf8', $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tmp = '';
    $lines = file($db_camagru);

    foreach ($lines as $line)
    {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
        $tmp .= $line;
        if (substr(trim($line), -1, 1) == ';')
        {
            $req = $db->prepare($tmp);
            $req->execute();
            $tmp = '';
        }
    }
    $to_del = realpath($db_camagru);
    if (is_writable($to_del))
        unlink($to_del);
    $to_del = realpath('./config/setup.php');
    if (is_writable($to_del))
        unlink($to_del);
 echo "Tables imported successfully";