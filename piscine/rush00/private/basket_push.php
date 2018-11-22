<?php
session_start();
if (db_insert_order(serialize($_SESSION['basket']), $_SESSION['logged_on_user']) == FALSE)
	echo "ERROR SQL\n";
	unset($_SESSION['basket']);
?>
