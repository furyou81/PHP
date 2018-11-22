<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rush00.css">
    <title>Nouveau compte</title>
</head>
<body>
    <?PHP include ("private/db_insert_user.php");?>
    <?PHP include "header.php" ?>
    <?PHP include "nav.php" ?>
    <?PHP
  // include ("db_connect.php");
    $co = 0;
    $login = $_POST['login'] ?? "";
    $passwd = $_POST['passwd'] ?? "";
    $new = $_POST['new'] ?? "";
    if ($login != "" && $passwd != "" && $new == "OK")
    {
        //$conn = db_connect();
        $created = db_insert_user($login, $passwd);
        if ($created == TRUE)
            $co = 1;
        else
            $co = -1;
    }
?>
    <?PHP
        if ($co == 1)
            echo "Votre compte a bien ete cree";
        else if ($co ==
         -1)
            echo "Il y a eu une errreur dans la creation de votre compte";
        if ($co != 1)
        {
    ?>
    <div id="nv_compte">
        <h1> Creation d'un nouveau compte utilisateur</h1>
        <form method="post" action="create.php">
                <label class="form_lab"> Identifiant: </label><input type="text" pattern="[A-Za-z\d]+" maxlength="10" title="Six or more characters" name="login" value=""/>
               <br />
                   <label class="form_lab"> Mot de passe: </label><input type="password" pattern="[A-Za-z\d]+" maxlength="10"  title="Six or more characters" name="passwd" value=""/>
               <input type="submit" name="new" value="OK" />
         </form>
</div>
        <?PHP }?>
</body>
</html>
