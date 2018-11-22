<style>
  main {width: 70%; padding: 1em; margin-left: auto; margin-right: auto; color: #fff; font-family: 'Pangolin', cursive; font-size: 1.2em;}
  .error_m {color: #F30049;}
</style>

<main>
    <div class="form-group row">
      <label for="login_update" class="col-sm-3 col-form-label">Login</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="login_update" placeholder="Login" value="<?= $user_info['login'] ?>">
        <small id="login_update_small" class="error_m"> </small>
      </div>
    </div>
  <div class="form-group row">
    <label for="email_update" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email_update" placeholder="Email" value="<?= $user_info['email'] ?>">
      <small id="email_update_small" class="error_m"> </small>
    </div>
  </div>
  <div class="form-group row">
    <label for="password_current" class="col-sm-3 col-form-label">Current password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="password_current" placeholder="Current password">
      <small id="password_current_small" class="error_m"> </small>
    </div>
  </div>
  <div class="form-group row">
    <label for="password_update" class="col-sm-3 col-form-label">New password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="password_update" placeholder="New password">
      <small id="password_update_small" class="error_m"> </small>
    </div>
  </div>
  <div class="form-group row">
    <label for="password_update_confirm" class="col-sm-3 col-form-label">New password confirmation</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="password_update_confirm" placeholder="New password confirmation">
      <small id="password_update_confirm_small" class="error_m"> </small>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-3 pt-0">Notifications</legend>
      <div class="col-sm-9">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="notif_update" id="notif_update" value=1 <?= $send ?>>
          <label class="notif_update" for="gridRadios1">
            Send notifications
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="notif_update" id="notif_update2" value=0 <?= $dont_send ?>>
          <label class="form-check-label" for="gridRadios2">
            Don't send notifications
          </label>
        </div>

      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-9">
      <button type="submit" class="btn btn-primary" onclick="update_user_info();">Update info</button>
    </div>
  </div>
</main>

<script>

  function update_user_info()
  {
    var login_update = document.getElementById('login_update').value;
    var email_update = document.getElementById('email_update').value;
    var password_current = document.getElementById('password_current').value;
    var password_update = document.getElementById('password_update').value;
    var password_update_confirm = document.getElementById('password_update_confirm').value;
    if (document.getElementById('notif_update').checked)
      var notif_update = 1;
    else
      var notif_update = 0;
    var error;

    error = 0;
    document.getElementById('login_update_small').innerHTML = "";
    document.getElementById('email_update_small').innerHTML = "";
    document.getElementById('password_current_small').innerHTML = "";
    document.getElementById('password_update_small').innerHTML = "";
    document.getElementById('password_update_confirm_small').innerHTML = "";

    if (password_current.length == 0)
    {
      document.getElementById('password_current_small').innerHTML = "Please put your current password to confirm that you re the owner of this account.";
      error = 1;
    }
    else
    {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.length > 0)
            {
              if (this.responseText.trim().length > 0)
              {
                document.getElementById('password_current_small').innerHTML = this.responseText;
                error = 1;
              }
            }
          }
      };
      xhttp.open("POST", "<?= $url_ajax_check_password ?>", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("password_to_check=" + password_current);
    }

    if (password_update.length > 0 && password_update_confirm.length == 0)
    {
      document.getElementById('password_update_confirm_small').innerHTML = "Please confirm your new password.";
      error = 1;
    }
    if (password_update.length == 0 && password_update_confirm.length > 0)
    {
      document.getElementById('password_update_small').innerHTML = "You must put your password two times to update it.";
      error = 1;
    }

    if (password_update.length > 0 && password_update_confirm.length > 0)
    {
      if (password_update != password_update_confirm)
      {
        document.getElementById('password_update_small').innerHTML = "The password and the confirmation password don't match.";
        error = 1;
      }
      else if (!validatePassword(password_update) || password_update.length < 8)
      {
        document.getElementById('password_update_small').innerHTML = "Your password has a length of at least 8 and it must contain at least a number, a lower-case and an uper-case letter.";
        error = 1;
      }
    }

    if (email_update != "<?= $user_info['email'] ?>")
    {
      if (!validateEmail(email_update))
      {
        document.getElementById('email_update_small').innerHTML = "This email is not valid.";
        error = 1;
      }
     /* else
      {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText.trim().length > 0)
              {
                document.getElementById('email_update_small').innerHTML = this.responseText;
                error = 1;
              }
            }
        };
        xhttp.open("POST", "<?= $url_ajax_check_email ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email_to_check=" + email_update);
      }*/
    } else {email_update = "";}

    if (login_update != "<?= $login ?>")
    {
      /*var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
          if (this.readyState == 4 && this.status == 200) {
              if (this.responseText.trim().length > 0)
              {
                document.getElementById('login_update_small').innerHTML = this.responseText;
                error = 1;
              }
          }
      };
      xhttp.open("POST", "<?= $url_ajax_check_login ?>", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("login_to_check=" + login_update);*/
    } else {login_update = "";}

    function validateEmail(email)
    {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
    }

    function validatePassword(password)
    {
      var re = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/;
      return re.test(password);
    }

    if (error == 0)
    {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText.trim().length > 0)
          {
            var x = document.getElementById("snackbar");
            x.innerHTML = this.responseText.trim();
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            if (this.responseText.trim() === "ok")
              window.location = "<?= $_SERVER["PHP_SELF"] ?>";
          }
          document.getElementById('ses_log').innerHTML = login_update;
        }
      };

      xhttp.open("POST", "<?= $url_ajax_update_user_info ?>", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("login_update=" + login_update + "&email_update=" + email_update + "&password_update=" + password_update
                + "&notif_update=" + notif_update + "&old_password=" + password_current);
    }
    else
      error = 0;
  }

</script>
