<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rush00.css">
    <title>Rush00</title>
</head>
	<body>
    <?PHP include "header.php" ?>
    <?PHP include "nav.php" ?>
    <?PHP
        $acceuil = $_GET['cat'] ?? "";
        $produit = $_GET['produit'] ?? "";
        $type = $_GET['type'] ?? "";
        if ($acceuil != "")
            include "main_category.php";
        else if ($produit != "")
            include "produit.php";
        else if ($type == 1)
            include "main_type.php";
        else if ($type != "")
            include "main_cat2.php";
        else
            include "main_acceuil.php";
            ?>

        <?PHP include "footer.php" ?>
	</body>
</html>
