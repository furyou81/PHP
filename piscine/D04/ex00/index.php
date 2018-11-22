<?PHP
	session_start();
	$login = "";
	$passwd = "";
	$ok = 0;
	foreach ($_GET as $k => $v)
		if ($k == "submit" && $v == "OK")
		{
			$ok = 1;
			break ;
		}
	if ($ok == 1)
		foreach ($_GET as $k => $v)
		{
			if ($k == "login")
				$_SESSION['login'] = $v;
			else if ($k == "passwd")
				$_SESSION['passwd'] = $v;
		}
	foreach ($_SESSION as $k => $v)
	{
		if ($k == "login")
			$login = $v;
		else if ($k == "passwd")
			$passwd = $v;
	}
?>
<html><body>
	<form method="get" action="index.php">
		<label> Identifiant: </label><input type="text" name="login" value="<?PHP echo $login;?>"/>
	   <br />
	   	<label> Mot de passe: </label><input type="password" name="passwd" value="<?PHP echo $passwd;?>"/>
	   <input type="submit" name="submit" value="OK" />
	</form>
</body></html>