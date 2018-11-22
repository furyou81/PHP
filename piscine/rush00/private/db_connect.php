<?PHP
    function db_connect()
    {
$servername = "localhost";
$username = "root";
$password = "ShopShop";
$db_name = "rush";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);
// Check connection
if (!$conn) {
    die();
}
return ($conn);
    }
?>
