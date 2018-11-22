<style>
  .snap_display {width: 100%;}
  .img_display {width: 100%; border-radius: 10px; margin-top: 10px;}
  .zoom-in {cursor: zoom-in;}
  .zoom-out {cursor: zoom-out;}
  .mytop {margin-top: 1vw;}
  .card {margin: 1em; font-family: 'Pangolin', cursive;}
    .thumb {width: 2em; vertical-align: top; display: inline-block; margin-top: -0.5em; cursor:pointer;}
    .pointer {cursor: pointer; background-color: rgba(255, 0, 0, 0.5); border-radius: 5px; padding: 2px;}
    .click_photo:hover {transform: scale(1.2);}
    .translucid {background-color: rgba(255, 255, 255, 0.8);}

</style>

    <?PHP require_once("view/take_a_pic/section_top.php"); ?>
        <div class="d-flex justify-content-center mytop">
        <div>
    <?PHP
        require_once("view/take_a_pic/main_take_a_pic.php");
        require_once("view/take_a_pic/footer_take_a_pic.php");
        ?></div>
    <?PHP 
        require_once("view/take_a_pic/aside_take_a_pic.php");
    ?>
        </div>

<script>





  var novid = 0;
  var take = 1;
  var video = document.getElementById('video');
  var hidden_video = document.getElementById('video_hidden');
  var canvas = document.getElementById('canvas_tmp');
  var img_display = document.getElementById('img_display');
  var hidden_canvas = document.getElementById('canvas_hidden');
  var snapshot_display = document.getElementById('snapshot_display');
  var nb_stickers = 0;
  var ohvid;
  var owvid;
  var start_drag = 0;
  function add_sticker(id_sticker, posX, posY, width, height, src) {
    this.id_sticker = id_sticker;
    if (novid == 0)
    {
      this.posX = posX * hidden_video.offsetWidth / video.offsetWidth;
      this.posY = posY * hidden_video.offsetHeight / video.offsetHeight;
      this.width = width * hidden_video.offsetWidth / video.offsetWidth;
      this.height = height * hidden_video.offsetHeight / video.offsetHeight;
    }
    else
    {
      this.posX = posX * 960 / img_display.clientWidth;
      this.posY = posY * 960 / img_display.clientWidth;
      this.width = width * 960 / img_display.clientWidth;
      this.height = height * 960 / img_display.clientWidth;
    }
    this.src = src;
  }
  var id_sticker = 0;
  var posX = 0;
  var posY = 0;
  var width = 0;
  var height = 0;
  var src = "";
  var stickers = new Array()

  try {
  if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: {width: 960, height: 720} }).then(function(stream) {
          video.srcObject = stream;
          video.play();
          start_drag = 1;
      }, function(err) {
        novid = 1;
        start_drag = 0;
        var x = document.getElementById("snackbar");
        x.innerHTML = "No camera available but you can upload a picture.";
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      });

      navigator.mediaDevices.getUserMedia({ video: {width: 960, height: 720} }).then(function(stream) {
          hidden_video.srcObject = stream;
          hidden_video.play();
      }, function(err){});
  }
  else
  {
    var x = document.getElementById("snackbar");
    x.innerHTML = "No camera available but you can upload a picture.";
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }
  } catch (error) {
    var x = document.getElementById("snackbar");
    x.innerHTML = "No camera available but you can upload a picture.";
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

  }

  function nb_stick()
  {
    var nb = 0;
    stickers.forEach(function(element, index) {
      if (element != null)
      {
        nb++;
      }
    });
    return (nb);
  }

  function take_a_pic()
  {
    if (nb_stick() > 0)
    {
    if (take == 1 && novid == 0)
    {
      start_drag = 0;
      var width = video.offsetWidth;
      var height = video.offsetHeight;
      canvas.width = width;
      canvas.height = height;
      var context = canvas.getContext("2d");
      context.drawImage(video, 0, 0, width, height);

      canvas.style.width = video.clientWidth;
      canvas.style.height = video.clientHeight;
      canvas.setAttribute("style", "display:inline-block");

      var hidden_width = hidden_video.offsetWidth;
      var hidden_height = hidden_video.offsetHeight;
      hidden_canvas.width = hidden_width;
      hidden_canvas.height = hidden_height;
      var hidden_context = hidden_canvas.getContext("2d");

      hidden_context.drawImage(hidden_video, 0, 0, hidden_width, hidden_height);
      hidden_canvas.style.width = hidden_video.clientWidth;
      hidden_canvas.style.height = hidden_video.clientHeight;

      video.setAttribute("style", "visibility:hidden");
      document.getElementById('title_around').setAttribute("style", "display:block");
      document.getElementById('cancel').setAttribute("style", "display:block");
      take = 0;
    }
  }
  }



  function convertCanvasToImage(canvas)
  {
	     var image = new Image();
       image.src = canvas.toDataURL("image/png");
       return image;
  }

  function save_a_pic()
  {
    if (take == 0 && nb_stick() > 0)
    {
      start_drag = 1;
      var img = document.createElement('img');
      var title = document.getElementById('pic_title').value;
      if (title == "" || title == "Please put the title of the picture here.")
        title = "<?= $login ?>";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var newDiv = document.createElement("div");
            newDiv.setAttribute("class", "snap_display");
            var newImg = document.createElement("img");
            newImg.setAttribute("class", "img_display");
            newImg.src = this.responseText;
            newDiv.appendChild(newImg);
            snapshot_display.insertBefore(newDiv, snapshot_display.firstChild);
            }
        };
      xhttp.open("POST", "<?= $url_ajax_upload ?>", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var send = hidden_canvas.toDataURL('image/png');
      xhttp.send("to_save=" + send + "&title=" + title + "&stickers=" + JSON.stringify(stickers));
      canvas.setAttribute("style", "display:none");
      video.setAttribute("style", "display:inline-block");
      document.getElementById("asside").style.height = video.clientHeight;
      take = 1;
      document.getElementById('cancel').setAttribute("style", "display:none");
      document.getElementById('title_around').setAttribute("style", "display:none");
      img_display.setAttribute("style", "display:none");
      novid = 0;
    }
  }

  function cancel_pic()
  {
    canvas.setAttribute("style", "display:none");
    video.setAttribute("style", "display:inline-block");
    take = 1;
    document.getElementById('cancel').setAttribute("style", "display:none");
    document.getElementById('title_around').setAttribute("style", "display:none");
  }

  var dragImg = new Image(); // Il est conseillé de précharger l'image, sinon elle risque de ne pas s'afficher pendant le déplacement
  var dragX = 0;
  var dragY = 0;

  function allowDrop(ev) {
      ev.preventDefault();
      ev.dataTransfer.dropEffect = "move";
    dragX = ev.pageX;
    dragY = ev.pageY;
  }

  var t = 0;
  var l = 0;
  function drag(ev) {
    if (start_drag == 1)
    {
      owvid = video.offsetWidth;
      ohvid = video.offsetHeight;
      t = ev.offsetY;
      l = ev.offsetX;
      ev.dataTransfer.setData("text/plain", ev.target.id);
      id_sticker = ev.target.id;
    }
  }

  var tmpx = 0;
  var tmpy = 0;
  var id_resize = 3;

  var tt = null;

  function drop(ev) {
    tt = ev;
        if (ev.target.id == "foot_drop")
        {
          var data = ev.dataTransfer.getData("text");
          var sticker = document.getElementById(data);
          ev.target.appendChild(document.getElementById(data));
          sticker.style.position = "static";
          sticker.style.width = "10vw";
          rm_sticker(id_sticker);
        }
        else if (ev.target.id != "main_drop" && ev.target.id != "img_display")
        { 
          if (sticker) {
            var id_par = ev.target.parentElement.id;
            var data = ev.dataTransfer.getData("text");
            var sticker = document.getElementById(data);
            src = sticker.src;
            document.getElementById(id_par).appendChild(document.getElementById(data));
            var elm = document.getElementById('main_drop');
            var top = ev.pageY - elm.offsetTop;
            var left = ev.pageX - elm.offsetLeft;
            sticker.style.position= "absolute";
            posX = left - l;
            posY = top - t;
            sticker.style.left = posX + "px";
            sticker.style.top = posY + "px";
            width = document.getElementById(id_sticker).clientWidth;
            height = document.getElementById(id_sticker).clientHeight;
            src = sticker.src;
            update_info_stickers(id_sticker, posX, posY, width, height, src);
          }
        }
        else if (ev.target.id == "main_drop" || ev.target.id == "img_display")
        {
          ev.preventDefault();
          var data = ev.dataTransfer.getData("text");
          var sticker = document.getElementById(data);
          src = sticker.src;
          //ev.target.appendChild(document.getElementById(data));
          document.getElementById("main_drop").appendChild(document.getElementById(data));
          
          var top = ev.offsetY;
          var left = ev.offsetX;
          sticker.style.position= "absolute";
          posX = left - l;
          posY = top - t;
          sticker.style.left = posX + "px";
          sticker.style.top = posY + "px";
          width = sticker.clientWidth;
          height = sticker.clientHeight;
          src = sticker.src;
          update_info_stickers(id_sticker, posX, posY, width, height, src);
      }
  }

  function update_info_stickers(id_sticker, posX, posY, width, height, src)
  {
    var tocreate = 1;
    stickers.forEach(function(element, index) {
      if (element['id_sticker'] == id_sticker)
      {
        tocreate = 0;
        stickers[nb_stickers] = new add_sticker(id_sticker, posX, posY, width, height, src);
        stickers.splice(index, 1);
      }
    });
    if (tocreate == 1)
    {
      stickers[nb_stickers] = new add_sticker(id_sticker, posX, posY, width, height, src);
      nb_stickers++;
      tocreate = 0;
    }
  }

  function update_info_stickers_2(id_sticker, width, height)
  {
    var tocreate = 1;
    stickers.forEach(function(element, index) {
  if (element['id_sticker'] == id_sticker)
  {
    if (novid == 0)
    {
      stickers[index]['width'] = width * hidden_video.offsetWidth / video.offsetWidth;
      stickers[index]['height'] = height * hidden_video.offsetHeight / video.offsetHeight;
    }
    else
    {
      stickers[index]['width'] = width * 960 / img_display.clientWidth;
      stickers[index]['height'] = height * 960 / img_display.clientWidth;
    }
  }
});
}

function rm_sticker(id_sticker)
{
  stickers.forEach(function(element, index) {
    if (element['id_sticker'] == id_sticker)
    {
      stickers.splice(index, 1);
    }
  });
}

  function start_resize(ev)
  {
    tmpx = ev.offsetX;
    tmpy = ev.offsetY;
    id_resize = ev.target.id;
  }

  function zoom_in()
  {
    if (id_sticker != 0 && intab(id_sticker) == 1)
    {
      document.getElementById(id_sticker).style.width = document.getElementById(id_sticker).clientWidth + 25;
      width = document.getElementById(id_sticker).clientWidth;
      height = document.getElementById(id_sticker).clientHeight;
      update_info_stickers_2(id_sticker, width, height);
    }
  }

  function zoom_out()
  {
    if (id_sticker != 0  && intab(id_sticker) == 1)
    {
      document.getElementById(id_sticker).style.width = document.getElementById(id_sticker).clientWidth - 25;
      width = document.getElementById(id_sticker).clientWidth;
      height = document.getElementById(id_sticker).clientHeight;
      update_info_stickers_2(id_sticker, width, height);
    }
  }

function intab(id)
{
  var tmp = 0;
  stickers.forEach(function(element, index) {
    if (element['id_sticker'] == id)
    {
      tmp = 1;
    }
  });
  return (tmp);
}

  window.onresize = function (){
    document.getElementById("asside").style.height = video.clientHeight;
    document.getElementById("canvas_tmp").style.width = video.clientWidth;
    update_info_all_stickers();
  };

  function update_info_all_stickers()
  {
    stickers.forEach(function(element, index)
    {
      if (novid == 0)
      {
        document.getElementById(element['id_sticker']).style.left = stickers[index]['posX'] * video.offsetWidth / hidden_video.offsetWidth + "px";
        document.getElementById(element['id_sticker']).style.top = stickers[index]['posY'] * video.offsetHeight / hidden_video.offsetHeight + "px";
        document.getElementById(element['id_sticker']).style.width = stickers[index]['width'] * video.offsetWidth / hidden_video.offsetWidth + "px";
      }
      else
      {
        document.getElementById(element['id_sticker']).style.left = stickers[index]['posX'] * img_display.clientWidth / 960 + "px";
        document.getElementById(element['id_sticker']).style.top = stickers[index]['posY'] * img_display.clientHeight / hidden_canvas.height + "px";
        document.getElementById(element['id_sticker']).style.width = stickers[index]['width'] * img_display.clientWidth / 960 + "px";
      }
    });
  }

  var imageLoader = document.getElementById('imageLoader');
  imageLoader.addEventListener('change', handleImage, true);
  var ctx = canvas.getContext('2d');
  var ctx_hid = canvas_hidden.getContext('2d');

  function handleImage(e){
    novid = 1;
    take = 0;
    video.setAttribute("style", "display:none");
    img_display.setAttribute("style", "display:block");
    hidden_canvas.style.width = "960px";
    hidden_canvas.style.height = "720px";
    var reader = new FileReader();
    reader.onload = function(event){
        if(event.target.result.indexOf("data:image") >= 0){  
          var img = new Image();
          img.onload = function(){
              hidden_canvas.width = 960;
              hidden_canvas.height = img.height * 960 / img.width;
              ctx_hid.drawImage(img, 0, 0, 960, img.height * 960 / img.width);
              start_drag = 1;
          }
            img.src = event.target.result;
            img_display.src = event.target.result;
        }
    }
    reader.readAsDataURL(e.target.files[0]);
}
</script>
