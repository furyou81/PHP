<?php
function db_check()
{
	$servername = "localhost";
	$username = "root";
	$password = "ShopShop";
	$db_name = "rush";
	// Create connection

	// $conn = mysqli_connect($servername, $username, $password, $db_name);
	// if (!$conn) {
		// mysqli_close($conn);
    	$conn = mysqli_connect($servername, $username, $password);
		if ($conn) {
			if (!mysqli_select_db($conn,"rush"))
			{
			$sql = "CREATE DATABASE rush";
			if (mysqli_query($conn, $sql))
			{
	//			mysqli_close($conn);
				// $conn = mysqli_connect($servername, $username, $password, $db_name);
				mysqli_select_db($conn,"rush");
				// if (!$conn) {
				//     die("Connection failed: " . mysqli_connect_error());
				// }
	    		$sql = "create table user (
					id smallint not null auto_increment,
					login char(255) not null,
					passwd char(255) not null,
					rights smallint not null,
					primary key (id))engine=innodb;";
				if (!mysqli_query($conn, $sql))
				{
    				echo "Error creating table: " . mysqli_error($conn);
				}
				$sql = "create table products (
					id smallint not null auto_increment,
					name char(255) not null,
					cat char(255) not null,
					cat2 char(255) not null,
					prix char(255) not null,
					img char(255) not null,
					label text(500) not null,
					stock smallint not null,
					primary key (id))engine=innodb;";
				if (!mysqli_query($conn, $sql))
				{
    				echo "Error creating table: " . mysqli_error($conn);
				}
				$sql = "create table cmd (
					id smallint not null auto_increment,
					item text(4096) not null,
					orderdate timestamp,
					orderwho char(255) not null,
					primary key (id))engine=innodb;";
				if (!mysqli_query($conn, $sql))
				{
    				echo "Error creating table: " . mysqli_error($conn);
				}
				$sql = "create table cat (
					id smallint not null auto_increment,
					name char(255) not null,number char(1) not null,
					primary key (id))engine=innodb;";
				if (!mysqli_query($conn, $sql))
				{
    				echo "Error creating table: " . mysqli_error($conn);
				}
				$sql = "INSERT INTO `user` (`login`, `passwd`, `rights`) VALUES
					('admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 2),
			 		('lfujimot', '6a4a35c72439cd36684fdcd17fd9660ad5ea9478fa0b6917da47066b5736f59f3ae2ac34c12b6147725e0738c8f9ee596fcb6847fb22a9831f1027bed49bde9b', 0);";
				if (!mysqli_query($conn, $sql)) {
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				$sql = $sql = "INSERT INTO `products` (`name`, `cat`, `cat2`, `prix`, `img`, `label`, `stock`) VALUES
					('Farcry 5', 'FPS', 'PS4', '75', 'farcry5.jpg', 'Far Cry 5 is an action-adventure first-person shooter video game developed by Ubisoft Montreal and Ubisoft Toronto and published by parent company Ubisoft for Microsoft Windows, PlayStation 4 and Xbox One. It is the eleventh installment and the fifth main title in the Far Cry series. It was released on March 27, 2018. Similar to its predecessors, Far Cry 5 is an action-adventure first-person shooter set in an open world environment which the player can explore freely on foot or via various vehicles.', 200),
					('Yakuza 6', 'Action', 'PS4', '59', 'yakuza6.jpg', 'Kazuma Kiryu revient à Kamurocho après que Haruka lui ait donné des informations sensibles sur l ancien président et chef Yakuza. Haruka avait espéré se retirer de sa vie d idole et retourne à l orphelinat.', 140),
					('PES 2018', 'Sport', 'PS4', '45', 'pes2018.jpg', 'Pro Evolution Soccer 2018 (officiellement abrégé PES 2018) est un jeu vidéo de football développé par PES Productions.', 48),
					('The Legend of Zelda : Breath of the Wild', 'Aventure', 'Switch', '65', 'zelda.jpg', 'Contrairement aux autres jeux The Legend of Zelda (excepté peut-être le premier), les événements de Breath of the Wild se déroulent dans un Hyrule devenu désolé, à la place du royaume fantastique vu habituellement dans la série. Des ruines et bâtiments abandonnés et de créatures hostiles.', 78),
					('GTA 5', 'Action', 'PS4', '45', 'gta5.jpg', 'Grand Theft Auto V est un jeu vidéo action-aventure, développé par Rockstar North et édité par Rockstar Games', 24),
					('Mario Odyssey', 'Aventure', 'Switch', '48', 'odyssey.jpg', 'Super Mario Odyssey est un jeu vidéo de plates-formes développé par Nintendo EPD Tokyo et édité par Nintendo. Il est sorti mondialement le 27 octobre 2017 sur Nintendo Switch.', 47),
					('Halo 5', 'FPS', 'Xbox', '34', 'halo5.jpg', 'Halo 5: Guardians est un jeu vidéo de tir à la première personne édité par Microsoft Studios et développé par 343 Industries sur Xbox One, sorti le 27 octobre 2015.', 25),
					('Pokemon Platine', 'Aventure', 'DS', '24', 'pokemon.jpg', 'Pokémon version Platine est le troisième jeu de la quatrième génération Pokémon. Ce jeu est une version tiers complémentaire aux très célèbres versions Diamant et Perle. Platine est sorti en septembre 2008 au Japon et est arrivé en Mai 2009 en Europe. Pokémon Platine nous fait redécouvrir la région de Sinnoh.', 12);";
				if (!mysqli_query($conn, $sql)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				$sql = "INSERT INTO `cmd` (`item`, `orderdate`, `orderwho`) VALUES
					('a:1:{i:0;a:3:{s:7:\"article\";s:8:\"Farcry 5\";s:3:\"qty\";i:35;s:4:\"prix\";i:75;}}', '2018-04-01 14:28:31', 'lfujimot');";
				if (!mysqli_query($conn, $sql)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				$sql = "INSERT INTO `cat` (`name`, `number`) VALUES
					('FPS', '1'),
					('Action', '1'),
					('Aventure', '1'),
					('Sport', '1'),
					('PS4', '2'),
					('Switch', '2'),
					('Xbox', '2'),
					('DS', '2');";
				if (!mysqli_query($conn, $sql)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	mysqli_close($conn);
}
?>
