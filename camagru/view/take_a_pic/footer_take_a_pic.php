<style>
    #fff {width: 80%; margin-top: 2em; min-height: 13vw; margin-left: auto; margin-right: auto; border-radius: 1vw;}
    .stk {width: 10vw;; display: inline-block;}
    .translucid {background-color: rgba(255, 255, 255, 0.8);}
    #pp {font-family: 'Pangolin', cursive; font-size: 3vw; text-align: center;}
    #foot_drop {min-height: 13vw}

</style>

<footer class="shadow translucid" id="fff">
    <p id="pp"> You can drag and drop one or more stickers on the video/image. </p>
    <div id="foot_drop" ondrop="drop(event)" ondragover="allowDrop(event)">
      <?= $stickers ?>
    </div>


</footer>
