<?php

  include 'private/db_get_cat_all.php';
  // include 'admin_cat.css';
  if (!isset($_SESSION['login']) || empty($_SESSION['login']) || db_get_user_right($_SESSION['login']) < 1) {
     header('location: index.php');
  }
  function  str_cat_table($catname, $catnb, $empty) {
    $open_form_del = "<form class='' action='admin_page.php' method='post'>";
    $open_form_edit = "<form class='' action='admin_page.php' method='post'>";
    $closed_form = "</form>";
    $open_td = "<td class='cat_td'>";
    $closed_td = "</td>";
    $delete_allowed = $open_form_del."<button type='submit' name='remove_cat' value='".$catname."_".$catnb."'>delete</button>".$closed_form;
    $catname = $open_form_edit."<button type='submit' name='edit_cat' value='".$catname."_".$catnb."'>edit</button>".$closed_td.$open_td."<input pattern='[a-zA-Z\d ]+' type='text' name='".$catname."_".$catnb."' value='$catname'>".$closed_form;
	// echo $catname."_".$catnb;
    if ($empty)
      return ($open_td.$catname.$closed_td.$open_td.$catnb.$closed_td.$open_td.$delete_allowed.$closed_td);
    return ($open_td.$catname.$closed_td.$open_td.$catnb.$closed_td.$open_td);
  }
  function  catnb_cmp_sort($a1, $a2) {
    return ($a1['number'] - $a2['number']);
  }
  function  get_categories_list() {
    $open_tr = "<tr class='cat_tr'>";
    $closed_tr = "</tr>";
    $a = db_get_cat_all();
    uasort($a, "catnb_cmp_sort");
    foreach ($a as $value) {
      $empty = db_isempty_cat($value['name'], $value['number']);
      if ($empty === -1)
        continue ;
    echo $open_tr.str_cat_table($value['name'], $value['number'], $empty).$closed_tr;
    }
  }

?>

<table>
  <tr>
    <td>
      <?php if (isset($_SESSION['catcreate_msg']) && !empty($_SESSION['catcreate_msg'])) echo "<p>".$_SESSION['catcreate_msg']."</p><br>" ?>
      <form class="" action="admin_page.php" method="post">
        Add new category: <input type:"textbox" name="category_name" pattern="[a-zA-Z\d ]+" maxlength="255">
        <select type="text" name="catnb" value="1">
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
        <input type="submit" name="submit" value="OK">
      </form>
    </td>
  </tr>
  <tr>
    <table>
      <tr>
        <td> <td> Name </td><td> Label </td><td>
          <?php get_categories_list(); ?>
        </form>
      </tr>
    </table>
  </tr>
</table>
