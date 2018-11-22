<style>
  #f {height: 80%;}
  .cent {margin-top: auto; margin-bottom: auto;}
  .error_m {color: #F30049;}
</style>

<main >
  <div class="d-flex justify-content-center" id="f">

  <div class="jumbotron cent" class="col-8">
    <h1 class="display-4">Hi <b><?= $login ?></b> you can reset yout password here.</h1>
    <hr class="my-4">
    <div class="form-group">
      <label for="newinputPassword">New password</label>
      <input type="password" class="form-control" id="newinputPassword" name="psw" placeholder="New password">
      <small id="new_pas_small" class="error_m"> </small>
    </div>
    <div class="form-group">
      <label for="newinputConfirmPassword">Confirm new password</label>
      <input type="password" class="form-control" id="newinputConfirmPassword" name="confirmPsw" placeholder="New password confirmation">
      <small id="new_pas_c_small" class="error_m"> </small>
    </div>

    <button type="submit" name="res" value="addUser" class="btn btn-primary" onclick="reset_psw();">Submit</button>
    <input type=hidden id=error_mes value=<?= $error_mes ?>/>
  </div>

</div>
</main>

<script>


function reset_psw()
{
  var new_pas = document.getElementById('newinputPassword').value;
  var new_pas_c = document.getElementById('newinputConfirmPassword').value;

  document.getElementById('new_pas_small').innerHTML = "";
  document.getElementById('new_pas_c_small').innerHTML = "";

  var error = 0;
  if (new_pas.length > 0 && new_pas_c.length == 0)
  {
    document.getElementById('new_pas_c_small').innerHTML = "Please confirm your new password.";
    error = 1;
  }
  if (new_pas.length == 0 && new_pas_c.length > 0)
  {
    document.getElementById('new_pas_small').innerHTML = "You must put your password two times to update it.";
    error = 1;
  }

  if (new_pas.length > 0 && new_pas_c.length > 0)
  {
    if (new_pas != new_pas_c)
    {
      document.getElementById('new_pas_small').innerHTML = "The password and the confirmation password don't match.";
      error = 1;
    }
    else if (!validatePassword(new_pas) || new_pas.length < 8)
    {
      document.getElementById('new_pas_small').innerHTML = "Your password has a length of at least 8 and it must contain at least a number, a lower-case and an uper-case letter.";
      error = 1;
    }
  }

  if (error == 0)
  {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var x = document.getElementById("snackbar");
            var error_mes = document.getElementById("error_mes").value;
            if (error_mes === "/")
              x.innerHTML = this.responseText;
            else
              x.innerHTML = "Wrong link";
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            if (error_mes === "/")
              window.location = window.location.origin + window.location.pathname;
            }
        };
    xhttp.open("POST", "<?= $url_ajax_update_pas ?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("login_update_pas=" + "<?= $login ?>" + "&new_pas=" + new_pas);
  }
}
function validatePassword(password)
{
  var re = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/;
  return re.test(password);
}

</script>
