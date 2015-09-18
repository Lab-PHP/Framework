<?php
class URL
{
	
	public function to($normalpath)
	{
		return Config::path('base').'/'.$normalpath;
	}

	static function base_url()
    {
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off")
        {
            $protocol = "https";
        }
        else
        {
            $protocol = "http";
        }
        $server_name = $_SERVER["SERVER_NAME"];
        $server_php_self = $_SERVER["PHP_SELF"];
        $path = explode("/", $server_php_self);
        array_pop($path);
	
        if (in_array("mod_rewrite", apache_get_modules()))
        {
           array_pop($path);
           $path = implode("/", $path);
        }
        else
        {
           $path = implode("/", $path);
        }
        
        return $protocol."://".$server_name.$path;
    }
    
    static function redirect($url)
    {
        header("location: $url");
        exit();
    }

    static function create_action_url($r, $parameters=null)
    {
        if (in_array("mod_rewrite", apache_get_modules()))
        {
            $p = null;
            $config = new Config();
            $rule = $config->rules[$r];
            $r = $rule["?r=$r"];
            if (is_array($parameters))
            {
                foreach ($parameters as $param => $value)
                {
                   $p .= "/$param/$value"; 
                }
            }
            return URL::base_url()."/".$r."".$p."";
        }
        else
        {
        $p = null;
        if (is_array($parameters))
        {
            foreach($parameters as $param => $value)
            {
                $p .= "&$param=$value";
            }
        }
        return URL::base_url()."/index.php?r=".$r."".$p."";
        }
    }
    
    static function redirect_to_action($r, $parameters=null)
    {
        if (in_array("mod_rewrite", apache_get_modules()))
        {
            $p = null;
            $config = new Config();
            $rule = $config->rules[$r];
            $r = $rule["?r=$r"];
            if (is_array($parameters))
            {
                foreach ($parameters as $param => $value)
                {
                   $p .= "/$param/$value"; 
                }
            }
            return header("location: ".URL::base_url()."/".$r."".$p."");
        }
        else
        {
	        $p = null;
	        if (is_array($parameters))
	        {
	            foreach($parameters as $param => $value)
	            {
	                $p .= "&$param=$value";
	            }
	        }
	        header("location: ".URL::base_url()."/index.php?r=".$r."".$p."");
	        exit();
        }
    }
}