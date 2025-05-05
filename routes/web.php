<?php

$routes = [
    'login' => 'authController.php?action=login', 
    'register' => 'authController.php?action=register', 
    'logout' => 'logout.php',  
    'dashboard' => 'dashboard.php',  
];


$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = trim($requestUri, '/');  

if (array_key_exists($requestUri, $routes)) {
   
    header("Location: " . $routes[$requestUri]);
    exit;
} else {
   
    echo "404 Not Found";
}
?>
