<?PHP
    require_once("model/UserModel.class.php");
    require('config/database.php');
    $action     = $_POST['action'] ?? "";
    $login = $_POST['login'] ?? "";
    $email = $_POST['email'] ?? "";
    $psw = $_POST['psw'] ?? "";
    $confirmPsw = $_POST['confirmPsw'] ?? "";

    $error_mess = "";
    $success_mess = "";
    if ($action == "addUser")
    {
        if ($login != "" && $email != "" && $psw != "" && $confirmPsw != "")
        {
            $user = new UserModel($DB_DSN, $DB_USER, $DB_PASSWORD);
            if ($user->checkLoginUsed($login) == 0)
            {
                if ($user->checkEmailUsed($email) == 0)
                {
                    if ($psw == $confirmPsw)
                    {
                        
                        if (preg_match("/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/", $psw) == 0 || strlen($psw) < 8)
                            $error_mess .= "Wrong password format. Should be at least 8 characters long, contains at least a capital letter a small letter and a number";
                        else {
                            $validation_key = bin2hex(random_bytes(32));
                            $res = $user->addUser($login, $email, password_hash($psw, PASSWORD_BCRYPT), $validation_key);
                            if ($res == 1)
                            {
                                $subject = "Account activation";
                                $headers = "From: camagru.com";
                                $message = "Welcome, ". $login ." to camagru.com,\n\n to activate your account please click on the link below:\n http://localhost:8080" . $_SERVER["PHP_SELF"] . "?validation_key="
                                            . $validation_key . "&validation_login=" . $login;
                                mail($email, $subject, $message, $headers);
                                $success_mess = "User successfully created, please check your mails to confirm your account.";
                            }
                            else
                                $error_mess = "There was a problem.";
                        }
                    }
                    else
                    {
                        $error_mess = "Both password and confirmation password are not the same.";
                    }
                    }
                    else
                    {
                        $error_mess = "An account has already been created with this email.";
                    }
            }
            else
            {
                $error_mess = "This login is already used, please choose an other login.";
            }
        }
        else
        {
            $error_mess = "Some information are missing, please complete the form and re-submit.";
        }
        if ($error_mess != "")
            $text_to_display = $error_mess;
        else
            $text_to_display = $success_mess;
        require_once("view/user/main_add_user.php");
    }
?>
