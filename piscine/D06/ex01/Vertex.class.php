<?PHP
    require_once 'Color.class.php';
    Class Vertex
    {
        private $_x;
        private $_y;
        private $_z;
        private $_w;
        private $_color;
        static $verbose = FALSE;

    function __construct(array $coord)
    {   
        if (array_key_exists("x", $coord) && array_key_exists("y", $coord) && array_key_exists("z", $coord))
        {
            $this->setX($coord["x"]);
            $this->setY($coord["y"]);
            $this->setZ($coord["z"]);
        }
        if (array_key_exists("w", $coord))
            $this->setW($coord["w"]);
        else
            $this->setW(1.0);
        if (array_key_exists("color", $coord))
            $this->setColor($coord["color"]);
        else
            $this->setColor(new Color(array('red' => 255, 'green' => 255, 'blue' => 255)));
        if (self::$verbose == TRUE)
            echo $this->__toString() . " constructed" . PHP_EOL;
        return ;
    }
    function __destruct()
    {
        if (self::$verbose == TRUE)
        echo $this->__toString() . " destructed" . PHP_EOL;
        return ;
    }
    function __toString()
    {
        if (self::$verbose)
            return ("Vertex( x: " . number_format($this->getX(), 2) . ", y: " . number_format($this->getY(), 2) . ", z:" . number_format($this->getZ(), 2) . ", w:" . number_format($this->getW(), 2) . ", " . $this->getColor()->__toString() . " )");
        else
            return ("Vertex( x: " . number_format($this->getX(), 2) . ", y: " . number_format($this->getY(), 2) . ", z:" . number_format($this->getZ(), 2) . ", w:" . number_format($this->getW(), 2) . " )");
        }
    static function doc()
    {
        return (file_get_contents("Vertex.doc.txt") . PHP_EOL);
    }

    public function setX($x)
    {
        $this->_x = $x;
    }
    public function getX()
    {
        return $this->_x;
    }
    public function setY($y)
    {
        $this->_y = $y;
    }
    public function getY()
    {
        return $this->_y;
    }
    public function setZ($z)
    {
        $this->_z = $z;
    }
    public function getZ()
    {
        return $this->_z;
    }
    public function setW($w)
    {    
        $this->_w = $w;
    }
    public function getW()
    {
        return $this->_w;
    }
    public function setColor(Color $color)
    {
        $this->_color = $color;
    }
    public function getColor()
    {
        return $this->_color;
    }
}

?>