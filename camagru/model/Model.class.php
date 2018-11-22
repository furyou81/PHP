<?PHP
    abstract class   Model
    {
        protected   $_db;

        public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
        {
            $this->_db = $this->db_connect($DB_DSN, $DB_USER, $DB_PASSWORD);
        }
        protected function db_connect($DB_DSN, $DB_USER, $DB_PASSWORD)
        {
            $_db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ($_db);
        }
    }
