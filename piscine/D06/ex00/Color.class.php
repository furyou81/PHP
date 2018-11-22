<?PHP
    Class Color
    {
        public $red;
        public $green;
        public $blue;
        static $verbose = FALSE;

        function __construct(array $rgb)
        {   
            if (array_key_exists("rgb", $rgb))
            {
                $this->red = ((intval($rgb["rgb"]) / 256 / 256) % 256 );
                $this->green = ((intval($rgb["rgb"]) / 256) % 256 );
                $this->blue = (intval($rgb["rgb"]) % 256 );
            }
            else if (array_key_exists("red", $rgb) && array_key_exists("green", $rgb) && array_key_exists("blue", $rgb))
            {
                $this->red = intval($rgb["red"]);
                $this->green = intval($rgb["green"]);
                $this->blue = intval($rgb["blue"]);
            }
            if (self::$verbose == TRUE)
                echo $this->__toString() . " constructed." . PHP_EOL;
            return ;
        }
        function add(Color $color)
        {
            return (new Color( array( 'red' => $color->red + $this->red, 'green' => $color->green + $this->green, 'blue' => $color->blue + $this->blue)));
        }
        function sub(Color $color)
        {
            return (new Color( array( 'red' => $this->red - $color->red, 'green' => $this->green - $color->green, 'blue' => $this->blue - $color->blue)));
        }
        function mult($mult)
        {
            return (new Color( array( 'red' => $this->red * $mult, 'green' => $this->green * $mult, 'blue' => $this->blue * $mult)));
        }
        function __destruct()
        {
            if (self::$verbose == TRUE)
                echo $this->__toString() . " destructed." . PHP_EOL;
            return ;
        }
        function __toString()
        {
            return ("Color( red: " . str_pad($this->red, 3, " ", STR_PAD_LEFT) . ", green: " . str_pad($this->green, 3, " ", STR_PAD_LEFT) . ", blue: " . str_pad($this->blue, 3, " ", STR_PAD_LEFT) ." )");
        }
        static function doc()
        {
            return (file_get_contents("Color.doc.txt") . PHP_EOL);
        }

    }
?>