<?php

class Categories {

    public $layout = "admin";

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
        return View::render('categories', ['meta' => $meta]);
    }

    public function crud_op() {
        $equvalencia = $_POST["proseso"];
        if (Input::exists()) {
            if (Token::check(Input::get('token_form'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'name_es' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 20),
                    'name_en' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 20)
                ]);
                if ($validation->passed()) {
                    if ($equvalencia === "new") {
                        Category::create([
                            'enable' => Input::get('enable'),
                            'icon' => Input::get('icon'),
                            'name_es' => Input::get('name_es'),
                            'name_en' => Input::get('name_en')
                        ]);
                    }
                    if ($equvalencia === "edit") {
                        Category::update([
                            'enable' => Input::get('enable'),
                            'icon' => Input::get('icon'),
                            'name_es' => Input::get('name_es'),
                            'name_en' => Input::get('name_en')
                                ], Input::get('id'));
                    }
                } else {
                    Session::flash('errores', $validation->errors());
                }
            } else {
                //regreso del tocken
            }
        }
    }

    public function editar_ajax() {
        $id = Input::get('id');
        $usuario = Usuario::find($id);
        echo json_encode($usuario);
    }

    public function eliminar($param) {
        DB::getInstance()->delete('usuario', [['id', '=', $param]]);
        Redirect::to('usuarios/index');
    }

    public function create_table() {
        DB::getInstance()->create_tb(
                'CREATE TABLE IF NOT EXISTS categories (
		id int(11) NOT NULL AUTO_INCREMENT,
                enable int(2) NOT NULL,
                icon varchar(30) COLLATE utf8_spanish_ci NOT NULL,
		name_es varchar(150) COLLATE utf8_spanish_ci NOT NULL,
                name_en varchar(150) COLLATE utf8_spanish_ci NOT NULL,
		PRIMARY KEY (id) )'
        );
        $crear_tb_categories->execute();
    }

}
