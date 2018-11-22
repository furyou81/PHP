#!/usr/bin/php
<?PHP
    if ($argc == 2)
    {
        $path = $argv[1];
        $fd = curl_init();
        curl_setopt($fd, CURLOPT_URL, $argv[1]); 
        curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);

        $str = curl_exec($fd);
        preg_match_all('/(?<=<img)[^>]*(?=>)/',$str, $tab);
        $img = [];
        foreach ($tab[0] as $t)
        {
            if (preg_match('/(?<=src)[ ]*=[ ]*"[^"]*(?=")/',$t, $tmp) == 1)
            {
                preg_match('/[^" ]*$/',$tmp[0], $ttmp);
                array_push($img, $ttmp[0]);
            }
        }
        if (preg_match("/((?<=http:\/\/)|(?<=https:\/\/)|www.)[^\/]*/", $argv[1], $dir) == 1)
        {
            if (is_dir($dir[0]) == 0)
                 mkdir($dir[0]);
            foreach ($img as $im)
			{
				if (preg_match("/;base64/", $im) == 0)
				{
					preg_match("/(?<=\/)[^\/]*$/", $im, $img_name);
               		if (preg_match("/^(http:\/\/|https:\/\/|www.)/", $im) == 1)
                   		@file_put_contents($dir[0] . "/" . $img_name[0], file_get_contents($im));
                	else
						@file_put_contents($dir[0] . "/" . $img_name[0], file_get_contents("http://" . $dir[0] . $im));
				}
            }
        }
    }
?>
