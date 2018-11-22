<?PHP
    require_once("Controller.class.php");
    require_once("model/StickerModel.class.php");
    require_once("model/GalleryModel.class.php");
    require_once("model/LikeModel.class.php");
    require_once("model/CommentModel.class.php");

    class PageController extends Controller
    {
      private $_sticker_model;
      private $_gallery_model;

      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
          $this->_sticker_model = new StickerModel($DB_DSN, $DB_USER, $DB_PASSWORD);
          $this->_gallery_model = new GalleryModel($DB_DSN, $DB_USER, $DB_PASSWORD);
          $this->_like_model = new LikeModel($DB_DSN, $DB_USER, $DB_PASSWORD);
          $this->_comment_model = new CommentModel($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

        function display_head($title, $css)
        {
            require("view/head.php");
        }

        function display_header($header_connect_status, $url_take_a_pic, $url_gallery, $url_add_user, $url_ajax_user_connect, $url_my_account, $url_ajax_check_login, $url_ajax_reset_pas)
        {
            require("view/header/header.php");
        }
        
        function display_gallery($session_login, $session_id, $url_ajax_like, $url_details_pic, $url_ajax_page, $url_ajax_nb_like, $url_ajax_delete_pic)
        {
            $gallery = $this->_gallery_model->get_pics("1", "6", "all");

            $i = 0;
            ob_start();
            foreach ($gallery as $key => $value)
            {
              if (($i % 3) == 0 && $i != 0)
                echo '</div>';
              if (($i % 3) == 0)
                echo '<div class="row justify-content-center torem">';
              echo $this->_gallery_model->pic_format($value['id_user'], $value['id_pic'], $value['date'], $value['title'], $value['path'], $value['login'], $url_details_pic);
              $i++;
            }
              echo '</div>';
            $gal = ob_get_clean();
            $nb_pics = $this->_gallery_model->get_nb_pic();
            require_once("view/gallery/main_gallery.php");
        }

        function display_take_a_pic($url_ajax_upload, $url, $url_details_pic, $url_ajax_delete_pic)
        {
            if (isset($_SESSION['login']))
            {
              if ($_SESSION['login'] != "")
              {
                $login = $_SESSION['login'];
                $id = $_SESSION['id_user'];
                $stickers = $this->_sticker_model->getStickers($url);
                $user_pictures = $this->_gallery_model->get_pics("1", "100", $id);
                $i = 0;
                ob_start();
                  foreach ($user_pictures as $key => $value)
                  {
                    echo '<div id="pic_' . $value['id_pic'] . '">';
                    echo $this->_gallery_model->pic_format_user($value['id_user'], $value['id_pic'], $value['date'], $value['title'], $value['path'], $value['login'], $url_details_pic);
                    echo '</div>';
                    $i++;
                  }
                  
                $u_pics = ob_get_clean();

                require_once("view/take_a_pic/take_a_pic.php");
              }
              else
                require_once("view/take_a_pic/not_logged.php");
            }
            else
                require_once("view/take_a_pic/not_logged.php");
        }

        function display_add_user()
        {
            require_once("controller/addUser.php");
        }


        public function user_disconnect()
        {
            $this->_user->userDisconnect();
        }

        public function account_validation($validation_key, $login)
        {
            $validation_message = $this->_user->validate_account($validation_key, $login);
            require_once("view/user/validation_account.php");
        }

        public function reset_password($reset_key, $login, $url_ajax_update_pas)
        {
            $error_mes = "";
            if ($this->_user->check_reset_key($reset_key, $login) === 0)
              $error_mes = "Wrong link.";
            
            require_once("view/user/reset_pas.php");
        }

        public function display_my_account($login, $url_ajax_update_user_info, $url_ajax_check_login, $url_ajax_check_email, $url_ajax_check_password)
        {
          if ($login != "")
          {
            $user_info = $this->_user->getUserInfo($login);
            if ($user_info)
            {
              if ($user_info['notif'] == 1)
              {
                $send = "checked";
                $dont_send = "";
              }
              else
              {
                $send = "";
                $dont_send = "checked";
              }
              require_once("view/user/my_account.php");
            }
            else
              require_once("view/take_a_pic/not_logged.php");
          }
          else
            require_once("view/take_a_pic/not_logged.php");
        }

        public function display_details_pic($current_pic, $session_login, $session_id, $url_ajax_like, $url_ajax_comment)
        {
          $pic = $this->_gallery_model->get_pic($current_pic);
          $nb_likes = $this->_like_model->nb_likes($current_pic);
          $comments = $this->_comment_model->get_comments($current_pic);
          ob_start();
          foreach ($comments as $key => $value)
            echo $this->_comment_model->comment_format($value['login'], $value['com'], $value['id_comment'], $value['date']);
          $comments = ob_get_clean();
          if (isset($pic[0]))
            require_once("view/gallery/one_pic.php");
        }

        function display_footer()
        {
            require("view/footer.php");
        }
    }
?>
