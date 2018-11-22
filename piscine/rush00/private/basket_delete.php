<?php
if (isset($_POST['remove']))
if ($_POST['remove'] == "Retirer")
{
	$arr = $_SESSION['basket'];
	foreach ($arr as $elem) {
		{  
		if($_POST['articlerem'] != $elem['article']){
			$new_arr[] = $elem;
		}}
	}
	$_SESSION['basket'] = $new_arr;
}
?>
