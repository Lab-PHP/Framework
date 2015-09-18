<?php
class Front 
{
    public $layout = "layouts/front";
    public function __construct() {
        
    }
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
        return VIEW::render('front/index', ['meta' => $meta]);
    }

    public function page_404(){
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
        return VIEW::render('front/page_404', ['meta' => $meta]);
    }

    public function login(){
        // die('die login');
        if(Input::exists()){
            if(Token::check(Input::get('token'))){
                $validate = new Validate();
                $validation = $validate->check($_POST,array(
                    'DNI' => array('required' => true),
                    'Contrasena' => array('required' => true)
                ));
                if($validation->passed()){          
                    $login = Auth::login(
                        Input::get('DNI'),
                        Input::get('Contrasena')
                    );
                    if($login){
                        Redirect::to('admin/index');
                        die();
                    }else{
                        Session::flash('login',array(
                            'message' => 'Usuario o Passwords Incorrectos!',
                            'class' => 'danger'
                        ));
                    }
                }else{
                    Session::flash('errores',$validation->errors());
                }
            }
        }

        Redirect::to('front/index');
    }
}