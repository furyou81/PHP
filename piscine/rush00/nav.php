<?PHP
    $catall = db_get_cat_all();
?>

<nav>

<ul>

    <li class="menu_nav"><a href="index.php">Console</a>
        <ul class="sub_menu_nav">
            <?PHP
            foreach ($catall as $c)
            {
                if ($c['number'] == "2" && db_isempty_cat($c['name'], 2) == FALSE)
                {
                ?>
            <li><a href="index.php?cat=<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></a></li>
            <?PHP }} ?>
        </ul>
    </li>
    <li class="menu_nav"><a href="index.php?type=1">Type </a>
        <ul class="sub_menu_nav">
        <?PHP
            foreach ($catall as $c)
            {
                if ($c['number'] == "1" && db_isempty_cat($c['name'], 1) == FALSE)
                {
                ?>
            <li><a href="index.php?type=<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></a></li>
            <?PHP }} ?>
        </ul>
    </li>
</ul>
<div class="dropdown" style="float:right;">
  <div class="pan"><img src="http://img.over-blog-kiwi.com/300x300/1/88/37/01/20151030/ob_254012_panier.png" id="panier_img" title="Panier" alt="Panier">  </img></div>
  <div class="dropdown-content">
    <div>
        Panier</br>
        <hr />
    </div>
    <?PHP
        $panier = $_SESSION['basket'] ?? "";
        if ($panier != "")
        foreach ($panier as $p)
        {
    ?>
     <form method="post" action="index.php">
        <label class="qty_lab_descr"> <a href="#"> <?PHP echo $p['article'];?></a></label>
        <input class="btn_valider" type="submit" name="modif" value="-"/>
        <label> <?PHP echo $p['qty'];?> </label>
        <input class="btn_valider" type="submit" name="modif" value="+"/>
        <label> <?PHP echo $p['qty'] * $p['prix'] . "€";?> </label>
        <input class="nom_art" type="text" name="articlerem" value="<?PHP echo $p['article']?>"/>
            <input class="btn_retirer" type="submit" name="remove" value="Retirer"/>
       </form>
        <?PHP } ?>



    <hr />
    <p>Total: <?PHP include "private/basket_total.php";?></p>
    <form method="post" action="index.php">
    <button id="passer_commande" type="submit" name="validerc" value="v">Passer la commande</button>
        </form>
  </div>
</div>
</nav>
