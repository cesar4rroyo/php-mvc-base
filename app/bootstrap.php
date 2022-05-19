
<?php

    //Load Config file
    require_once 'config/config.php';


    //Autoload Core and Libraries 
    spl_autoload_register(function($className) {
        require_once 'libreries/' . $className . '.php';
    });

    $core = new Core();