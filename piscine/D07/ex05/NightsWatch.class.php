<?PHP
include_once('IFighter.class.php');
    class NightsWatch
    {
        private $_fighters = [];
        public function recruit($f)
        {
            if ($f instanceof IFighter)
                array_push($this->_fighters, $f);
        }
        public function fight()
        {
            foreach($this->_fighters as $f)
                $f->fight();
        }

    }
?>