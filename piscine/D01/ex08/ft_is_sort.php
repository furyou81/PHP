<?PHP
    function    ft_is_sort(array $tab)
	{
		$i = 0;
        $old = $tab;
        sort($tab);
        foreach ($tab as $key=>$value)
            if ($value != $old[$key])
				$i++;;
		if ($i == 0)
			return (1);
		rsort($tab);
		$i = 0;
		foreach ($tab as $key=>$value)
            if ($value != $old[$key])
				$i++;;
		if ($i == 0)
			return (1);
        return (0);
    }
?>
