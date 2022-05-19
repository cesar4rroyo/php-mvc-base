<?php

 /*
 *App Core Class
 * Crear URL & Cargar Controller
 * FORMATO DE LA URL - /controller/method/params
 */

 class Core 
 {
     protected $currentController = 'Pages';
     protected $currentMethod = 'index';
     protected $params = [];
     

     public function __construct() {
        $url = $this->getUrl();
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            //OBTENER EL CONTROLADOR
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //REQUERIR EL CONTROLADOR
        require_once '../app/controllers/' . $this->currentController . '.php';
        //INSTANCIAR LA CLASE DEL CONTROLADOR
        $this->currentController = new $this->currentController;
        //VERFICAR SEGUNDA PARTE DEL URL 'METODO'
        if(isset($url[1])) {
            //VERIFICAR SI EL METODO EXISTE EN EL CONTROLADRO
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        //OBTENER LOS PARAMETROS
        $this->params = $url ? array_values($url) : [];

        //LLAMAR A LA FUNCION CON LOS PARAMETROS
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    //FUNCION PARA OBTENER LA URL
    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        } else {
            $url = '';
        }
        return $url;
    }
 }