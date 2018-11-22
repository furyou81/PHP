<?PHP
    header('Content-type:application/json;charset=utf-8');
    $path = "list.csv";
    $file = file_get_contents($path);
    $tab = explode("\n", $file);
    echo json_encode($tab);
?>