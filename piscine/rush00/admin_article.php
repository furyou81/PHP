<?PHP
    include ("private/db_get_all_items.php");
    include ("private/db_insert_item.php");
    include ("private/db_get_cat_all.php");
   // include ("private/db_update_cat_name");
    include ("private/db_update_products_name.php");
    include ("private/db_update_products_cat.php");
    include ("private/db_update_products_cat2.php");
    include ("private/db_update_products_prix.php");
    include ("private/db_update_products_label.php");
    include ("private/db_update_products_stock.php");
    include ("private/db_update_products_img.php");
    include ("private/db_remove_item.php");
	if (!isset($_SESSION['login']) || empty($_SESSION['login']) || db_get_user_right($_SESSION['login']) < 1) {
	   header('location: index.php');
	}
    //include ("private/db_isempty_cat.php");
    function checklen($str, $max)
    {
        if (strlen($str) >= $max)
            return (-1);
        else
            return (1);
    }
    $catall = db_get_cat_all();
	if (isset($_FILES["img"]["name"]))
	{
	    $target_dir = "images/";
	    $target_file = $target_dir . basename($_FILES["img"]["name"]);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	    // Check if image file is a actual image or fake image
	    if(isset($_POST["submit"]) && isset($_FILES) && $_FILES["img"]["tmp_name"] != "") {
	        $check = getimagesize($_FILES["img"]["tmp_name"]);
	        if($check !== false) {
	            move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
	            //echo "File is an image - " . $check["mime"] . ".";
	            $uploadOk = 1;
	        } else {
	            echo "File is not an image.";
	            $uploadOk = 0;
	        }
	    }
	}
    $name = $_POST['name'] ?? "";
    $oldname = $_POST['oldname'] ?? "";
    $cat = $_POST['cat'] ?? "";
    $cat2 = $_POST['cat2'] ?? "";
    $prix = $_POST['prix'] ?? "";
    $img = $_FILES['img']['name'] ?? "";
    $label = $_POST['label'] ?? "";
    $stock = $_POST['stock'] ?? "";
    $submit = $_POST['submit'] ?? "";
	$sup = $_POST['sup'] ?? "";
    $success = 0;
    if ($name != "" && $cat != "" && $prix != "" && $img != "" && $label != "" && $stock != "" && $submit == "OK" && $uploadOk == 1)
    {
        if (is_numeric($prix) && is_numeric($stock) && $prix > 0 && $stock > 0)
        {
            if (checklen($name, 255) && checklen($cat, 255) && checklen($cat2, 255) && checklen($img, 255) && checklen($label, 2000) && checklen($prix, 255) && $stock < 1000)
            {
            $servername = "localhost";
            $user = "root";
            $password = "ShopShop";
            $dbname = "rush";
            $link = mysqli_connect($servername, $user, $password, $dbname);
            $item = [];
            $item['name'] = mysqli_real_escape_string($link, $name);
            $item['cat'] = mysqli_real_escape_string($link, $cat);
            $item['cat2'] = mysqli_real_escape_string($link, $cat2);
            $item['prix'] = $prix;
            $item['img'] = mysqli_real_escape_string($link, $img);
            $item['label'] = mysqli_real_escape_string($link, $label);
            $item['stock'] = $stock;
            db_insert_item($item);
            $success = 1;
            }
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        else echo "ERROR UPLOADING OR UPDATING DATA";
    }
    else
    {
        if ($submit == "OK")
        echo "ERROR UPLOADING OR UPDATING DATA";
    }

    if ($submit == "modifier")
    {
        if ($uploadOk == 1)
        {
        $link = db_connect();
        if (checklen($name, 255) == -1)
            echo "ERROR UPLOADING OR UPDATING DATA";

        if (checklen($oldname, 255) == -1)
            echo "ERROR UPLOADING OR UPDATING DATA";
        if ($oldname != "" && $cat != "")
        {
            if (checklen($cat, 255))
            db_update_products_cat(mysqli_real_escape_string($link, $oldname), mysqli_real_escape_string($link, $cat));
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        if ($oldname != "" && $cat2 != "")
        {
            if (checklen($cat2, 255))
            db_update_products_cat2(mysqli_real_escape_string($link, $oldname), mysqli_real_escape_string($link, $cat2));
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        if ($oldname != "" && $prix != "")
        {
            if (is_numeric($prix))
            db_update_products_prix(mysqli_real_escape_string($link, $oldname), $prix);
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        if ($oldname != "" && $label != "")
        {
            if (checklen($label, 2000))
            db_update_products_label(mysqli_real_escape_string($link, $oldname), mysqli_real_escape_string($link, $label));
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        if ($oldname != "" && $stock != "")
        {
            if (is_numeric($stock))
            db_update_products_stock(mysqli_real_escape_string($link, $oldname), $stock);
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }
        if ($oldname != "" && $img != "")
        {
            if (checklen($img, 255))
            db_update_products_img(mysqli_real_escape_string($link, $oldname), mysqli_real_escape_string($link, $img));
            else echo "ERROR UPLOADING OR UPDATING DATA";
        }

        if ($name != "" && $oldname != "")
        {
            db_update_products_name(mysqli_real_escape_string($link, $oldname), mysqli_real_escape_string($link, $name));
        }
        }
        else echo "ERROR UPLOADING OR UPDATING DATA";
    }
    if ($sup == "supprimer")
    {
        if ($oldname != "")
        {
            $link = db_connect();
            db_remove_item(mysqli_real_escape_string($link, $oldname));
        }
    }

?>
<html>
    <head>
        <style>
        .add_article {display: block;
        width: 500px;
        float: left;}
        #ajouterp {background-color: #fff; padding:1%;
        }
        textarea {width: 400px; height: 200px;}
        .hid {display: none;}
  </style>
</head>
    <body>
        <h1> Formulaire pour ajouter ou modifier un article dans la base de donnees </h1>
        <div id="ajouterp">
            <h2> Ajouter un article </h2>
        <form enctype="multipart/form-data" method="post" action="admin_page.php" >
            <label class="add_article"> Nom de l'article: </label><input type="text" name="name" maxlength="255"/><br />
            <label class="add_article"> Categorie: </label><select type="text" name="cat" value="">
                    <option value=""></option>
                    <?PHP foreach ($catall as $c)
            {
                if ($c['number'] == "1")
                {?>
                    <option value="<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></option>
                ?><?PHP }}?>
        </select><br />
            <label class="add_article"> Categorie 2: </label><select type="text" name="cat2">
                    <option value=""></option>
                    <?PHP foreach ($catall as $c)
            {
                if ($c['number'] == "2")
                {?>
                    <option value="<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></option>
                ?><?PHP }}?>
        </select><br />
            <label class="add_article"> Prix: </label><input type="number" name="prix" placeholder="euros" value="" min="0" max="9999"/><br />
            <label class="add_article"> Image: </label><input type="file" name="img" id="img">

            <?PHP //<input type="text" name="img" value=""/>?>
            <br />
            <label class="add_article"> Description: </label><textarea type="text" name="label" value="" maxlength="2000"></textarea><br />
            <label class="add_article"> Quantite en stock: </label><input type="number" name="stock" value="" min="0" max="9999"/><br />
            <input type="submit" name="submit" value="OK" />
        </form>
        <p><?PHP if($success == 1 && $submit == "OK")
                    echo "Un article a bien ete ajoute dans la base de donnee";
                 else if ($submit == "OK")
                    echo "Il s'est produit une erreur, veuillez verifier que les champs obligatoires ont bien ete remplis";?></p>
        </div>
        <main>
            <?PHP
                $allitems = db_get_all_item();
                foreach($allitems as $a)
                {
                    ?>
                <div class="lstprod">
                    <h2><?PHP echo $a['name'];?></h2>
                    <form enctype="multipart/form-data" method="post" action="admin_page.php">
                    <input class="hid" type="text" name="oldname" value="<?PHP echo $a['name'];?>"/>
            <label class="add_article"> Nom de l'article: <?PHP echo $a['name'];?></label><input type="text" name="name" value="<?PHP echo $a['name'];?>" maxlength="255"/><br />
            <label class="add_article"> Categorie: <?PHP echo $a['cat'];?></label><select type="text" name="cat" value="">
                    <option value=""></option>
                    <?PHP foreach ($catall as $c)
                    {
                        if ($c['number'] == "1")
                        {?>
                            <option value="<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></option>
                        ?><?PHP }}?>
        </select><br />
            <label class="add_article"> Categorie 2: <?PHP echo $a['cat2'];?></label><select type="text" name="cat2">
                    <option value=""></option>
                    <?PHP foreach ($catall as $c)
                    {
                        if ($c['number'] == "2")
                        {?>
                            <option value="<?PHP echo $c['name'];?>"><?PHP echo $c['name'];?></option>
                        ?><?PHP }}?>
        </select><br />
            <label class="add_article"> Prix: <?PHP echo $a['prix'];?></label><input type="number" name="prix" placeholder="euros" value="<?PHP echo $a['prix'];?>" min="0" max="9999"/><br />
            <label class="add_article"> Image: <?PHP echo $a['img'];?></label><input type="file" name="img" id="img" value="<?PHP echo $a['img'];?>"><br />
            <label class="add_article"> Description: </label><textarea type="text" name="label"><?PHP echo $a['label'];?></textarea maxlength="2000"> <label> <br />
            <label class="add_article"> Quantite en stock: <?PHP echo $a['stock'];?></label><input type="number" name="stock" value="<?PHP echo $a['stock'];?>" min="0" max="9999"/><br />
            <input type="submit" name="submit" value="modifier" />
            <input type="submit" name="sup" value="supprimer" />
        </form>
                </div>
                <?PHP
                }
            ?>
        </main>
    </body>
</html>
