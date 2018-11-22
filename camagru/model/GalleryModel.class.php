<?PHP
  require_once("Model.class.php");
  require_once("model/LikeModel.class.php");

  class GalleryModel extends Model
  {
      private $_like_model;

      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
          $this->_like_model = new LikeModel($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

      public function get_pics($nb_page, $nb_to_display, $user)
      {
        $nb_page = htmlspecialchars($nb_page);
        $nb_to_display = htmlspecialchars($nb_to_display);
        $user = htmlspecialchars($user);
        if ($nb_page != "" && $nb_to_display != "" && $user != "")
        {
          if ($user == "all")
          {
            
            $offset = $nb_to_display * ($nb_page - 1);
          //  echo "XXXXX" . $offset . "C" . $nb_to_display . "F";
            if ($offset >= 0) {
              $req = $this->_db->prepare('SELECT pics.id_pic, pics.date, pics.title, pics.path, users.login, users.id_user FROM `pics` LEFT JOIN `users` ON pics.id_user = users.id_user ORDER BY pics.date DESC LIMIT :p,:n');
              $req->bindValue(':p', (int) $offset, PDO::PARAM_INT);
              $req->bindValue(':n', (int) $nb_to_display, PDO::PARAM_INT);
              $req->execute();
              $res = $req->fetchAll(PDO::FETCH_ASSOC);
              return ($res);
            }
          }
          else
          {
            $req = $this->_db->prepare('SELECT pics.id_pic, pics.date, pics.title, pics.path, users.login, users.id_user FROM `pics` LEFT JOIN `users` ON pics.id_user = users.id_user WHERE pics.id_user = :i ORDER BY pics.date DESC');
            $req->bindValue(':i', (int) $user, PDO::PARAM_INT);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            return ($res);
          }
        }
      }

      public function get_pic($id_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        if ($id_pic != "")
        {
          $req = $this->_db->prepare('SELECT pics.id_pic, pics.date, pics.title, pics.path, users.login, users.id_user FROM `pics` LEFT JOIN `users` ON pics.id_user = users.id_user WHERE pics.id_pic = :i');
          $req->bindParam(':i', $id_pic);
          $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          return ($res);
        }
      }

      public function pic_format($id_user_pic, $id_pic, $date, $title, $path, $login, $url_details_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        $date = htmlspecialchars($date);
        $title = htmlspecialchars($title);
        $path = htmlspecialchars($path);
        $login = htmlspecialchars($login);
        $url_details_pic = htmlspecialchars($url_details_pic);
        ob_start();
        echo '<div class="card col-md-3 translucid" id="del' . $id_pic . '">';
        echo '<a href="' . $url_details_pic . "&id_pic=" . $id_pic . '"><img class="card-img-top click_photo" id="p' . $id_pic .'" src="' . $path .'" alt="Card image cap";"/></a>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $title . '</h5>';
        echo '<p class="card-text"><span id="n' . $id_pic .'">' . $this->_like_model->nb_likes($id_pic) . '</span> likes <img id="l' . $id_pic .'"class="thumb"src="img/thumb_up.png" title="thumb_up" alt="thumb_up" onclick="like(this);"></img></p>';
        $ses = $_SESSION['id_user'] ?? "";
        if ($ses == $id_user_pic)
          echo '<a class="pointer" id=d' . $id_pic . ' onclick="delete_pic(this);">delete post</a>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<small class="text-muted">Picture added by <b>' . $login . "</b> on " . $date . '</small>';
        echo '</div>';
        echo '</div>';
        $pics = ob_get_clean();
        return ($pics);
      }

      public function pic_format_user($id_user_pic, $id_pic, $date, $title, $path, $login, $url_details_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        $date = htmlspecialchars($date);
        $title = htmlspecialchars($title);
        $path = htmlspecialchars($path);
        $login = htmlspecialchars($login);
        $url_details_pic = htmlspecialchars($url_details_pic);
        ob_start();
        
        echo '<a href="' . $url_details_pic . "&id_pic=" . $id_pic . '"><img class="card-img-top click_photo" id="p' . $id_pic .'" src="' . $path .'" alt="Card image cap";"/></a>';
        echo '<div class="card-body">';
        $ses = $_SESSION['id_user'] ?? "";
        if ($ses == $id_user_pic)
          echo '<a class="pointer" id=d' . $id_pic . ' onclick="delete_pic(this);">delete post</a>';
        echo '</div>';
        
        $pics = ob_get_clean();
        return ($pics);
      }

      public function get_nb_pic()
      {
        $req = $this->_db->prepare('SELECT COUNT(id_pic) as nb_pics FROM `pics`');
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        if (isset($res[0]))
          return ($res[0]['nb_pics']);
        else
          return (0);
      }
  }
