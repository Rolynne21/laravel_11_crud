<?php

require_once 'AuthController.php';  
require_once 'web.php';  

$authController = new AuthController();


if (isset($routes[$_SERVER['REQUEST_URI']])) {

    $action = explode('=', $routes[$_SERVER['REQUEST_URI']])[1];
    
    
    if ($action === 'login') {
        $authController->login();
    } elseif ($action === 'register') {
        $authController->register();
    }
} else {
    echo "404 Not Found"; 
}
?>
