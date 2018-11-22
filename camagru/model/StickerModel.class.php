<?PHP
  require_once("Model.class.php");
  class StickerModel extends Model
  {
      public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
      {
          parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
      }

      public function getStickers($url)
      {
        $url = htmlspecialchars($url);
        if ($url != "")
        {
          $req = $this->_db->prepare('SELECT `id_sticker`, `path` FROM `stickers` ORDER BY `id_sticker` DESC');
          $res = $req->execute();
          $res = $req->fetchAll(PDO::FETCH_ASSOC);
          $match = [];
          preg_match("/^http(.)*(?=\/index.php)/", $url, $match);
          if (isset($match[0]))
            $url = $match[0];
          ob_start();
          foreach ($res as $key => $value)
          {
            echo $this->createSticker($value['id_sticker'], $url . "/" . $value['path']);
          }
          $stickers = ob_get_contents();
          ob_clean();
          return ($stickers);
        }
      }

      public function createSticker($id_sticker, $path)
      {
        $id_sticker = htmlspecialchars($id_sticker);
        $path = htmlspecialchars($path);
        if ($id_sticker != "" && $path != "")
          return '<img class="stk" id="' . $id_sticker .'" src="' . $path . '" draggable="true" ondragstart="drag(event)"></img>';
      }

      public function addSticker()
      {

      }
  }
