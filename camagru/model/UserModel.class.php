<?PHP
    require_once("Model.class.php");

    class UserModel extends Model
    {
        private $_first_name;
        private $_last_name;
        private $_email;
        private $_psw;

        public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
        {
            parent::__construct($DB_DSN, $DB_USER, $DB_PASSWORD);
        }

        public function addUser($login, $email, $psw, $validation_key)
        {
          $login = htmlspecialchars($login);
          $email = htmlspecialchars($email);
          $psw = htmlspecialchars($psw);
          $validation_key = htmlspecialchars($validation_key);
          if ($login != "" && $email != "" && $psw != "" && $validation_key != "")
          {
            $req = $this->_db->prepare('INSERT INTO `users` (`id_user`, `login`, `rights`, `email`, `psw`, `account_status`, `notif`, `reset`) VALUES
                    (NULL, :l, "regular", :e, :p, :v, 1, "")');
            $req->bindParam(':l', $login);
            $req->bindParam(':e', $email);
            $req->bindParam(':p', $psw);
            $req->bindParam(':v', $validation_key);
            $res = $req->execute();
            return ($res);
          }
            return (0);
        }

        public function getUserInfo($login)
        {
            $login = htmlspecialchars($login);
            if ($login != "")
            {
                $req = $this->_db->prepare('SELECT `login`, `email`, `notif`  FROM `users` WHERE `login` = :l');
                $req->bindParam(':l', $login);
                $req->execute();
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                if (isset($res[0]))
                  return ($res[0]);
                else
                  return (0);
            }
        }

        public function checkLoginUsed($login)
        {
          $login = htmlspecialchars($login);
            if ($login != "")
            {
                $req = $this->_db->prepare('SELECT COUNT(users.login) as `log` FROM `users` WHERE `login` = :l');
                $req->bindParam(':l', $login);
                $req->execute();
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                return ($res[0]['log']);
            }
            else
                return (-1);
        }

        public function checkEmailUsed($email)
        {
           $email = htmlspecialchars($email);
            if ($email != "")
            {
                $req = $this->_db->prepare('SELECT COUNT(users.email) as `log` FROM `users` WHERE `email` = :e');
                $req->bindParam(':e', $email);
                $req->execute();
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                return ($res[0]['log']);
            }
            else
                return (-1);
        }

        public function userConnect($login, $psw)
        {
          $login = htmlspecialchars($login);
          $psw = htmlspecialchars($psw);
            if ($login != "" && $psw != "")
            {
                $req = $this->_db->prepare('SELECT `id_user`, `login`, `psw`, `account_status` FROM `users` WHERE `login` = :l');
                $req->bindParam(':l', $login);
                $req->execute();
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                if (!array_key_exists('0', $res))
                    return ("Unknown login.");
                if (!(array_key_exists('login', $res[0]) && array_key_exists('psw', $res[0])))
                    return ("Please fill your login and your password and re-submit.");
                if ($res['0']['account_status'] != "validated")
                    return ("This account hasn't been validated, please check your email.");
                if ($res['0']['login'] == $login)
                {
                    if (password_verify($psw, $res['0']['psw']))
                    {
                        $id_user = $res['0']['id_user'];
                        $_SESSION['login'] = $login;
                        $_SESSION['id_user'] = $id_user;
                        return ("Connection success.");
                    }
                    else
                    {
                        return ("Incorrect login.");
                    }
                }
                else
                    return ("Unknown login.");
            }
            else
                return ("Please fill your login and your password and re-submit.");
        }

        public function validate_account($validation_key, $validation_login)
        {
          $validation_key = htmlspecialchars($validation_key);
          $validation_login = htmlspecialchars($validation_login);
          if ($validation_login != "" && $validation_key != "")
          {
              $req = $this->_db->prepare('SELECT `account_status` FROM `users` WHERE `login` = :l');
              $req->bindParam(':l', $validation_login);
              $req->execute();
              $res = $req->fetchAll(PDO::FETCH_ASSOC);
              if (!array_key_exists('0', $res))
                  return ("Wrong link.");
              else
              {
                if ($res[0]['account_status'] == "validated")
                  return ("This account has already been validated, you can login.");
                else if ($res[0]['account_status'] != $validation_key)
                  return ("Wrong link.");
                else if ($res[0]['account_status'] == $validation_key)
                {
                  $req = $this->_db->prepare('UPDATE `users` SET `account_status` = "validated" WHERE `login` = :l');
                  $req->bindParam(':l', $validation_login);
                  $res = $req->execute();
                  if ($res == 1)
                  {
                    return ("Your account has been validated, you can now login");
                  }
                  else
                    return ("There was a problem during the validation of your account please retry.");
                }
              }
              return ($res[0]['log']);
          }
          else
              return (-1);
        }

        public function update_user_info($old_login, $old_pass, $login, $email, $new_psw, $notif)
        {
          $old_login = htmlspecialchars($old_login);
          $login = htmlspecialchars($login);
          $email = htmlspecialchars($email);
          $new_psw = htmlspecialchars($new_psw);
          $notif = htmlspecialchars($notif);
          if ($old_login != "")
          {
            if ($old_pass != "") {
              if ($this->userConnect($old_login, $old_pass)  != "Connection success.")
                return ("wrong password");
            }
            if ($email != "")
            {
              if (intval($this->checkEmailUsed($email)) != 0)
                return ("email already in use");
              $req = $this->_db->prepare('UPDATE `users` SET `email` = :e WHERE `login` = :o');
              $req->bindParam(':e', $email);
              $req->bindParam(':o', $old_login);
              $res = $req->execute();
            }
            if (trim($new_psw) != "")
            {
              $req = $this->_db->prepare('UPDATE `users` SET `psw` = :p WHERE `login` = :o');
              $req->bindParam(':p', $new_psw);
              $req->bindParam(':o', $old_login);
              $res = $req->execute();
            }
            if ($notif != "")
            {
              $req = $this->_db->prepare('UPDATE `users` SET `notif` = :n WHERE `login` = :o');
              $req->bindParam(':n', $notif);
              $req->bindParam(':o', $old_login);
              $res = $req->execute();
            }
            if ($login != "")
            {
              if (intval($this->checkLoginUsed($login)) != 0)
                return ("login already in use");
              $req = $this->_db->prepare('UPDATE `users` SET `login` = :l WHERE `login` = :o');
              $req->bindParam(':l', $login);
              $req->bindParam(':o', $old_login);
              $res = $req->execute();
              $_SESSION['login'] = $login;
            }
            return "ok";
          }
        }

        public function add_reset_key($reset_key, $login)
        {
          $reset_key = htmlspecialchars($reset_key);
          $login = htmlspecialchars($login);
          if ($reset_key != "" && $login != "")
          {
            $req = $this->_db->prepare('UPDATE `users` SET `reset` = :r WHERE `login` = :l');
            $req->bindParam(':r', $reset_key);
            $req->bindParam(':l', $login);
            $res = $req->execute();
          }
        }

        public function get_email($login)
        {
          $login = htmlspecialchars($login);
          if ($login != "")
          {
            $req = $this->_db->prepare('SELECT `email` FROM `users` WHERE `login` = :l');
            $req->bindParam(':l', $login);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (isset($res[0]))
              return ($res[0]['email']);
            else
              return (0);
          }
          else
            return (0);
        }

        public function get_email_by_id($id_user)
        {
          $id_user = htmlspecialchars($id_user);
          if ($id_user != "")
          {
            $req = $this->_db->prepare('SELECT `email` FROM `users` WHERE `id_user` = :u');
            $req->bindParam(':u', $id_user);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (isset($res[0]))
              return ($res[0]['email']);
            else
              return (0);
          }
          else
            return (0);
        }

        public function check_reset_key($reset_key, $login)
        {
          $reset_key = htmlspecialchars($reset_key);
          $login = htmlspecialchars($login);
          if ($reset_key != "" && $login != "")
          {
            $req = $this->_db->prepare('SELECT `reset` FROM `users` WHERE `login` = :l');
            $req->bindParam(':l', $login);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (isset($res[0]))
            {
              if ($res[0]['reset'] == $reset_key) {
                $req = $this->_db->prepare('UPDATE `users` SET `reset` = "" WHERE `login` = :l');
                $req->bindParam(':l', $login);
                $req->execute();
                return (1);
              }
              else
                return (0);
            }
            else
              return (0);
          }
        }

        public function update_pas($login_update_pas, $new_pas)
        {
          $login_update_pas = htmlspecialchars($login_update_pas);
          $new_pas = htmlspecialchars($new_pas);
          if ($login_update_pas != "" && $new_pas != "")
          {
            $new_pas = password_hash($new_pas, PASSWORD_BCRYPT);
            $req = $this->_db->prepare('UPDATE `users` SET `psw` = :p WHERE `login` = :l');
            $req->bindParam(':p', $new_pas);
            $req->bindParam(':l', $login_update_pas);
            $res = $req->execute();
          }
        }

        public function get_notif($id_pic_comment)
        {
          $id_pic_comment = htmlspecialchars($id_pic_comment);
          if ($id_pic_comment != "")
          {
            $req = $this->_db->prepare('SELECT `notif` FROM `pics` LEFT JOIN `users` ON pics.id_user = users.id_user WHERE `id_pic` = :u');
            $req->bindParam(':u', $id_pic_comment);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            echo ($res[0]['notif']);
            if (isset($res[0]))
              return ($res[0]['notif']);
            else
              return (0);
          }
          else
            return (0);
        }
    }
