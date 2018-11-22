<?php
if (!isset($_SESSION['login']) || empty($_SESSION['login']) || db_get_user_right($_SESSION['login']) < 1) {
   header('location: index.php');
}
  function  str_user_table($login, $rights) {
    $open_td = "<td>";
    $closed_td = "</td>";
    $rights = "<input type='checkbox' name='".$login."_rights'".(($rights) ? "checked>" : ">");

    return ($open_td.$login.$closed_td.$open_td.$rights.$closed_td);
  }

  function  user_cmp_sort($a1, $a2) {
    return (strnatcasecmp($a1['login'], $a2['login']));
  }

  function  get_user_rights_list() {
    $open_tr = "<tr>";
    $closed_tr = "</tr>";
    $a = db_get_user_all();

    uasort($a, "user_cmp_sort");
    foreach ($a as $value)
      if ($value['login'] && $value['rights'] != 2)
        echo $open_tr.str_user_table($value['login'], $value['rights']).$closed_tr;
  }
?>
<?php if (isset($_SESSION['user_rights_msg']) && !empty($_SESSION['user_rights_msg'])) echo "<p>".$_SESSION['user_rights_msg']."</p><br>" ?>
<form class="" action="" method="post">
  <table class='order_panel'>
    <tr>
      <td> NAME </td>
      <td> IS ADMIN </td>
    </tr>
    <?php get_user_rights_list(); ?>
  </table>
  <input type="submit" name="submit_rights" value="OK"><br>
</form>
