   <?PHP 
        $setup = realpath('./config/setup.php');
      
          if (is_writable($setup))
            require_once('./config/setup.php');

    session_start();
    $_SESSION['login'] = $_SESSION['login'] ?? "";
    $_SESSION['id_user'] = $_SESSION['id_user'] ?? "";
    require_once('./controller/class/PageController.class.php');
    require_once('./controller/class/AjaxController.class.php');
    require_once('./view/header/Header.class.php');
    require_once('config/database.php');
    $title = 'Camagru';
    $css = 'camagru.css';
    opcache_reset();
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $match = [];
        preg_match("/^[^?]+/", $url, $match);
        $url = $match[0];
        $url_take_a_pic = $url . "?page=take_a_pic";
        $url_gallery = $url . "?page=gallery";
        $url_add_user = $url . "?page=add_user";
        $url_my_account = $url . "?page=my_account";
        $url_ajax_update_user_info = $url . "?url_ajax=update_user_info";
        $url_details_pic = $url . "?page=details_pic";

        $url_ajax_user_connect  = $url . "?url_ajax=user_connect";
        $url_ajax_upload = $url . "?url_ajax=upload";
        $url_ajax_check_login  = $url . "?url_ajax=check_login";
        $url_ajax_check_email  = $url . "?url_ajax=check_email";
        $url_ajax_check_password  = $url . "?url_ajax=check_password";
        $url_ajax_like  = $url . "?url_ajax=like";
        $url_ajax_comment = $url . "?url_ajax=comment";
        $url_ajax_page = $url . "?url_ajax=page";
        $url_ajax_nb_like  = $url . "?url_ajax=nb_like";
        $url_ajax_reset_pas = $url . "?url_ajax=reset_pas";
        $url_ajax_update_pas = $url . "?url_ajax=update_pas";
        $url_ajax_delete_pic = $url . "?url_ajax=delete_pic";
        
    $current_page = $_GET['page'] ?? "";
    $url_ajax = $_GET['url_ajax'] ?? "";
    $action = $_GET['action'] ?? ""; 
    $validation_key = $_GET['validation_key'] ?? ""; 
    $validation_login = $_GET['validation_login'] ?? ""; 
    $reset_key = $_GET['reset_key'] ?? ""; 
    $reset_login = $_GET['reset_login'] ?? ""; 
    $current_pic = $_GET['id_pic'] ?? ""; 
    
        $session_login = $_SESSION['login'] ?? "";
        $session_id = $_SESSION['id_user'] ?? "";

        $rooter = new PageController($DB_DSN, $DB_USER, $DB_PASSWORD);
        $ajax = new AjaxController($DB_DSN, $DB_USER, $DB_PASSWORD);

      //  if ()
        if ($action == "user_disconnect")
        {
          if (isset($_SESSION['login']))
          {
            $_SESSION['login'] = "";
            $session_login = "";
            $_SESSION['id_user'] = "";
            $session_id = "";
            header('Location:' . $url);
          }
        }

        if ($url_ajax == "")
        {
            echo "<html>";
            $header = new Header();
            if ($session_login == "")
                $header_connect_status = $header->signButton();
            else
                $header_connect_status = $header->signedIn($session_login);
            $rooter->display_header($header_connect_status, $url_take_a_pic, $url_gallery, $url_add_user, $url_ajax_user_connect, $url_my_account, $url_ajax_check_login, $url_ajax_reset_pas);
            $rooter->display_head($title, $css);
            echo "<body>";
            if ($validation_key != "" && $validation_login != "")
            {
                $rooter->account_validation($validation_key, $validation_login);
            }
            else if ($reset_key != "" && $reset_login != "")
            {
              $rooter->reset_password($reset_key, $reset_login, $url_ajax_update_pas);
            }
            else
            {
                if ($current_page == "take_a_pic")
                  $rooter->display_take_a_pic($url_ajax_upload, $url, $url_details_pic, $url_ajax_delete_pic);
                else if ($current_page == "gallery")
                  $rooter->display_gallery($session_login, $session_id, $url_ajax_like, $url_details_pic, $url_ajax_page, $url_ajax_nb_like, $url_ajax_delete_pic);
                else if ($current_page == "add_user")
                  $rooter->display_add_user();
                else if ($current_page == "my_account")
                  $rooter->display_my_account($session_login, $url_ajax_update_user_info, $url_ajax_check_login, $url_ajax_check_email, $url_ajax_check_password);
                else if ($current_page == "details_pic" && $current_pic != "")
                    $rooter->display_details_pic($current_pic, $session_login, $session_id, $url_ajax_like, $url_ajax_comment);
                else if ($url_ajax == "")
                  $rooter->display_gallery($session_login, $session_id, $url_ajax_like, $url_details_pic, $url_ajax_page, $url_ajax_nb_like, $url_ajax_delete_pic);
            }
            echo "</body>";
            $rooter->display_footer();
            echo "</html>";
        }
        else if ($url_ajax != "")
        {
          if ($url_ajax == "user_connect")
          {
            $login_connect = $_POST['login_connect'] ?? "";
            $psw_connect = $_POST['psw_connect'] ?? "";
            $ajax->req_ajax_user_connect($login_connect, $psw_connect);
            $login_connect = "";
            $psw_connect = "";
          }
          else if ($url_ajax == "upload")
          {
            $title = $_POST['title'] ?? "";
            $to_save = $_POST['to_save'] ?? "";
            $stickers = $_POST['stickers'];
            if ($title != "" && $to_save != "")
              $ajax->req_ajax_upload($to_save, $session_login, $session_id, $title, $stickers);
          }
          else if ($url_ajax == "update_user_info")
          {
            $login_update = $_POST['login_update'] ?? "";
            $email_update = $_POST['email_update'] ?? "";
            $password_update = $_POST['password_update'] ?? "";
            $old_password = $_POST['old_password'] ?? "";
            $notif_update = $_POST['notif_update'] ?? "";
            //if ($password_update != "")
          //  {
            //  echo "IOUVEPOJWEGIRBORE " . $password_update . " ";
              //  $password_update = password_hash($password_update, PASSWORD_BCRYPT);
            //}
            $ajax->req_ajax_update_user_info($session_login, $old_password, $login_update, $email_update, $password_update, $notif_update);
          }
          else if ($url_ajax == "check_login")
          {
            $login_to_check = $_POST['login_to_check'] ?? "";
            $ajax->req_ajax_check_login($login_to_check);
          }
          else if ($url_ajax == "check_email")
          {
            $email_to_check = $_POST['email_to_check'] ?? "";
            $ajax->req_ajax_check_email($email_to_check);
          }
          else if ($url_ajax == "check_password")
          {
            $password_to_check = $_POST['password_to_check'] ?? "";
            $ajax->req_ajax_check_password($password_to_check, $session_login);
          }
          else if ($url_ajax == "like")
          {
            $id_pic_like = $_POST['id_pic_like'] ?? "";
            $id_user_like = $_POST['id_user_like'] ?? "";
            $ajax->req_ajax_like($id_pic_like, $id_user_like);
          }
          else if ($url_ajax == "comment")
          {
            $id_pic_comment = $_POST['id_pic_comment'] ?? "";
            $id_user_comment = $_POST['id_user_comment'] ?? "";
            $new_comment = $_POST['new_comment'] ?? "";
            $ajax->req_ajax_comment($id_pic_comment, $id_user_comment, $new_comment);
          }
          else if ($url_ajax == "page")
          {
            $page = $_POST['page'] ?? "";
            $ajax->req_ajax_page($page);
          }
          else if ($url_ajax == "nb_like")
          {
            $id_pic_nb_like = $_POST['id_pic_nb_like'] ?? "";
            $ajax->req_ajax_nb_like($id_pic_nb_like);
          }
          else if ($url_ajax == "reset_pas")
          {
            $login_to_reset = $_POST['login_to_reset'] ?? "";
            $ajax->req_ajax_reset_pas($login_to_reset);
          }
          else if ($url_ajax == "update_pas")
          {
            $login_update_pas = $_POST['login_update_pas'] ?? "";
            $new_pas = $_POST['new_pas'] ?? "";
            $ajax->req_ajax_update_pas($login_update_pas, $new_pas);
          }
          else if ($url_ajax == "delete_pic")
          {
            $id_user_pic_del = $_SESSION['id_user'] ?? "";
            $id_pic_to_del = $_POST['id_pic_to_del'] ?? "";
        //    echo $id_user_pic_del . "/" . $id_pic_to_del;
            if ($id_user_pic_del != "" && $id_pic_to_del != "")
              $ajax->req_ajax_delete_pic($id_user_pic_del, $id_pic_to_del);
          }
      }

