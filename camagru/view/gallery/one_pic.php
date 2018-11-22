<style>
main {color: #fff; font-family: 'Pangolin', cursive;}
  .top_mar {margin-top: 3vw;}
  .thumb {width: 2em; vertical-align: top; display: inline-block; margin-top: -0.5em; cursor:pointer;}
  #pic_display { position: relative; background-color: black;}
  #comment_display {}
    .comment_date {font-size: 0.8em;}
  #title_pic {position: absolute; top: 0; margin-right: auto; margin-left: auto; width: 90%; text-align: center; padding: 2vw;
    color: white;
    font-size: 5vw;
    -webkit-text-stroke-width: 0.2vw;
    -webkit-text-stroke-color: #000;}
    .comment {margin-top: 1.5vw; color: #21263A; width: 75%; margin-left: auto; margin-right: auto; border-radius: 1vw; padding: 1vw;}
    .translucid {background-color: rgba(255, 255, 255, 0.8);}
    #add_a_comment {width: 75%; margin-left: auto; margin-right: auto; margin-top: 1.5vw; margin-bottom: 1.5vw;background-color: rgba(255, 255, 0, 0.8); }
    #new_comment {width: 100%; padding: 1vw;}
</style>

  <main>
    <div class="row justify-content-center top_mar">
      <div class="col-10" id="pic_display">
        <img src="<?= $pic[0]['path'] ?>" class="col-12"/>
        <p id="title_pic"> <?= $pic[0]['title'] ?> </p>
      </div>
    </div>
    <div class="row justify-content-center top_mar">
      <div class="col-3" id="comment_display">
        <p class="card-text"><?= $pic[0]['login'] ?>: <span id="n<?= $pic[0]['id_pic'] ?>"> <?= $nb_likes ?></span> likes <img id="l<?= $pic[0]['id_pic'] ?>"class="thumb"src="img/thumb_up.png" title="thumb_up" alt="thumb_up" onclick="like(this);"></img></p>
      </div>
    </div>
    <div id="ccc">
    <?= $comments ?>
    </div>
    <div id="add_a_comment">
      <textarea id="new_comment" class="translucid" rows="4" maxlength="255" placeholder="To add a comment, please write it right here then press enter." onkeyup="send_comment(event);"></textarea>
    </div>
  </main>


  <script>
    function like(t)
    {
      var id_photo = t.id.substr(1);
      
      if ("<?= $_SESSION['login'] ?>" == "")
      {
        var x = document.getElementById("snackbar");
        x.innerHTML = "You must be logged to like a photo.";
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
      else
      {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("n" + id_photo).innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "<?= $url_ajax_like ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id_pic_like=" + id_photo + "&id_user_like=" + "<?= $_SESSION['id_user'] ?>");
      }
    }

    function send_comment(ev)
    {
      if (ev.keyCode == 13)
      {
        if ("<?= $_SESSION['login'] ?>" == "")
        {
          var x = document.getElementById("snackbar");
          x.innerHTML = "You must be logged to comment a photo.";
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
        else
        {
        var new_comment = document.getElementById("new_comment").value.trim();
        document.getElementById("new_comment").value = "";
        if (new_comment != "")
        {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var newDiv = document.createElement("div");
            newDiv.setAttribute("class", "comment translucid");
            var newh5 = document.createElement("h5");
            newh5.innerHTML = "<?= $session_login ?>";
            var newp1 = document.createElement("p");
            newp1.setAttribute("class", "comment_txt");
            var text = document.createTextNode(new_comment);
            newp1.appendChild(text);
            var newp2 = document.createElement("p");
            newp2.setAttribute("class", "comment_date");
            var d = new Date();
            newp2.innerHTML = "on " + d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
            newDiv.appendChild(newh5);
            newDiv.appendChild(newp1);
            newDiv.appendChild(newp2);
            document.getElementById("ccc").appendChild(newDiv);
              }
          };
          xhttp.open("POST", "<?= $url_ajax_comment ?>", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("id_pic_comment=" + <?= $pic[0]['id_pic'] ?> + "&id_user_comment=" + <?= $session_id ?> + "&new_comment=" + new_comment);
        }
        }
      }
    }
  </script>
