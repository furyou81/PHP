<?PHP
    include_once('Fighter.class.php');
    class UnholyFactory
    {
        private $_army = [];
        private $_map = array(
            "Footsoldier" => "foot soldier",
            "Archer" => "archer",
            "Assassin" => "assassin",
            "Llama" => "llama",
            "CrippledSoldier" => "crippled soldier"
        );
        public function fabricate($f)
        {
            $yet = 0;
            $s = "";
            foreach ($this->_army as $solider)
            {
                if ($this->_map[get_class($solider)] == $f)
                {
                    echo "(Factory fabricates a fighter of type " . $f .")" . PHP_EOL;
                    $s = get_class($solider);
                    $yet = 1;
                }
            }
            if ($yet == 0)
            {
                echo "(Factory hasn't absorbed any fighter of type " . $f . ")" . PHP_EOL;
            }
            if ($yet == 1)
                return (new $s);
            else
                return ("");
        }
        public function absorb($f)
        {
            if ($f instanceof Fighter)
            {
                $yet = 0;
                foreach ($this->_army as $solider)
                {
                    if (get_class($solider) == get_class($f))
                    {
                        echo "(Factory already absorbed a fighter of type " . $this->_map[get_class($f)] . ")" . PHP_EOL;
                        $yet = 1;
                    }
                }
                if ($yet == 0)
                {
                  //  if (array_key_exists(get_class($f), $this->_map))
                    echo "(Factory absorbed a fighter of type " . $this->_map[get_class($f)] . ")" . PHP_EOL;
                    array_push($this->_army, $f);
                }
            }
            else
                echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
        }
    }
?>