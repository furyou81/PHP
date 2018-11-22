<?php
if (isset($_POST['submit']) && isset($_POST['qty']))
if ($_POST['submit'] == "Ajouter" && $_POST['qty'] != 0)
{
	$tmp = [];
    $elem_exist = 0;
    if (!isset($_SESSION['basket']))
        $_SESSION['basket'] = array();
    foreach ($_SESSION['basket'] as $elem) {
        if($_POST['article'] == $elem['article']){
            $elem['qty'] += (int)$_POST['qty'];
			$elem_exist = 1;
		}
		$tmp[] = $elem;
    }
    if ($elem_exist ==  0){
        $arr = array(
            'article' =>  $_POST['article'],
            'qty' => (int)$_POST['qty'],
            'prix' => (int)$_POST['prix']
        );
        $_SESSION['basket'][] = $arr;
	}
	else{
		$_SESSION['basket'] = $tmp;
	}
}
?>


