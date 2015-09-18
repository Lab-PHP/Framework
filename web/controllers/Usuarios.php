<?php

class Usuarios {

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
        return View::render('usuario', ['meta' => $meta]);
    }

    public function crud_op() {
        $equvalencia = $_POST["proseso"];
        if (Input::exists()) {
            if (Token::check(Input::get('token_form'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                        //campos de valiadcion ojo con los parentesis
                ]);
                if ($validation->passed()) {
                    if ($equvalencia === "new") {
                        Usuario::create([
                                //campos ingreso de informacion
                        ]);
                    }
                    if ($equvalencia === "edit") {
                        Usuario::update([
                                //campos de edicion de informacion
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
}
