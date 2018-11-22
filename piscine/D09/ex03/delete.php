<?PHP
$id = $_GET["id"] ?? "";

if ($id != "")
{
    $path = "list.csv";
    $file = file_get_contents($path);
    $tab = array_filter(explode("\n", $file));
    $k = inTab($tab, $id);    
    if ($k >= 0)
    {
        array_splice($tab, $k, 1);
        file_put_contents($path, combine($tab));
    }
    else
        http_response_code(400);
}

function combine(array $a)
{
    $str = "";
    foreach($a as $e)
    {
        $str .= $e . "\n";
    }
    return ($str);
}

function inTab($tab, $kk)
{
    foreach($tab as $k => $t)
    {
        $tmp = explode(";", $t);
        if ($tmp[0] == $kk)
            return ($k);
    }
    return (-1);
}
?>