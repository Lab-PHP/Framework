<?php
class App
{   
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    protected $path_controllers = '../web/controllers/';


    function __construct()
    {
        require_once Config::path('app') . '/core/engine/Htaccess.php';
        HTACCESS::$DirectoryIndex = Config::get('DirectoryIndex');
        HTACCESS::$ErrorPage = Config::get('ErrorPage');
        HTACCESS::$rules = Config::get('rules');
        HTACCESS::run();
        
        $url = $this->parseURL();

        if(isset($url[0]))
        {
            $url[0] = ucfirst($url[0]);
            if(file_exists($this->path_controllers.$url[0].'.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);         
                require_once $this->path_controllers . $this->controller.'.php';
                $this->controller = new $this->controller;      
                if(isset($url[1]))
                {
                    if(method_exists($this->controller, $url[1]))
                    {
                        $this->method = $url[1];
                        unset($url[1]);             
                    }else{
                        Redirect::to(404);
                        die();
                    }
                }
                $this->params = $url ? array_values($url): [];
                call_user_func_array([$this->controller,$this->method], $this->params);
            }else{

                Redirect::to(404);
            }
        }else{
            require_once $this->path_controllers . $this->controller.'.php';
            $this->controller = new $this->controller;
            $this->params = [];
            call_user_func_array([$this->controller,$this->method], $this->params); 
        }
    }

    public function parseURL()
    {
        if(isset($_GET['r'])){
            return $url = explode('/',filter_var(rtrim($_GET['r'],'/'),FILTER_SANITIZE_URL)); 
        }
    }
}