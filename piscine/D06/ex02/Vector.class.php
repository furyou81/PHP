<?PHP
    require_once 'Vertex.class.php';
    Class Vector
    {
        private $_x;
        private $_y;
        private $_z;
        private $_w;
        static $verbose = FALSE;

    function __construct(array $ver)
    {   
        $this->w = 0.0;
        if (array_key_exists("dest", $ver))
        {
            $this->_x = $ver["dest"]->getX();
            $this->_y = $ver["dest"]->getY();
            $this->_z = $ver["dest"]->getZ();
            $this->_w = 0.0;
            if (array_key_exists("orig", $ver))
            {
                $this->_x -= $ver["orig"]->getX();
                $this->_y -= $ver["orig"]->getY();
                $this->_z -= $ver["orig"]->getZ();
            }
        }
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
        return ("Vector( x:" . number_format($this->getX(), 2) . ", y:" . number_format($this->getY(), 2) . ", z:" . number_format($this->getZ(), 2) . ", w:" . number_format($this->getW(), 2) . " )");
    }
    static function doc()
    {
        return (file_get_contents("Vector.doc.txt") . PHP_EOL);
    }
    public function magnitude()
    {
        return (sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2)));
    }
    public function normalize()
    {
        if ($this->magnitude() === 0)
        {
            return (new Vector(array("dest" => new Vertex( array( 'x' => $this->getX(), 'y' => $this->getY(), 'z' => $this->getZ() ) ))));
        }
        else
            return (new Vector(array("dest" => new Vertex( array( 'x' => $this->getX() / $this->magnitude(), 'y' => $this->getY() / $this->magnitude(), 'z' => $this->getZ() / $this->magnitude() ) ))));
    }
    public function add(Vector $rhs)
    {
        return (new Vector(array("dest" => new Vertex( array( 'x' => $this->getX() + $rhs->getX(), 'y' => $this->getY() + $rhs->getY(), 'z' => $this->getZ() + $rhs->getZ() ) ))));
    }
    public function sub(Vector $rhs)
    {
        return (new Vector(array("dest" => new Vertex( array( 'x' => $this->getX() - $rhs->getX(), 'y' => $this->getY() - $rhs->getY(), 'z' => $this->getZ() - $rhs->getZ() ) ))));
    }
    public function opposite()
    {
        return (new Vector(array("dest" => new Vertex( array( 'x' => -$this->getX(), 'y' => -$this->getY(), 'z' => -$this->getZ()) ))));
    }
    public function scalarProduct($k)
    {
        return (new Vector(array("dest" => new Vertex( array( 'x' => $this->getX() * $k, 'y' => $this->getY() * $k, 'z' => $this->getZ() * $k) ))));
    }
    public function  dotProduct(Vector $rhs)
    {
        return ($this->getX() * $rhs->getX() + $this->getY() * $rhs->getY() + $this->getZ() * $rhs->getZ());
    }
    public function cos(Vector $rhs)
    {
        return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
    }
    public function crossProduct(Vector $rhs)
    {
        return (new Vector(array("dest" => new Vertex(array("x" => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(), "y" => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(), "z" => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX())))));
    }
    public function getX()
    {
        return $this->_x;
    }
    public function getY()
    {
        return $this->_y;
    }
    public function getZ()
    {
        return $this->_z;
    }
    public function getW()
    {
        return $this->_w;
    }
}

?>