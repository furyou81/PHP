<?php
  include 'private/db_get_order_all.php';
  if (!isset($_SESSION['login']) || empty($_SESSION['login']) || db_get_user_right($_SESSION['login']) < 1) {
     header('location: index.php');
  }
  function  get_order_list() {
    $open_td = "<td>";
    $closed_td = "</td>";
    $open_tr = "<tr>";
    $closed_tr = "</tr>";
    $open_table = "<table class='order_panel'>";
    $closed_table = "</table>";
    $a = db_get_order_all();
    $a = array_reverse($a, TRUE);
    foreach ($a as $value) {
      echo $open_table.$open_tr.$open_td."Client: ".$value['orderwho'].$closed_td.$open_td.$closed_tr;
      echo $open_tr.$open_td."ref: ".$value['id'].$closed_td.$open_td."order date: ".$value['orderdate'].$closed_td.$closed_tr.$closed_table;
      echo $open_table;
      $items = unserialize($value['item']);
      $total_price = 0;
      echo $open_tr.$open_td."article".$closed_td.$open_td."quantité".$closed_td.$open_td."prix".$closed_td.$closed_tr;
      foreach ($items as $i) {
        $total_price += ($i['prix'] * $i['qty']);
        echo $open_tr.$open_td.$i['article'].$closed_td.$open_td.$i['qty'].$closed_td.$open_td.$i['prix'].$closed_td.$closed_tr;
      }
      echo $open_td.$open_td."Total: ".$closed_td.$open_td.$total_price.$closed_td.$closed_table."<br>";
    }
  }
?>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
</head>
<table class='admin_mainframe'>
  <h1 style="text-align: center">ORDERS LIST</h1>
  <?php get_order_list(); ?>
</table>
