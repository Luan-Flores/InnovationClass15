<?php
require_once "../config/database.php";
require_once "../models/Usuario.php";
require_once "AuthControllerClass.php"; 

$controller = new AuthController();

if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $controller->login();
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $controller->logout();
}
