<?php

class UsuariosController extends BaseController {

    protected $layout='backend/template';

    function __construct(){
        if(!Auth::user()->super)
            App::abort(403, 'Unauthorized action.');
    }

    public function getIndex(){
        $this->layout->title = 'Usuarios';
        $this->layout->sidebar=View::make('backend/usuarios/sidebar',array('item_menu'=>'usuarios'));
        $this->layout->content = View::make('backend/usuarios/index', array('usuarios' => Usuario::all()));
    }

    public function getVer($usuario_id){
        $this->layout->title = 'Usuarios';
        $this->layout->sidebar=View::make('backend/usuarios/sidebar',array('item_menu'=>'usuarios'));
        $this->layout->content = View::make('backend/usuarios/view', array('usuario' => Usuario::find($usuario_id)));
    }

    public function getNuevo(){
        $this->layout->title = 'Usuarios';
        $this->layout->sidebar=View::make('backend/usuarios/sidebar',array('item_menu'=>'usuarios'));
        $this->layout->content = View::make('backend/usuarios/form', array('usuario' => new Usuario()));
    }

    public function getEditar($usuario_id){
        $this->layout->title = 'Usuarios';
        $this->layout->sidebar=View::make('backend/usuarios/sidebar',array('item_menu'=>'usuarios'));
        $this->layout->content = View::make('backend/usuarios/form', array('usuario' => Usuario::find($usuario_id)));
    }

    public function postGuardarjp(){
      $pre = Usuario::where('email', $_POST['email'])->count();
      if ($pre > 0){
        $identificador = 0;
      }else{
        $jp = new Usuario();
          $jp->nombres = $_POST['nombres'];
          $jp->apellidos = $_POST['apellidos'];
          $jp->email = $_POST['email'];
          $jp->rut = $_POST['rut'];
          $jp->telefono = $_POST['telefono'];
          $jp->super = 0;
          $jp->perfiles_id = 3;
          $jp->password = Hash::make($_POST['rut']);
        $jp->save();
        $identificador = $jp->id;
      }

      $json = array($identificador);//new stdClass();
      $response = Response::json($json, 200);
      return $response;
    }
    public function postGuardarrc(){
      $pre = Usuario::where('email', $_POST['email'])->count();
      if ($pre > 0){
        $identificador = 0;
      }else{
        $jp = new Usuario();
          $jp->nombres = $_POST['nombres'];
          $jp->apellidos = $_POST['apellidos'];
          $jp->email = $_POST['email'];
          $jp->rut = $_POST['rut'];
          $jp->telefono = $_POST['telefono'];
          $jp->super = 0;
          $jp->perfiles_id = 4;
          $jp->password = Hash::make($_POST['rut']);
        $jp->save();
        $identificador = $jp->id;
      }

      $json = array($identificador);
      $response = Response::json($json, 200);
      return $response;
    }

    public function postGuardar($usuario_id = null){

        $validator = Validator::make(Input::all(),array(
            'nombres' => 'required',
            'rut' => 'required',
            'apellidos' => 'required',
            'email' => 'required',
            'super' => 'required',
            'telefono' => 'required',
            'password' => ($usuario_id ? 'confirmed' : 'required|confirmed')
        ));

        $json = new stdClass();
        if($validator->passes()){
            $usuario = $usuario_id ? Usuario::find($usuario_id) : new Usuario();
            $success_msg = $usuario_id ? "actualizado." : "creado.";

            if(Input::get('password'))
              $usuario->password = Hash::make(Input::get('password'));

            $usuario->nombres = Input::get('nombres', '');
            $usuario->apellidos = Input::get('apellidos', '');
            $usuario->email = Input::get('email', '');
            $usuario->rut = Input::get('rut');
            $usuario->telefono = Input::get('telefono');
            $usuario->super = Input::get('super');

            $usuario->perfiles_id = Input::get('perfiles_id');

            $usuario->save();

            $json->errors = array();
            $json->redirect = URL::to('backend/usuarios');

            Session::flash('messages', array('success' => 'El usuario '. $usuario->nombre_completo .' ha sido ' . $success_msg));

            $response = Response::json($json, 200);
        } else {
            $json->errors = $validator->messages()->all();
            $response = Response::json($json, 400);
        }

        return $response;
    }

    public function getEliminar($usuario_id){
        $usuario = Usuario::find($usuario_id);
        $this->layout = View::make('backend/ajax_template');
        $this->layout->title = 'Eliminar Usuario';
        $this->layout->content = View::make('backend/usuarios/delete', array('usuario' => $usuario));
    }

    public function deleteEliminar($usuario_id){
        $usuario = Usuario::find($usuario_id);
        $usuario->delete();

        return Redirect::to('backend/usuarios')->with('messages', array('success' => 'El usuario ' . $usuario->nombre_completo . ' ha sido eliminado.'));
    }
}
