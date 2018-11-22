<?PHP
  require_once("Model.class.php");
  class CommentModel extends Model
  {
      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

      public function comment($id_pic_comment, $id_user_comment, $new_comment)
      {
        $id_pic_comment = htmlspecialchars($id_pic_comment);
        $id_user_comment = htmlspecialchars($id_user_comment);
        $new_comment = htmlspecialchars($new_comment);
        if ($id_pic_comment != "" && $id_user_comment != "" && $new_comment != "")
        {
            $req = $this->_db->prepare('INSERT INTO `comments` (`id_comment`, `id_pic`, `com`, `date`, `id_user`) VALUES (NULL, :p, :c, NOW(), :u)');
            $req->bindParam(':p', $id_pic_comment);
            $req->bindParam(':c', $new_comment);
            $req->bindParam(':u', $id_user_comment);
            $res = $req->execute();
        }
      }

      public function get_comments($id_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        if ($id_pic != "")
        {
          $req = $this->_db->prepare('SELECT comments.id_comment, comments.com, comments.date, comments.id_user, users.login  FROM `comments` LEFT JOIN `users` on comments.id_user = users.id_user WHERE comments.id_pic = :p');
          $req->bindParam(':p', $id_pic);
          $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          return ($res);
        }
      }

      public function comment_format($id_user, $cmt, $id_cmt, $date_cmt)
      {
        $id_user = htmlspecialchars($id_user);
        $cmt = htmlspecialchars($cmt);
        $id_cmt = htmlspecialchars($id_cmt);
        $date_cmt = htmlspecialchars($date_cmt);
        ob_start();
        echo '<div class="comment translucid">';
        echo '<h5>' . $id_user . ': </h5>';
        echo '<p class="comment_txt" id="c' . $id_cmt .'">' . $cmt . '</p>';
        echo '<p class="comment_date"> on ' . $date_cmt . '</p>';
        echo '</div>';
        $comment = ob_get_clean();
        return ($comment);
      }
  }
