<?PHP
  require_once("Model.class.php");
  class PicModel extends Model
  {
      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

      public function getIDPic($title, $session_id)
      {
        $title = htmlspecialchars($title);
        $session_id = htmlspecialchars($session_id);
        if ($title != "" && $session_id != "")
        {
          $req = $this->_db->prepare('INSERT INTO `pics` (`id_pic`, `date`, `title`, `path`, `id_user`, `likes`) VALUES
                  (NULL, NOW(), :t, "", :i, 0)');
          $req->bindParam(':t', $title);
          $req->bindParam(':i', $session_id);
          $res = $req->execute();
          return ($this->_db->lastInsertId());
        }
          return (0);
      }

      public function addPic($id_pic, $path)
      {
        $id_pic = htmlspecialchars($id_pic);
        $path = htmlspecialchars($path);
          if ($id_pic != "" && $path != "")
          {
            $req = $this->_db->prepare('UPDATE `pics` SET `path` = :p WHERE `id_pic` = :i');
            $req->bindParam(':p', $path);
            $req->bindParam(':i', $id_pic);
            $res = $req->execute();
          }
      }

      public function get_id_user($id_pic)
      {
        $id_pic = htmlspecialchars($id_pic);
        if ($id_pic != "")
        {
          $req = $this->_db->prepare('SELECT id_user FROM `pics` WHERE `id_pic` = :p');
          $req->bindParam(':p', $id_pic);
          $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          if (isset($res[0]))
            return ($res[0]['id_user']);
          else
            return (0);
        }
      }

      public function delete_pic($id_pic, $id_user)
      {
        $id_pic = htmlspecialchars($id_pic);
        if ($id_pic != "" && $id_user != "")
        {
          $req = $this->_db->prepare("SELECT `path` FROM `pics` WHERE `id_pic` = :p");
          $req->bindParam(':p', $id_pic);
          $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          if (isset($res[0])) {
            $to_del = realpath($res[0]["path"]);
            if (is_writable($to_del)) {
              unlink($to_del);
              $req = $this->_db->prepare("DELETE FROM `pics` WHERE `id_pic` = :p AND `id_user` = :u");
            $req->bindParam(':p', $id_pic);
            $req->bindParam(':u', $id_user);
            $req->execute();
            }
          }
        }
      }
}
