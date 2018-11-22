<?PHP
  require_once("model/PicModel.class.php");
  require('config/database.php');

  $stickers = json_decode($stickers, true);
  $pic_model = new PicModel($DB_DSN, $DB_USER, $DB_PASSWORD);
  $type = [];
  //imagecreatefromstring()
  if (preg_match('/^data:image\/(\w+);base64,/', $to_save, $type)) {
    $to_save = substr($to_save, strpos($to_save, ',') + 1);
    $type = strtolower($type[1]); // jpg, png, gif, jpeg, bmp

    if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png', 'bmp' ])) {
        throw new \Exception('invalid image type');
    }
    $to_save = base64_decode($to_save);
    if ($to_save === false) {
        throw new \Exception('base64_decode failed');
    }
    if (!file_exists("pics"))
      mkdir("pics", 0777);
    if (!file_exists("pics/" . $session_login))
      mkdir("pics/" . $session_login);

    $id_pic = $pic_model->getIDPic($title, $session_id);

    $path = "pics/" . $session_login . "/" . $id_pic . ".{$type}";
    file_put_contents($path, $to_save);
    $pic_model->addPic($id_pic, $path);

    foreach ($stickers as $key => $value)
    {
      if ($value != null)
      {
      $dest = imagecreatefrompng($path);
      $src = imagecreatefrompng($value["src"]);
      $src_width = imagesx($src);
      $src_height = imagesy($src);
      $new_width = $value["width"];
      $new_height = ($value["width"] / $src_width) * $src_height;
      $resized_img = imagecreatetruecolor($new_width, $new_height);

      imagealphablending($resized_img, false);
      imagesavealpha($resized_img,true);
      $transparent = imagecolorallocatealpha($resized_img, 255, 255, 255, 127);
      imagefilledrectangle($resized_img, 0, 0, $new_width, $new_height, $transparent);
      imagecopyresampled($resized_img, $src, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);
      imagecopy($dest, $resized_img, $value["posX"], $value["posY"], 0, 0, $new_width, $new_height);
      imagealphablending($dest, false);
      imagesavealpha($dest,true);
      imagedestroy($src);
      imagedestroy($resized_img);
      imagepng($dest, $path);
      imagedestroy($dest);
    }
    }
    echo $path;
} else {
    throw new \Exception('did not match data URI with image data');
}
