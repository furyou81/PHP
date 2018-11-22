<?PHP
  require_once("Model.class.php");
  class LikeModel extends Model
  {
      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

      public function like($id_pic_like, $id_user_like)
      {
        $id_pic_like = htmlspecialchars($id_pic_like);
        $id_user_like = htmlspecialchars($id_user_like);
        if ($id_pic_like != "" && $id_user_like != "")
        {
          $req = $this->_db->prepare('SELECT COUNT(likes.id_user) as `l` FROM `likes` WHERE `id_pic` = :p AND `id_user` = :u');
          $req->bindParam(':p', $id_pic_like);
          $req->bindParam(':u', $id_user_like);
          $res = $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          if (isset($res[0]))
          {
            if (isset($res[0]['l']))
            {
              if ($res[0]['l'] == 0)
              {
                $req = $this->_db->prepare('INSERT INTO `likes` (`id_user`, `id_pic`) VALUES (:u, :p)');
                $req->bindParam(':u', $id_user_like);
                $req->bindParam(':p', $id_pic_like);
                $res = $req->execute();
              }
              else
              {
                $req = $this->_db->prepare('DELETE FROM `likes` WHERE `id_pic` = :p AND `id_user` = :u');
                $req->bindParam(':p', $id_pic_like);
                $req->bindParam(':u', $id_user_like);
                $res = $req->execute();
              }
            }
          }
          else
          {

            $req = $this->_db->prepare('INSERT INTO `likes` (`id_user`, `id_pic`) VALUES (:u, :p)');
            $req->bindParam(':u', $id_user_like);
            $req->bindParam(':p', $id_pic_like);
            $res = $req->execute();
          }
        }
      }

      public function nb_likes($id_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        if ($id_pic != "")
        {
          $req = $this->_db->prepare('SELECT COUNT(likes.id_pic) as `l` FROM `likes` WHERE `id_pic` = :p');
          $req->bindParam(':p', $id_pic);
          $res = $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          if (isset($res[0]))
            return($res[0]['l']);
        }
      }
  }
