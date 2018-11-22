<?PHP
    require_once 'Vertex.class.php';
    require_once 'Vector.class.php';
    Class Matrix
    {
        const   IDENTITY = "IDENTITY";
        const   SCALE = "SCALE preset";
        const   RX = "Ox ROTATION preset";
        const   RY = "Oy ROTATION preset";
        const   RZ = "Oz ROTATION preset";
        const   TRANSLATION = "TRANSLATION preset";
        const   PROJECTION = "PROJECTION preset";
        private $_matrice = array();
        private $m = "";
        static $verbose = FALSE;

    function __construct(array $mat)
    {   
        $this->w = 0.0;
        if (array_key_exists("preset", $mat))
        {
            switch ($mat["preset"])
            {
                case $this::IDENTITY:
                    $this->_m = $this::IDENTITY;
                    $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                    $this->_matrice[] = ["x", 1.00, 0.00, 0.00, 0.00];
                    $this->_matrice[] = ["y", 0.00, 1.00, 0.00, 0.00];
                    $this->_matrice[] = ["z", 0.00, 0.00, 1.00, 0.00];
                    $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                    break;
                case $this::TRANSLATION:
                    if (array_key_exists("vtc", $mat))
                    {
                        $this->_m = $this::TRANSLATION;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", 1.00, 0.00, 0.00, $mat["vtc"]->getX()];
                        $this->_matrice[] = ["y", 0.00, 1.00, 0.00, $mat["vtc"]->getY()];
                        $this->_matrice[] = ["z", 0.00, 0.00, 1.00, $mat["vtc"]->getZ()];
                        $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                        break;
                    }
                case $this::SCALE:
                    if (array_key_exists("scale", $mat))
                    {
                        $this->_m = $this::SCALE;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", 1.00 * $mat["scale"], 0.00, 0.00, 0.00];
                        $this->_matrice[] = ["y", 0.00, 1.00 * $mat["scale"], 0.00, 0.00];
                        $this->_matrice[] = ["z", 0.00, 0.00, 1.00 * $mat["scale"], 0.00];
                        $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                        break;
                    }
                case $this::RX:
                    if (array_key_exists("angle", $mat))
                    {
                        $this->_m = $this::RX;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", 1.00, 0.00, 0.00, 0.00];
                        $this->_matrice[] = ["y", 0.00, cos($mat["angle"]), -sin($mat["angle"]), 0.00];
                        $this->_matrice[] = ["z", 0.00, sin($mat["angle"]), cos($mat["angle"]), 0.00];
                        $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                        break;
                    }
                case $this::RY:
                    if (array_key_exists("angle", $mat))
                    {
                        $this->_m = $this::RY;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", cos($mat["angle"]), 0.00, sin($mat["angle"]), 0.00];
                        $this->_matrice[] = ["y", 0.00, 1.00, 0.00, 0.00];
                        $this->_matrice[] = ["z", -sin($mat["angle"]), 0.00, cos($mat["angle"]), 0.00];
                        $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                        break;
                    }
                case $this::RZ:
                    if (array_key_exists("angle", $mat))
                    {
                        $this->_m = $this::RZ;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", cos($mat["angle"]), -sin($mat["angle"]), 0.00, 0.00];
                        $this->_matrice[] = ["y", sin($mat["angle"]), cos($mat["angle"]), 0.00, 0.00];
                        $this->_matrice[] = ["z", 0.00, 0.00, 1.00, 0.00];
                        $this->_matrice[] = ["w", 0.00, 0.00, 0.00, 1.00];
                        break;
                    }
                case $this::PROJECTION:
                    if (array_key_exists("fov", $mat) && array_key_exists("far", $mat) && array_key_exists("near", $mat) && array_key_exists("ratio", $mat))
                    {
                        $d = 1 / tan(deg2rad($mat["fov"]) / 2);
                        $this->_m = $this::PROJECTION;
                        $this->_matrice[] = ["M", "vtcX", "vtcY", "vtcZ", "vtxO"];
                        $this->_matrice[] = ["x", $d / $mat["ratio"], 0.00, 0.00, 0.00];
                        $this->_matrice[] = ["y", 0.00, $d, 0.00, 0.00];
                        $this->_matrice[] = ["z", 0.00, 0.00, ($mat["far"] + $mat["near"]) / ($mat["near"] - $mat["far"]), (2 * $mat["far"] * $mat["near"]) / ($mat["near"] - $mat["far"])];
                        $this->_matrice[] = ["w", 0.00, 0.00, -1.00, 0.00];
                        break;
                    }
            }
        }
        else if (array_key_exists("m", $mat))
        {
            $this->_matrice = $mat["m"];
        }
        if (self::$verbose == TRUE && $this->_m != "")
            echo "Matrix " . $this->_m . " instance constructed" . PHP_EOL;
        return ;
    }
    function __destruct()
    {
        if (self::$verbose == TRUE)
        echo "Matrix instance destructed" . PHP_EOL;
        return ;
    }
    function __toString()
    {
        $str = "";
        $i = 0;
        foreach($this->_matrice as $m)
        {
            if ($i == 1)
                $str .= "-----------------------------" . PHP_EOL;
            $j = 0;
            foreach($m as $c)
            {
                if ($i > 0 && $j > 0)
                    $str .= number_format($c, 2);
                else
                    $str .= $c;
                if ($j < 4)
                    $str .= " | ";
                $j++;
            }
            if ($i < 4)
            $str .= PHP_EOL;
            $i++;
        }
        return ($str);
    }
    static function doc()
    {
        return (file_get_contents("Matrix.doc.txt") . PHP_EOL);
    }
    public function mult(Matrix $rhs)
    {
        $tmp = $this->getMatrice();
        $v = $this->getMatrice();
        $t = $rhs->getMatrice();
        $i = 1;
        while ($i <= 4)
        {
            $j = 1;
            while ($j <= 4)
            {
                $tmp[$i][$j] = $v[$i][1] * $t[1][$j] + $v[$i][2] * $t[2][$j] + $v[$i][3] * $t[3][$j] + $v[$i][4] * $t[4][$j];
                $j++;
            }
            $i++;
        }
        return (new Matrix(array("m" => $tmp)));
    }
    public function transformVertex(Vertex $vtx)
    {
        $m = $this->getMatrice();
        $x = 0;
        $y = 0;
        $z = 0;
        $x = $m[1][1] * $vtx->getX() + $m[1][2] * $vtx->getY() + $m[1][3] * $vtx->getZ() + $m[1][4] * $vtx->getW();
        $y = $m[2][1] * $vtx->getX() + $m[2][2] * $vtx->getY() + $m[2][3] * $vtx->getZ() + $m[2][4] * $vtx->getW();
        $z = $m[3][1] * $vtx->getX() + $m[3][2] * $vtx->getY() + $m[3][3] * $vtx->getZ() + $m[3][4] * $vtx->getW();
        return (new Vertex(array("x" => $x, "y" => $y, "z" => $z)));
    }
    public function getMatrice()
    {
        return $this->_matrice;
    }
}
?>