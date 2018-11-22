<?PHP
    require_once("model/UserModel.class.php");

abstract class   Controller
{
    protected   $_user;

    public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
    {
        $this->_user = new UserModel($DB_DSN, $DB_USER, $DB_PASSWORD);
    }

}
