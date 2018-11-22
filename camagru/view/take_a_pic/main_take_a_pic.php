<style>
    main {display: inline-block; vertical-align: top; position: relative; border-radius: 1vw; overflow: hidden;}

    video {z-index: -999;  border-radius: 1vw; position: absolute; top: 0;}
    #video_hidden {z-index: -9999; visibility: hidden;}

    #img_display {display: none; width: 40vw;}
    #canvas_tmp {display: none; border-radius: 1vw; position: absolute; top:0;}
    #canvas_hidden {display: none; width: 960px; height: 720px;}

    .disp {margin-left: auto; margin-right: auto;display: none; width: 1vw; position: relative; top: 50%; transform: translateY(-50%);}

    #cancel {display: none; cursor: pointer; z-index: 9999; width: 4vw; height: 4vw; border-radius: 50%; position: absolute; top: 0em; right: 0em; text-align: center;}
    #cancel:hover > img {width: 3vw;}
    #cancel_img {width: 2vw; position: relative; top: 50%; transform: translateY(-50%);}
    #title_around {display: none; margin-left: auto; margin-right: auto; width: 80%;}
    #pic_title {position: absolute; top: 0; z-index: 99; resize: none;resize:none;
      background-color: transparent;
      border: 0px;
      outline: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      width: 80%;

      color: white;
      font-size: 4vw;
      -webkit-text-stroke-width: 0.2vw;
      -webkit-text-stroke-color: #000;
      cursor:default;
      text-align: center;
  }

  @media screen and (min-width: 1240px) {
    #pic_title {font-size: 40px; -webkit-text-stroke-width: 2px;}
  }


#tt {position: absolute; top: 0; right: 50px;}

.add-button {
  z-index: 999999999;
  cursor: pointer;
  position: absolute;
  right: 5vw;
  bottom: 5vw;
  width: 5vw;
  height: 5vw;
  overflow: visible;
  -webkit-transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
    color 0s ease .4s,font-size .2s;
  -moz-transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
    color 0s ease .4s,font-size .2s;
  transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
    color 0s ease .4s,font-size .2s;
  text-align: center;
  line-height: 5vw;
  font-size: 3vw;
  color: rgba(255,255,255,1);
}

.add-button:before {
  position: relative;
  z-index: 999999999;
  content:"+";
}



.add-button:hover {
  color: rgba(255,255,255,0);
  transform: rotate(45deg);
}

.sub-button {
  position: absolute;
  display: inline-block;
  background-color:blue;
  color: rgba(255,255,255,0);
  width: 2.5vw;
  height: 2.5vw;
  line-height:5vw;
  font-family: "FontAwesome";
  font-size: 12px;
  -webkit-transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    transform .1s ease 0s,
    border-radius .2s  ease .2s;
   -moz-transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    transform .1s ease 0s,
    border-radius .2s  ease .2s;
   transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
    transform .1s ease 0s,
    border-radius .2s  ease .2s;
}

.tl {
  top: 0;
  left: 0;
  border-radius: 3vw 0 0 0;
}

.tr {
  top: 0;
  right: 0;
  border-radius: 0 3vw 0 0;
}

.bl {
  bottom: 0;
  left: 0;
  border-radius: 0 0 0 3vw;
}

.br {
  bottom: 0;
  right: 0;
  border-radius: 0 0 3vw 0;
}

.add-button:hover .sub-button {
  width: 5vw;
  height: 5vw;
  transform: rotate(-45deg);

  color: rgba(255,255,255,1);
  -webkit-transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    color .3s ease .8s,
    transform .3s ease .8s,
    border-radius .4s  ease .6s;
   -moz-transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    color .3s ease .8s,
    transform .3s ease .8s,
    border-radius .4s  ease .6s;
   transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
    color .3s ease .8s,
    transform .3s ease .8s,
    border-radius .4s  ease .6s;
}

.add-button:hover .tl {
  top: -2.5vw;
  left: -2.5vw;
  border-radius: 3vw;
}

.add-button:hover .tr {
  top: -2.5vw;
  right: -2.5vw;
  border-radius: 3vw;
}

.add-button:hover .bl {
  bottom: -2.5vw;
  left: -2.5vw;
  border-radius: 3vw;
}

.add-button:hover .br {
  bottom: -2.5vw;
  right: -2.5vw;
  border-radius: 3vw;
}

.add-button .disp{
display: block;
  -webkit-transition: all 1000ms ease-in;
      -webkit-transform: scale(1);
      -ms-transition: all 1000ms ease-in;
      -ms-transform: scale(1);
      -moz-transition: all 1000ms ease-in;
      -moz-transform: scale(1);
      transition: all 1000ms ease-in;
      transform: scale(1);
      visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.5s linear;
}

.add-button:hover .disp{
      display: block;
      -webkit-transition: all 1000ms ease-in;
      -webkit-transform: scale(3);
      -ms-transition: all 1000ms ease-in;
      -ms-transform: scale(3);
      -moz-transition: all 1000ms ease-in;
      -moz-transform: scale(3);
      transition: all 1000ms ease-in;
      transform: scale(3);
      visibility: visible;
      opacity: 1;
}

</style>

<main id="main_drop" ondrop="drop(event)" ondragover="allowDrop(event)">

    <video id="video" class="embed-responsive" autoplay></video>
    <canvas id="canvas_tmp"></canvas>
    <img id="img_display"> </img>
        <div id="cancel" onclick="cancel_pic();">
            <img src="img/cancel.png" id="cancel_img"></img>
        </div>


    <div id="title_around">
    <textarea id="pic_title" rows="4" maxlength="100" placeholder="Please put the title of the picture here."></textarea>
  </div>
  <video id="video_hidden" width="960px" height="720px" autoplay></video>
  <canvas id="canvas_hidden"></canvas>

  <div class="add-button">
    <a id="zoom_in">
      <div id="zoo" class="sub-button tr" onclick="zoom_in();"> + </div>
    </a>
    <a  id="zoom_out">
      <div id="zo" class="sub-button bl" onclick="zoom_out();"> - </div>
    </a>

      <div id="snapshot" class="sub-button tl" onclick="take_a_pic();"><img src="img/take_a_pic.png" class="disp" id="pic_img"></img></div>


      <div class="sub-button br" id="save" onclick="save_a_pic();"> <img src="img/save.png" class="disp"></img> </div>

  </div>

</main>
