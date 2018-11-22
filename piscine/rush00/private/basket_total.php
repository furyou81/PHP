<?php
$total = 0;
if (isset($_SESSION['basket']))
foreach ($_SESSION['basket'] as $value) {
	$total += $value['qty'] * $value['prix'];
}
echo $total . "€";
?>
