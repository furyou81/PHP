<?PHP
    include_once('Lannister.class.php');
    include_once('Tyrion.class.php');
    class Jaime extends Lannister
    {
        public function sleepWith($t)
        {   if ($t instanceof Tyrion)
                echo "Not even if I'm drunk !" . PHP_EOL;
            else if ($t instanceof Lannister)
                echo "With pleasure, but only in a tower in Winterfell, then." . PHP_EOL;
            else
                echo "Let's do this." . PHP_EOL;
        }
    }
?>