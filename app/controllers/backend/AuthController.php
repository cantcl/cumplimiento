<?php

use InoOicClient\Flow\Basic;
use InoOicClient\Http;
use InoOicClient\Client;
use InoOicClient\Oic\Token;

class AuthController extends BaseController {

    protected $authConfig;

    public function __construct(){

        $this->authConfig = array(
            'client_info' => array(
                'client_id' => $_ENV['claveunica_client_id'],
                'redirect_uri' => 'http://dev.desarrollodigital.modernizacion.gob.cl/oauth/callback',
                'authorization_endpoint' => 'https://www.claveunica.gob.cl/openid/authorize',
                'token_endpoint' => 'https://www.claveunica.gob.cl/openid/token',
                'user_info_endpoint' => 'https://www.claveunica.gob.cl/openid/userinfo',
                'authentication_info' => array(
                    'method' => 'client_secret_post',
                    'params' => array(
                        'client_secret' => $_ENV['claveunica_secret']
                    )
                )
            )
        );
    }

    public function getLogin() {
        return View::make('backend/auth/login');
	}

    public function requestOauth() {
        $flow = new Basic($this->authConfig);
        if (! isset($_GET['redirect'])) {
            try {
                $uri = $flow->getAuthorizationRequestUri('openid nombre');
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

        $flow = new Basic($this->authConfig);

        if (isset($_GET['error']) && isset($_GET['error_message'])) { // salida por si presionan cancelar
            return View::make('backend/auth/login')->with('error_msg', 'Claveúnica ha entregado el siguiente error: <strong>' . $_GET['error'] . "</strong>.<p>Por favor, contacte al Administrador del Sistema</p>");
        }
        
        if (isset($_GET['code'])) {
            $token = $flow->getAccessToken($_GET['code']);
        } else {
            return View::make('backend/auth/login')->with('error_msg', "No se terminó el proceso de validación. Por favor, contacte al Administrador del Sistema");
        }

        $infoPersonal = $flow->getUserInfo($token);
        $rut = $infoPersonal['RUT'];
        $user = \Usuario::where('rut', $rut)->first();
        if ($user !== null) {
            $user->rut = $rut;
            if(isset($infoPersonal->nombres) && $infoPersonal->nombres){
                $user->nombres = $infoPersonal['nombres'];
                $user->apellido_paterno = $infoPersonal['apellidoPaterno'];
                $user->apellido_materno = $infoPersonal['apellidoMaterno'];
            }
            \Auth::login($user);
            return Redirect::to('backend/compromisos');
        } else {
            $error_msg = "Su usuario no se encuentra registrado en esta aplicación. Contacte al Administrador del sistema";
            return View::make('backend/auth/login')->with('error_msg', $error_msg);
        }

    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('backend');
    }

}
