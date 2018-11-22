<?PHP
    function    ft_split($str)
	{
		if	(trim($str) == "")
			return ;
        $split = preg_split("/\s+/", trim($str));
        sort($split);
        return ($split);
	}
?>
