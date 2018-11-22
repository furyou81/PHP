<?PHP session_start();
include ("private/db_check.php");
db_check();
include "private/db_connect.php";
include "private/basket_add.php";
include "private/basket_delete.php";
include "private/basket_plus.php";
include ("private/db_insert_order.php");
include "private/valider.php";
include ("private/db_get_cat_all.php");
include ("private/db_isempty_cat.php");
include ("private/db_select_item_cat.php");
include ("private/db_select_item_cat2.php");
include ("private/db_is_user.php");
include ("private/db_update_user_pass.php");
include ("private/db_get_user_right.php");
include ("private/db_is_cat.php");
include ("private/db_is_item2.php");
    $deco = $_GET['deco'] ?? "";
    if ($deco == "deco")
    {
        $_SESSION['id'] = "";
        $_SESSION['login'] = "";
        $id_co = "";
        $login_co = "";
    }

    $connect = $_POST['connect'] ?? "";
    $err = 0;
    if ($connect == "OK")
    {
        $login = $_POST['login'] ?? "";
        $passwd = $_POST['passwd'] ?? "";
        $id = db_is_user($login, $passwd);
        if ($id > 0)
        {
            $_SESSION['id'] = $id;
            $_SESSION['login'] = $login;
        }
        else
            $err = 1;
    }
    $id_co = $_SESSION['id'] ?? "";
    $login_co = $_SESSION['login'] ?? "";
?>

<header
	<div>
		<a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/512px-42_Logo.svg.png" id="logo42"t title="42_logo" alt="42_logo"></img></a>
  <div>
	<div id="panier_box">
	<div id="connexion">
        <p> <?PHP
					if(isset($_SESSION['login']))
					{
                    if (db_get_user_right($_SESSION['login']) >= 1)
                    {?>
                        <a href="admin_page.php">Administration du site</a>
                    <?PHP
					}}
                    if ($login_co != "")
                    echo $login_co . ", vous etes connecte";
                    else if ($err == 1)
                    echo "probleme de connexion, de login ou de mot de passe";
                    if ($val == "v" && $log == "")
                    echo "Veuillez vous connecter pour valider la commande";
                    else if ($val == "v" && $bask == "")
                    echo " Votre panier est vide";
                    else if ($val == "v" && $bask != "")
                    echo " Commande valider";
                    ?></p>
        <?PHP if ($login_co == "") {?>
		<form method="post" action="index.php">
                <label class="form_lab"> Identifiant: </label><input  pattern="[A-Za-z\d]+" maxlength="10" title="Six or more characters" type="text" name="login" value=""/>
               <br />
                   <label class="form_lab"> Mot de passe: </label><input pattern="[A-Za-z\d]+" maxlength="10" type="password" title="Six or more characters" name="passwd" value=""/>
               <input type="submit" name="connect" value="OK" />
         </form>
         <a href="create.php">Creer un nouveau compte</a>
        <a href="modif.php">Modifier son mot de passe</a>
        <?PHP }
        else
        {?>
        <a href="index.php?deco=deco">Deconnexion</a>
        <?PHP } ?>
</div>
</div>

</header>
