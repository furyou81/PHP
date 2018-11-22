<?PHP
$id = $_GET["id"] ?? "";
$todo = $_GET["todo"] ?? "";
$maxVal = $_GET["maxVal"] ?? "";
if ($id != "" && $todo != "" && $maxVal != "")
{
    $path = "list.csv";
    if (file_exists($path))
        $file = file_get_contents($path);
    $tab = array_filter(explode("\n", $file));
    $k = inTab($tab, "maxVal");    
    if ($k >= 0)
        $tab[$k] = "maxVal;" . $maxVal;
    else
        array_unshift($tab, "maxVal;" . $maxVal);
        array_unshift($tab, $id . ";" . $todo);
    file_put_contents($path, combine($tab));
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

function inTab($tab, $k)
{
    foreach($tab as $k => $t)
    {
        $tmp = explode(";", $t);
        if ($tmp[0] == "maxVal")
            return ($k);
    }
    return (-1);
}
?>