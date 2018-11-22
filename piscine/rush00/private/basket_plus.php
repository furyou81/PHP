<?php
if(isset($_POST['modif']))
if ($_POST['modif'] == "+")
{
	$arr = $_SESSION['basket'];
	foreach ($arr as $elem) {
		if($_POST['articlerem'] == $elem['article'])
			$elem['qty'] += 1;
		$new_arr[] = $elem;
	}
	$_SESSION['basket'] = $new_arr;
}
else if ($_POST['modif'] == "-")
{
	$arr = $_SESSION['basket'];
	foreach ($arr as $elem) {
		if($_POST['articlerem'] == $elem['article'])
			$elem['qty'] -= 1;
		if ($elem['qty'] > 0)
			$new_arr[] = $elem;
	}
	$_SESSION['basket'] = $new_arr;
}
?>
