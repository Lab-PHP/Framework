<?php

class Mobile {

    public $layout = "mobile";

    public function __construct() {
        
    }

    public function index() {
        $meta = array
            (
            'title' => 'Administrador del CMS',
            'description' => 'El mejor CMS creado para ayudar a nustros usuarios a contruir sus webs.',
            'keywords' => 'php, framework, mvc, cms',
            'author' => 'GCSProsoft',
            'robots' => 'All',
            'url_logo' => '/assets/uploads/logos/admin/logo.png',
            'alt_logo' => 'logo de app'
        );
        return View::render('mobile', ['meta' => $meta]);
    }

}