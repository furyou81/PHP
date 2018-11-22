<?php
  if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
  include 'private/db_connect.php';
  include 'private/db_get_user_right.php';
  include 'private/db_check.php';
  db_check();

  if (!isset($_SESSION['login']) || empty($_SESSION['login']) || db_get_user_right($_SESSION['login']) < 1) {
     header('location: index.php');
  }
  function    check_usr_mgr_request() {
    include 'private/db_update_user_rights.php';
    include 'private/db_get_user_all.php';

    $_SESSION['user_rights_msg'] = "";
    if (isset($_POST['submit_rights']) && $_POST['submit_rights'] == "OK") {
      $users = db_get_user_all();
      foreach ($users as $user) {
        $login = $user['login'];
        if (!empty($login) && $user['rights'] != 2) {
          $rights = (isset($_POST[$login."_rights"])) ? 1 : 0;
          if (!db_update_user_rights($login, $rights)) {
            $_SESSION['user_rights_msg'] = "Can't connect to database.";
            break ;
          }
        }
      }
    }
  }

  function    check_cat_mgr_request() {
    include 'private/db_is_cat.php';
    include 'private/db_isempty_cat.php';
    include 'private/db_insert_cat.php';
    include 'private/db_remove_cat.php';
    include 'private/db_update_cat_name.php';

    $_SESSION['catcreate_msg'] = "";
    if (isset($_POST['submit']) && $_POST['submit'] == "OK") {
      if (isset($_POST['category_name']) && isset($_POST['catnb'])) {
        if (!empty($_POST['category_name']) && preg_match("/[a-zA-Z\d ]+/", $_POST['catnb'])
          && strlen($_POST['category_name']) <= 255
          && ($_POST['catnb'] == '1' || $_POST['catnb'] == '2')) {
          if (db_insert_cat($_POST['category_name'], $_POST['catnb']))
            $_SESSION['catcreate_msg'] = "'".$_POST['category_name']."' has been correctly created on channel '".$_POST['catnb']."'.";
          else
            $_SESSION['catcreate_msg'] = "Category name: '".$_POST['category_name']."' already exists.";
        } else {
            $_SESSION['catcreate_msg'] = "One or more field(s) are not correctly formatted.";
        }
      }
    } else if (isset($_POST['remove_cat'])) {
      $a = explode("_", $_POST['remove_cat']);
      if (count($a) != 2)
        return ;
      if (db_isempty_cat($a[0], $a[1])) {
        if (db_remove_cat($a[0], $a[1]))
          $_SESSION['catcreate_msg'] = "'".$a[0]."' on channel '".$a[1]."' has been deleted with success.";
        else
          $_SESSION['catcreate_msg'] = "Can't delete'".$a[0]."' on channel '".$a[1]."': name or channel doesn't exist.";
      } else
        $_SESSION['catcreate_msg'] = "Can't delete'".$a[0]."' on channel '".$a[1]."': you can't delete an non-empty category.";
    } else if (isset($_POST['edit_cat'])) {
      $a = explode("_", $_POST['edit_cat']);
      if (count($a) != 2)
        return ;
      $newname = $_POST[$_POST['edit_cat']] ?? "";
      if ($newname != $a[0]) {
        if (empty($newname)) {
          $_SESSION['catcreate_msg'] = "Can't replace '".$a[0]."' by an empty name.";
        } else if (db_update_cat_name($a[0], $a[1], $newname))
          $_SESSION['catcreate_msg'] = "'".$a[0]."' has been correctly renamed by '".$newname."'.";
      }
    }
  }

  if (isset($_SESSION['page'])) {
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 'manage rights')
        $_SESSION['page'] = "admin_users.php";
      else if ($_GET['page'] == 'manage products')
        $_SESSION['page'] = "admin_article.php";
      else if ($_GET['page'] == 'manage categories')
        $_SESSION['page'] = "admin_cat.php";
      else if ($_GET['page'] == 'view orders')
        $_SESSION['page'] = "admin_orders.php";
    }
  } else
    $_SESSION['page'] = "admin_default.php";
  check_cat_mgr_request();
  check_usr_mgr_request();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="admin_page.css">
    <title>Admin</title>
  </head>
  <body>
    <table class="admin_mainframe">
      <tr class="">
        <div class="admin_banner">
          <h1>Admin_page</h1>
        </div>
      </tr>
      <tr>
        <td class="leftmenu">
          <form action='admin_page.php' method="get">
            <input type='submit' name='page' value='manage rights'><br>
            <input type='submit' name='page' value='manage products'><br>
            <input type='submit' name='page' value='manage categories'><br>
            <input type='submit' name='page' value='view orders'><br>
          </form>
        </td>
        <td>
          <div class="mainframe">
            <?php
              if (isset($_SESSION["page"]))
                require($_SESSION["page"]);
              else
                require('admin_default.php');
           ?>
         </div>
        </td>
      </tr>
    </table>
  </body>
</html>
