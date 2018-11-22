<style>
    aside {word-wrap: break-word; width: 240px; margin-left: 1vw; display: inline-block; overflow-y: auto; vertical-align: top; border-radius: 1vw;}
    .pic {width: 1em;}
    #snapshot_display {width: 100%; display: flex;flex-direction: column;}
    .translucid {background-color: rgba(255, 255, 255, 0.8);}
</style>

<aside class="shadow translucid" id="asside">
  <div id="snapshot_display">
      <?= $u_pics ?>
  </div>
</aside>

<script>
  function delete_pic(t)
  {
    var id_pic_to_del = t.id.substr(1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pic_" + id_pic_to_del).remove();  
      }
    };
    xhttp.open("POST", "<?= $url_ajax_delete_pic ?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_pic_to_del=" + id_pic_to_del);
  }
</script>