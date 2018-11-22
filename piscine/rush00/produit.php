<?PHP
    include ("private/db_item_id_select.php");
    $produit = $_GET['produit'] ?? "";
    if ($produit != "")
    {
		if (!db_is_item2($produit))
		{
			header("location: index.php");
		}
		$item = db_item_id_select($produit);
    }

?>

<main>
    <div class="prod_descr">
        <img src="images/<?PHP echo $item['img'];?>" class="descr_img" title="nomprod" alt="nomprod"></img>
        <p class="nom_produit"> <?PHP echo $item['name'] . " Prix: " . $item['prix'] . "€";?></p>
        <p class="description_produit"> <?PHP echo $item['label'];?>
        </p>
        <div id="form_descr">
        <form method="post" action"index.php?produit=<?PHP echo $produit;?>">
        <label class="qty_lab_descr" for="qty">Quantité</label>
            <select class="qty_select" name="qty" id="qty">
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
       <input class="nom_art" type="text" name="prix" value="<?PHP echo $item['prix'];?>"></type>
        <input class="nom_art" type="text" name="article" value=<?PHP echo $item['name'];?>></type>
        <input class="btn_select" type="submit" name="submit" value="Ajouter" />
        </form>
        </div>
    </div>

</main>
