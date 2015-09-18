<?php
class VIEW
{
	public static function render($view, $data = []){
        extract($data, EXTR_PREFIX_SAME, "wddx");
        $route = explode("/", $view);
        $controller = $route[0];
        $controller = ucfirst($controller);
        $app = new $controller;
        $layout = $app->layout;
        $content = Config::path('app')."/web/views/$view.php";
        require_once Config::path('app')."/public/theme/$layout.php";
    }
}