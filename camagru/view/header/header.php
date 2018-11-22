<style>
    header {background-color: rgba(255, 255, 255, 0.8); height: 7em; padding-top: 1em; font-family: 'Pangolin', cursive;}

    #group_icon {margin-left: 15%; margin-right: 15%; height: 90px; position: relative;}
    #reset_pas {cursor: pointer; color: #3498db;}
    #icon_left {margin-left: 1em;}
    #icon_middle {margin-left: 5em;}
    #icon_right {margin-left: 9em;}
    .icon_circle {box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);background-color: rgb(251,250,248); border-radius: 50%; width: 3em; height: 3em; text-align: center; position: absolute;}
    .icon_circle:hover {background-color: #EAF0CE;}
    .icon_menu {width: 2em; position: relative; top: 50%; transform: translateY(-50%);}
    #sign_up {margin-right: 0.5em; position: absolute; right: 1em; top: 0;}
    #sign_in {margin-right: 0.5em; position: absolute; right: 7.5em; top: 0;}

    .icon_sign {box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);background-color: red; border-radius: 10px; width: 6em; height: 2em; text-align: center;}
    .sign_txt {line-height: 2em; font-family: 'Lobster', Georgia, Times, serif;}
    .error_m {color: #F30049;}
    #connected {position: absolute; right: 2em; top: 0.5em; font-size: 18px;}
    #co {position: absolute; right: 2em; bottom: 0.2em; font-weight: bold;}

    .bold {font-weight: bold;}

    @media screen and (max-width: 620px) {
      #group_icon {margin-left: auto; margin-right: auto;}
      #connected {position: absolute; right: 0em; top: 0.5em; font-size: 18px;}
    }

    /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    position: absolute;
    top: 0.5em;
    right: 0.5em;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


/* The snackbar - position it at the bottom and in the middle of the screen */
#snackbar {
    visibility: hidden; /* Hidden by default. Visible on click */
    min-width: 250px; /* Set a default minimum width */
    margin-left: -125px; /* Divide value of min-width by 2 */
    background-color: #333; /* Black background color */
    color: #fff; /* White text color */
    text-align: center; /* Centered text */
    border-radius: 2px; /* Rounded borders */
    padding: 16px; /* Padding */
    position: fixed; /* Sit on top of the screen */
    z-index: 1; /* Add a z-index if needed */
    left: 50%; /* Center the snackbar */
    top: 20px; /* 30px from the bottom */
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
    visibility: visible; /* Show the snackbar */

/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 20px; opacity: 1;}
}

@keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 20px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {top: 20px; opacity: 1;}
    to {top: 0; opacity: 0;}
}

@keyframes fadeout {
    from {top: 20px; opacity: 1;}
    to {top: 0; opacity: 0;}
}

#sign_out {position: absolute; right: 4vw; bottom: 1vw;}
/* CORE CSS FOR THE FLIP BUTTON*/
body {

}
/* Container box to set the sides relative to */
.cube {



  width: 135px;
  height: 30px;

  -webkit-transition: all 250ms ease;
  -moz-transition: all 250ms ease;
  -o-transition: all 250ms ease;
  transition: all 250ms ease;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  transform-style: preserve-3d;
}
/* The two faces of the cube */
.default-state,
.active-state {

  height: 30px;
}
/* Position the faces */
.default-state {
  -webkit-transform: translateZ(15px);
  -moz-transform: translateZ(15px);
  -ms-transform: translateZ(15px);
  -o-transform: translateZ(15px);
  transform: translateZ(15px);
}
.flip-to-top .active-state {
  -webkit-transform: rotateX(90deg) translateZ(40px);
  -moz-transform: rotateX(90deg) translateZ(40px);
  -ms-transform: rotateX(90deg) translateZ(40px);
  -o-transform: rotateX(90deg) translateZ(40px);
  transform: rotateX(90deg) translateZ(40px);
}
.flip-to-bottom .active-state {
  -webkit-transform: rotateX(-90deg) translateZ(15px);
  -moz-transform: rotateX(-90deg) translateZ(15px);
  -ms-transform: rotateX(-90deg) translateZ(15px);
  -o-transform: rotateX(-90deg) translateZ(15px);
  transform: rotateX(-90deg) translateZ(15px);
}
/* Rotate the cube */
.cube.flip-to-top:hover {
  -webkit-transform: rotateX(-89deg);
  -moz-transform: rotateX(-89deg);
  -ms-transform: rotateX(-89deg);
  -o-transform: rotateX(-89deg);
  transform: rotateX(-89deg);
}
.cube.flip-to-bottom:hover {
  -webkit-transform: rotateX(89deg);
  -moz-transform: rotateX(89deg);
  -ms-transform: rotateX(89deg);
  -o-transform: rotateX(89deg);
  transform: rotateX(89deg);
}
/* END CORE CSS */
/* Demo styling */


.cube {
  text-align: center;
  margin: 0 auto;
}
.default-state,
.active-state {
  background: rgb(221, 75, 57);
  font-size: 14px;

  text-transform: uppercase;
  color: #fff;
  line-height: 30px;;
  -webkit-transition: background 250ms ease;
  -moz-transition: background 250ms ease;
  -o-transition: background 250ms ease;
  transition: background 250ms ease;
}
.cube:hover .default-state {
  background: rgb(221, 75, 57);
}
.active-state {
  background: rgb(221, 75, 57);
}




/* Reset */
.buttonn {
  background: transparent;
  border: 0;
  padding: 0;
  cursor: pointer;
  outline: 0;
  -webkit-appearance: none;
}

/* Custom */
.buttonn {
  display: inline-block;
  position: relative;
  padding: 2px 2px;
  top: 0;
  font-size: 15px;
  font-family: "Open Sans", Helvetica;
  border-radius: 4px;
  border-bottom: 1px solid rgba( 28, 227, 125, 0.5 );
  background: rgba( 22, 230, 137, 1 );
  color: #fff;
  box-shadow: 0px 0px 0px rgba( 15, 165, 60, 0.1 );

  -webkit-transform: translateZ(0);
     -moz-transform: translateZ(0);
      -ms-transform: translateZ(0);
          transform: translateZ(0);

  -webkit-transition: all 0.2s ease;
     -moz-transition: all 0.2s ease;
      -ms-transition: all 0.2s ease;
          transition: all 0.2s ease;
}

.buttonn:hover {
  top: -10px;
  box-shadow: 0px 10px 10px rgba( 15, 165, 60, 0.2 );

  -webkit-transform: rotateX(20deg);
     -moz-transform: rotateX(20deg);
      -ms-transform: rotateX(20deg);
          transform: rotateX(20deg);
}

.buttonn:active {
  top: 0px;
  box-shadow: 0px 0px 0px rgba( 15, 165, 60, 0.0 );
  background: rgba( 20, 224, 133, 1 );
}
</style>

<header class="shadow">
    <div id="group_icon">
        <a href="<?= $url_take_a_pic ?>">
            <div class="icon_circle" id="icon_left" class="shadow">
                <img src="img/camera.png" class="icon_menu" title="take_a_pic" alt="take_a_pic"></img>
            </div>
        </a>
        <a href="<?= $url_gallery ?>">
            <div class="icon_circle" id="icon_middle">
                <img src="img/gallery.png" class="icon_menu" title="pic_gallery" alt="pic_gallery"></img>
            </div>
        </a>
        <a href="<?= $url_my_account ?>">
            <div class="icon_circle" id="icon_right">
                <img src="img/my_account.png" class="icon_menu" title="pic_my_acccount" alt="pic_my_account"></img>
              </a>
            </div>
        <?= $header_connect_status ?>
        <div id="co"><p id="co_msg"></p></div>
    </div>

    <!-- The Modal For Sign In -->
<div id="modalSignIn" class="modal">
  <!-- Modal content -->
   <div class="modal-dialog" role="document">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="form-group">
    <label for="inputLogin">Login</label>
    <input type="text" class="form-control" id="login_connect" name="login" aria-describedby="loginHelp" placeholder="Enter your login">
    <small id="login_connect_help" class="error_m" class="form-text text-muted"></small>
</div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="psw_connect" name="psw" placeholder="Password">
    <small id="psw_connect_help" class="error_m" class="form-text text-muted"></small>
  </div>
  <div class="form-group form-check">
    <small id="connect_help" class="error_m" class="form-text text-muted"></small>
  </div>
  <p id="reset_pas" onclick="reset_password();"> Forgot password (an email will be sent to you).</p>
  <button id="btn_log_in" name="action" value="signIn" class="btn btn-primary">Login</button>
  </div>
</div>
</div>

    <!-- The Modal For Sign Up -->
<div id="modalSignUp" class="modal">
  <!-- Modal content -->
   <div class="modal-dialog" role="document">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="<?= $url_add_user ?>" method="post">
    <div class="form-group">
    <label for="inputLogin">Login</label>
    <input type="text" class="form-control" id="inputLogin" name="login" aria-describedby="loginHelp" placeholder="Choose a login">
    <small id="loginHelp" class="form-text text-muted">You will be identified with this login</small>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" name="psw" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="inputConfirmPassword">Confirm Password</label>
    <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPsw" placeholder="Confirm Password">
  </div>
  <button type="submit" name="action" value="addUser" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
</div>

<div id="snackbar">Some text some message..</div>

    <script>
        var modalSignUp = document.getElementById('modalSignUp');
        var btnSignUp = document.getElementById("sign_up");
        var spanSignUp = document.getElementsByClassName("close")[1];
        function display_modal_sign_up() {
        modalSignUp.style.display = "block";
        }
        spanSignUp.onclick = function() {
        modalSignUp.style.display = "none";
        }
        var modalSignIn = document.getElementById('modalSignIn');
        var btnSignIn = document.getElementById("sign_in");
        var spanSignIn = document.getElementsByClassName("close")[0];
        function display_modal_sign_in() {
        modalSignIn.style.display = "block";
        }
        spanSignIn.onclick = function() {
        modalSignIn.style.display = "none";
        }

        var btn_log_in = document.getElementById("btn_log_in");

        window.onclick = function(event) {
            if (event.target == modalSignIn) {
                modalSignIn.style.display = "none";
            }
            else if (event.target == modalSignUp)
            {
                modalSignUp.style.display = "none";
            }
            else if (event.target == btn_log_in)
            {
                var login_connect = document.getElementById("login_connect").value;
                var psw_connect = document.getElementById("psw_connect").value;

                document.getElementById("login_connect_help").innerHTML = "";
                document.getElementById("psw_connect_help").innerHTML = "";
                document.getElementById("connect_help").innerHTML = "";
               if (login_connect != "" && psw_connect != "")
               {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("connect_help").innerHTML = this.responseText;
                            var x = document.getElementById("snackbar");
                            x.innerHTML = this.responseText;
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                            if (this.responseText.includes("success"))
                            {
                                document.getElementById("sign_in").style.display = "none";
                                document.getElementById("sign_up").style.display = "none";
                                location.reload();
                                }
                            document.getElementById("co").style.display = "block";
                            document.getElementById("co_msg").innerHTML = this.responseText;
                            }
                        };
                    xhttp.open("POST", "<?= $url_ajax_user_connect ?>", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("login_connect=" + login_connect + "&psw_connect=" + psw_connect);
                    modalSignIn.style.display = "none";
               }
                else
                {
                    if (login_connect == "")
                        document.getElementById("login_connect_help").innerHTML = "Please put your login";
                    if (psw_connect == "")
                        document.getElementById("psw_connect_help").innerHTML = "Please put your password";
                }
            }
        }
        function reset_password()
        {
          document.getElementById('login_connect_help').innerHTML = "";
          var log_reset = document.getElementById("login_connect").value;
          if (log_reset == "")
          {
            //document.getElementById("connect_help").innerHTML = this.responseText;
            var x = document.getElementById("snackbar");
            x.innerHTML = "To reset your password please put your login and then click again on reset password.";
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
          }
          else
          {
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function()
              {
                  if (this.readyState == 4 && this.status == 200) {
                      if (!(this.responseText).includes("already in use"))
                      {
                        document.getElementById('login_connect_help').innerHTML = "This login is not registered.";
                        error = 1;
                      }
                      else
                      {
                        var xhttp2 = new XMLHttpRequest();
                        xhttp2.onreadystatechange = function()
                        {
                            if (this.readyState == 4 && this.status == 200) {
                              var x = document.getElementById("snackbar");
                              x.innerHTML = this.responseText;
                              x.className = "show";
                              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                            }
                        };
                        xhttp2.open("POST", "<?= $url_ajax_reset_pas ?>", true);
                        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp2.send("login_to_reset=" + log_reset);
                      }
                  }
              };
              xhttp.open("POST", "<?= $url_ajax_check_login ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("login_to_check=" + log_reset);
          }
        }
</script>
</header>
