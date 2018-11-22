<style>
    main {width: 100%; min-height: 600px; margin-top: 2em;}
    .card {margin: 1em; font-family: 'Pangolin', cursive;}
    .thumb {width: 2em; vertical-align: top; display: inline-block; margin-top: -0.5em; cursor:pointer;}
    .pointer {cursor: pointer; background-color: rgba(255, 0, 0, 0.5); border-radius: 5px; padding: 2px;}
    .click_photo:hover {transform: scale(1.2);}
    .translucid {background-color: rgba(255, 255, 255, 0.8);}
    #nav {margin-right: 5%;}
    
</style>

<main>
  <nav aria-label="Page navigation example" id="nav">
  <ul class="pagination justify-content-end" id="nav_page">

  </ul>
  </nav>
  <div id="ici">
    <?= $gal ?>
  </div>

</main>

<script>
  window.onload = update_nb_page(<?= $nb_pics ?>, 1);
  var c_p = 1;
  function like(t)
  {
    var id_photo = t.id.substr(1);
    var session_login = "<?= $session_login ?>";
    var session_id = "<?= $session_id ?>";

    if (session_login == "")
    {
      var x = document.getElementById("snackbar");
      x.innerText = "You must be logged to like a photo.";
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
      xhttp.send("id_pic_like=" + id_photo + "&id_user_like=" + session_id);
    }
  }

  function likeb(id)
  {
    var id_photo = id.substr(1);
    var session_login = "<?= $session_login ?>";
    var session_id = "<?= $session_id ?>";

    if (session_login == "")
    {
      var x = document.getElementById("snackbar");
      x.innerText = "You must be logged to like a photo.";
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
      xhttp.send("id_pic_like=" + id_photo + "&id_user_like=" + session_id);
    }
  }

  function update_nb_page(nb_pics, current_page)
  {
    nb_pics = parseInt(nb_pics);
    current_page = parseInt(current_page);
    var all_page = document.getElementById("nav_page");
    while (all_page.firstChild)
      all_page.removeChild(all_page.firstChild);
    var nb_pages = Math.ceil(nb_pics / 6);
    var start = parseInt(current_page) - 2;
    if (start <= 0)
      start = 1;
    var end = parseInt(current_page) + 2;
    if (end > nb_pages)
      end = nb_pages;
    var newli = document.createElement("li");
    var newa = document.createElement("a");
    newa.setAttribute("class", "page-link");
    if (current_page - 1 <= 0)
      newli.setAttribute("class", "page-item disabled");
    else
    {
      newli.setAttribute("class", "page-item");
      newa.setAttribute("id", "p" + current_page - 1);
    }
    newa.onclick = function() {
      var tmp = parseInt(current_page) - 1;
      var t = "p" + tmp;
      go_to_page(t);
    };
    newa.innerHTML = "Previous";
    newli.appendChild(newa);
    document.getElementById("nav_page").appendChild(newli);
    while (start <= end)
    {

      var newli = document.createElement("li");
      if (start == current_page)
        newli.setAttribute("class", "page-item active");
      else
        newli.setAttribute("class", "page-item");
      var newa = document.createElement("a");
      newa.setAttribute("class", "page-link");
      newa.setAttribute("id", "p" + start);
      newa.onclick = function() {
        go_to_page(this.id);
      };

      newa.innerHTML = start;
      newli.appendChild(newa);
      start++;
      document.getElementById("nav_page").appendChild(newli);
    }
    var newli = document.createElement("li");

    var newa = document.createElement("a");
    newa.setAttribute("class", "page-link");
    if (current_page + 1 > nb_pages)
      newli.setAttribute("class", "page-item disabled");
    else
    {
      newli.setAttribute("class", "page-item");
      newa.setAttribute("id", "p" + start);
    }
    newa.onclick = function() {
      var tmp = parseInt(current_page) + 1;
      var t = "p" + tmp;
      go_to_page(t);
    };
    newa.innerText = "Next";
    newli.appendChild(newa);
    all_page.appendChild(newli);
  }

  function go_to_page(id)
  {
    var page = id.substr(1);
    c_p = page;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var torem = document.getElementsByClassName('torem');
      var i = -1;
      var l = torem.length;
      while (++i < l)
        torem[0].remove();

        var gal = JSON.parse(this.responseText);
        var count = 0;
        var newdiv1;
        if (gal != null)
        gal.forEach(element =>
        {
          if (count % 3 == 0)
          {
            newdiv1 = document.createElement("div");
            newdiv1.setAttribute("class", "row justify-content-center torem");
          }
          var newdiv2 = document.createElement("div");
          newdiv2.setAttribute("class", "card col-md-3 translucid");
          newdiv2.setAttribute("id", "del" + element.id_pic);
          var newa = document.createElement("a");
          newa.href = "<?= $url_details_pic ?>" + "&id_pic=" + element.id_pic;
          var newimg = document.createElement("img");
          newimg.setAttribute("class", "card-img-top click_photo");
          newimg.setAttribute("id", "g" + element.id_pic);
          newimg.src = element.path;
          newa.appendChild(newimg);
          newdiv2.appendChild(newa);
          var newdiv3 = document.createElement("div");
          newdiv3.setAttribute("class", "card-body");
          var newh5 = document.createElement("h5");
          newh5.setAttribute("class", "card-title");
          newh5.innerHTML = element.title;
          newdiv3.appendChild(newh5);
          var newp = document.createElement("p");
          newp.setAttribute("class", "card-text");

          var newspan = document.createElement("span");
          newspan.setAttribute("id", "n" + element.id_pic);
          var xhttp2 = new XMLHttpRequest();
          xhttp2.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              newspan.innerHTML = this.responseText;
              }
          };
          xhttp2.open("POST", "<?= $url_ajax_nb_like ?>", true);
          xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp2.send("id_pic_nb_like=" + element.id_pic);
          newp.appendChild(newspan);
           var newspan2 = document.createElement("span");
          newspan2.innerText = " likes ";
          newp.appendChild(newspan2);
           var newimg2 = document.createElement("img");
          newimg2.setAttribute("id", "l" + element.id_pic);
          newimg2.setAttribute("class", "thumb");
          newimg2.src = "img/thumb_up.png";
          newimg2.title = "thumb_up";
          newimg2.alt = "thumb_up";
          newimg2.onclick = function()
          {
            likeb("l" + element.id_pic);
          };
          newp.appendChild(newimg2);
          newdiv3.appendChild(newp);
          if ("<?= $_SESSION['id_user'] ?>" == element.id_user)
          {
            var a_del = document.createElement("span");
            a_del.setAttribute("id", "d" + element.id_pic);
            a_del.setAttribute("class", "pointer");
            a_del.onclick = function()
            {
              delete_picb("d" + element.id_pic);
            };
            a_del.innerText = "delete post";
            newdiv3.appendChild(a_del);
          }
          var newdiv4 = document.createElement("div");
          newdiv4.setAttribute("class", "card-footer");
          var newsmall = document.createElement("small");
          newsmall.setAttribute("class", "text-muted");
          newsmall.innerHTML = "Picture added by <b>" + element.login + "</b> on " + element.date;
          newdiv4.appendChild(newsmall);
          newdiv2.appendChild(newdiv3);
          newdiv2.appendChild(newdiv4);
          newdiv1.appendChild(newdiv2);
          if (count % 3 == 0)
            document.getElementById("ici").appendChild(newdiv1);
          count++;
        });
    }
    };
    xhttp.open("POST", "<?= $url_ajax_page ?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("page=" + page);
    update_nb_page(<?= $nb_pics ?>, page);
  }

  function delete_pic(t)
  {
    var id_pic_to_del = t.id.substr(1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
          document.getElementById("del" + id_pic_to_del).remove();
          if (Math.ceil(parseInt(this.responseText) / 6) < c_p)
            c_p--;
          go_to_page("p" + c_p);
        }
    };
    xhttp.open("POST", "<?= $url_ajax_delete_pic ?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_pic_to_del=" + id_pic_to_del);
  }

  function delete_picb(id)
  {
    var id_pic_to_del = id.substr(1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
          document.getElementById("del" + id_pic_to_del).remove();
          if (Math.ceil(parseInt(this.responseText) / 6) < c_p)
            c_p--;
          go_to_page("p" + c_p);
        }
    };
    xhttp.open("POST", "<?= $url_ajax_delete_pic ?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_pic_to_del=" + id_pic_to_del);
  }

</script>
