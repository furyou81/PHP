<?PHP

class Header
{
    public function signButton()
    {
        ob_start();
        echo  '<a id="sign_in" onclick="display_modal_sign_in();">'
            . '<div class="icon_sign buttonn" >'
            . '<p class="sign_txt"> Sign in! </p>'
            . '</div>'
            . '</a>'
            . '<a id="sign_up" onclick="display_modal_sign_up();">'
            . '<div class="icon_sign buttonn" >'
            . '<p class="sign_txt"> Sign up! </p>'
            . '</div>'
            . '</a>';
        $header_connect_status = ob_get_contents();
        ob_clean();
        return ($header_connect_status);
    }

    public function signedIn($session_login)
    {
      ob_start();
      echo '<div id="connected"><p> Hi <span id="ses_log" class="bold">' . $session_login . '</span> you are connected</p></div>';
      echo '<a id="sign_out" href="index.php?action=user_disconnect">';
      echo '<div class="cube flip-to-top">';
      echo '<div class="default-state">';
      echo '<span>Sign out!</span>';
      echo '</div>';
      echo '<div class="active-state">';
      echo '<span>Bye see you soon!</span>';
      echo '</div>';
      echo '</div>';
      echo '</a>';

      $header_connect_status = ob_get_contents();
      ob_clean();
        return ($header_connect_status);
    }
}
