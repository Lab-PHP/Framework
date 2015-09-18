<?php
class Demo
{    
    public $layout = "layouts/front";
    public function index()
    {
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
        $demo = DB::getInstance()->select('*')->table('demo')->exec();
    	return VIEW::render('demo/index', ['meta' => $meta, 'demo' => $demo]);
    }
}