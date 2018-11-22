
<main>
<?PHP foreach ($catall as $c)
            {
                if ($c['number'] == "1" && db_isempty_cat($c['name'], 1) == FALSE)
                { ?>
<div class="cat">
    <?PHP $items = db_select_item_cat2($c['name']);?>
    <a href=index.php?type=<?PHP echo $c['name'];?>><h1 class="cat_acceuil"> <?PHP echo $c['name'];?> </h1></a>
    <?PHP 
        $count = 0;
        foreach ($items as $it)
        {?>
        
        <a href="index.php?produit=<?PHP echo $it['id'];?>">
    <div class="article"> 
    <img class="article_img" src="images/<?PHP echo $it['img']?>"> </img>
</a>    <p> <?PHP echo $it['name']?> Prix: <?PHP echo $it['prix']?>€</p>
        <form method="post" action="index.php?type=<?PHP echo $cat;?>">
        <label class="qty_lab" for="qty">Quantité</label>
            <select name="qty" id="qty">
           <option value="0"></option>
           <option value="1">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
           <option value="4">4</option>
           <option value="5">5</option>
           <option value="6">6</option>
           <option value="7">7</option>
           <option value="8">8</option>
           <option value="9">9</option>
           <option value="10">10</option>
       </select>
       <input class="nom_art" type="text" name="prix" value="<?PHP echo $it['prix']?>"></type>
        <input class="nom_art" type="text" name="article" value="<?PHP echo $it['name']?>"></type>
        <input type="submit" name="submit" value="Ajouter" />
        </form>
    </div>
            <?PHP $count++;
            if ($count >= 3)
            break ;
        }
    ?>
 <hr/>
</div>

    <?PHP } }?>


</main>