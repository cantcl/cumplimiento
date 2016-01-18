<?php

use InoOicClient\Flow\Basic;
use InoOicClient\Http;
use InoOicClient\Client;
use InoOicClient\Oic\Token;

class AuthController extends BaseController {

    private static $authConfig = array(
            'client_info' => array(
                'client_id' => '5ab7ffb178c991f1fceff173da4558a8',
                'redirect_uri' => 'http://dev.ad2020/oauth/callback',
                'authorization_endpoint' => 'https://www.claveunica.cl/oauth2/auth',
                'token_endpoint' => 'https://www.claveunica.cl/oauth2/token',
                'user_info_endpoint' => 'https://apis.modernizacion.cl/registrocivil/informacionpersonal/v1/info.php?access_token=',
                'authentication_info' => array(
                    'method' => 'client_secret_post',
                    'params' => array(
                        'client_secret' => 'bed7047b9ca68c0d045826ed2c2748d9'
                    )
                )
            )
        );

	public function getLogin() {
        return View::make('backend/auth/login');
	}

    public function requestOauth() {
        $flow = new Basic(self::$authConfig);

        if (! isset($_GET['redirect'])) {
            try {
                $uri = $flow->getAuthorizationRequestUri('basico');
                return Redirect::to($uri);
            } catch (\Exception $e) {
                printf("Exception during authorization URI creation: [%s] %s", get_class($e), $e->getMessage());
            }
        } else {
            try {
                $userInfo = $flow->process();
            } catch (\Exception $e) {
                printf("Exception during user authentication: [%s] %s", get_class($e), $e->getMessage());
            }
        }

    }

    public function responseOauth() {
        $flow = new Basic(self::$authConfig);
        $token = $flow->getAccessToken($_GET['code']);
        $user_raw = file_get_contents(self::$authConfig['client_info']['user_info_endpoint'] . $token);
        
        $infoPersonal=json_decode($user_raw,true);
        if (isset($user->error)) {
            die($user->error);
        }
        var_dump($infoPersonal);

        $rut = $infoPersonal['run'];
        $user = \Usuario::firstOrNew(array('rut'=>$rut));
        $user->rut = $rut;
        if(isset($infoPersonal->nombres) && $infoPersonal->nombres){
            $user->nombres = $infoPersonal['nombres'];
            $user->apellido_paterno = $infoPersonal['apellidoPaterno'];
            $user->apellido_materno = $infoPersonal['apellidoMaterno'];
        }
        $user->save();
        \Auth::login($user);
        return Redirect::to('backend/compromisos');
        
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('backend');
    }

    public function postLogin(){
        die('postLogin');
        $json=new stdClass();
        $existing = \Usuario::where('id', 1)->first();
        $user = Auth::user();
        die($user);
        if ($existing) {
            // $json->redirect=URL::to('backend');
            // $response=\Response::json($json,200);    
            return Redirect::to('backend');
        } else {
            die('Usuario no existe');
        }

        // return $response;
        
        // $validator = \Validator::make(\Input::all(), array(
        //         'email' => 'required|email',
        //         'password' => 'required'
        //     )
        // );

        // $json=new stdClass();
        // if ($validator->passes()) {
        //     $email=Input::get('email');
        //     $password=Input::get('password');

        //     if (Auth::attempt(array('email' => $email, 'password' => $password))){
        //         $json->redirect=URL::to('backend');
        //         $response=\Response::json($json,200);
        //     }else{
        //         $json->errors[]='Correo y/o contraseña incorrecto.';

        //        $response=\Response::json($json,400);
        //     }


        // } else {
        //     $json->errors=$validator->messages()->all();

        //     $response=\Response::json($json,400);


        // }

        // return $response;
    }

}
