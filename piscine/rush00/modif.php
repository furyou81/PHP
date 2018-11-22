
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rush00.css">
    <title>Nouveau compte</title>
</head>
<body>
    <?PHP include "header.php" ?>
    <?php
    if (isset($_POST['submit']))
if ($_POST['submit'] == "OK")
{
    $old = $_POST['oldpw'];
    $new = $_POST['newpw'];
    $usr = $_POST['login'];
    $id = db_is_user($usr, $old);
    $mess = "";
    if ($id > 0){
        if (db_update_user_pass($usr, $old, $new) == 0)
            echo "ERROR SQL";
        else
            $mess = "Modification faite";
    }
    else
        $mess = "Erreur de mot de passe ou de login";
}
?>
    <?PHP include "nav.php" ?>
    <div id="nv_compte">
        <h1> Modifier votre mot de passe</h1>
        <form method="post" action="modif.php">
        <label class="form_lab"> Identifiant: </label><input pattern="[A-Za-z\d]+" maxlength="10"  title="Six or more characters" type="text" name="login" value=""/>
       <br />
           <label class="form_lab"> Ancien mot de passe: </label><input pattern="[A-Za-z\d]+" maxlength="10"  title="Six or more characters" type="password" name="oldpw" value=""/>
        <br />
           <label class="form_lab"> Nouveau mot de passe: </label><input pattern="[A-Za-z\d]+" maxlength="10"  title="Six or more characters" type="password" name="newpw" value=""/>
       <input type="submit" name="submit" value="OK" />
 </form>
</p><?PHP
        if (isset($mess))
            echo $mess;?></p>
</div>
</body>
</html>
