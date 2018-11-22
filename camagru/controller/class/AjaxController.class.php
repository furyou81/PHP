<?PHP
    require_once("Controller.class.php");
    require_once("model/LikeModel.class.php");
    require_once("model/CommentModel.class.php");
    require_once("model/GalleryModel.class.php");
    require_once("model/PicModel.class.php");

    class AjaxController extends Controller
    {
      private $_like_model;
      private $_comment_model;
      private $_gallery_model;
      private $_pic_model;

        public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
        {
            parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
            $this->_like_model = new LikeModel($DB_DSN, $DB_USER, $DB_PASSWORD);
            $this->_comment_model = new CommentModel($DB_DSN, $DB_USER, $DB_PASSWORD);
            $this->_gallery_model = new GalleryModel($DB_DSN, $DB_USER, $DB_PASSWORD);
            $this->_pic_model = new PicModel($DB_DSN, $DB_USER, $DB_PASSWORD);
        }

        public function req_ajax_user_connect($login_connect, $psw_connect)
        {
            $connection_res = $this->_user->userConnect($login_connect,  $psw_connect);
            echo $connection_res;
        }

        public function req_ajax_upload($to_save, $session_login, $session_id, $title, $stickers)
        {
          $to_save = str_replace(" ", "+", $to_save);
          require_once('controller/upload.php');
        }

        public function req_ajax_check_login($login_to_check)
        {
          if ($this->_user->checkLoginUsed($login_to_check))
            echo "This login is already in use, please choose an other login.";
        }

        public function req_ajax_check_email($email_to_check)
        {
          if ($this->_user->checkEmailUsed($email_to_check))
            echo "This email is already in use, please choose an other email.";
        }

        public function req_ajax_check_password($password_to_check, $session_login)
        {
          if ($this->_user->userConnect($session_login, $password_to_check) != "Connection success.")
            echo "Wrong password, please check again.";
        }

        public function req_ajax_update_user_info($session_login, $old_password, $login_update, $email_update, $password_update, $notif_update)
        {
          $err_mess = "";
          if ($email_update != "")
            if (!filter_var($email_update, FILTER_VALIDATE_EMAIL))
                $err_mess .= "Wrong email format.";
          
          
          if ($password_update != "") {
            if (preg_match("/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/", $password_update) == 0)
            $err_mess .= "Wrong password format.";
            $password_update = password_hash($password_update, PASSWORD_BCRYPT);
          }
          if ($err_mess == "")
          {
            echo $this->_user->update_user_info($session_login, $old_password, $login_update, $email_update, $password_update, $notif_update);
            //echo "Info updated successfully.";
          }
          else
            echo $err_mess;
        }

        public function req_ajax_like($id_pic_like, $id_user_like)
        {
          $this->_like_model->like($id_pic_like, $id_user_like);
          echo $this->_like_model->nb_likes($id_pic_like);
        }

        public function req_ajax_comment($id_pic_comment, $id_user_comment, $new_comment)
        {
          $this->_comment_model->comment($id_pic_comment, $id_user_comment, $new_comment);
          $ret = $this->_pic_model->get_id_user($id_pic_comment);
          echo "ID" . $ret;
          $notif = $this->_user->get_notif($id_pic_comment);
          echo "notif" . $notif . "user" . $id_user_comment;
          if ($ret != 0 && $ret != $id_user_comment && $notif == 1)
          {
            $email = $this->_user->get_email_by_id($ret);
            echo "M" . $email;
            if ($email !== 0)
            {
              $subject = "Notification: someone commented one of your photo";
              $headers = "From: camagru.com";
              $message = "Hi,\n\n someone commented one of your photo, you can check it on Camagru: "
                        . "http://localhost:8080" . dirname($_SERVER["PHP_SELF"]) . "?page=details_pic&id_pic=" . $id_pic_comment;
              echo $email . "EMAIL";
              mail($email, $subject, $message, $headers);
            }
          }
        }

        public function req_ajax_page($page)
        {
          header('Content-type:application/json;charset=utf-8');
          echo json_encode($this->_gallery_model->get_pics($page, "6", "all"));
        }

        public function req_ajax_nb_like($id_pic_nb_like)
        {
          echo $this->_like_model->nb_likes($id_pic_nb_like);
        }

        public function req_ajax_reset_pas($login)
        {
          $reset_key = bin2hex(random_bytes(32));
          $this->_user->add_reset_key($reset_key, $login);
          $email = $this->_user->get_email($login);
          if ($email !== 0)
          {
            $subject = "Resset passord";
            $headers = "From: camagru.com";
            $message = "Hi, ". $login .",\n\n to reset your password, please click on the link below:\n http://localhost:8080" . $_SERVER["PHP_SELF"] . "?reset_key="
                    . $reset_key . "&reset_login=" . $login;
            mail($email, $subject, $message, $headers);
            echo "Please check your mailbox, we have just sent you an email.";
          }
            echo "An error has occured please try again later.";
        }

        public function req_ajax_update_pas($login_update_pas, $new_pas)
        {
          $err_mess = "";
          if (!preg_match("/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/", $new_pas))
            $err_mess .= "Wrong password format.";
          if ($err_mess == "")
          {
            $this->_user->update_pas($login_update_pas, $new_pas);
            echo "Password updated successfully.";
          }
          else
            echo $err_mess;
        }

        public function req_ajax_delete_pic($id_user, $id_pic)
        {
          $this->_pic_model->delete_pic($id_pic, $id_user);
          echo $this->_gallery_model->get_nb_pic();
        }
    }
?>
