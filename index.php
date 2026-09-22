<?php

require_once "core/Model.php";
require_once "core/Controller.php";
require_once "core/Router.php";

require_once "models/User.php";
require_once "models/Photo.php";
require_once "models/Comment.php";

require_once "controllers/HomeController.php";
require_once "controllers/AuthController.php";
require_once "controllers/PhotoController.php";


$router = new Router();


$router->get("#^/alzikrayat/$#", function () {

    $controller = new HomeController();

    $controller->index();
});


$router->get("#^/alzikrayat/register$#", function () {

    $controller = new AuthController();

    $controller->register();
});


$router->post("#^/alzikrayat/register$#", function () {

    $controller = new AuthController();

    $controller->register();
});


$router->get("#^/alzikrayat/login$#", function () {

    $controller = new AuthController();

    $controller->login();
});


$router->post("#^/alzikrayat/login$#", function () {

    $controller = new AuthController();

    $controller->login();
});


$router->get("#^/alzikrayat/logout$#", function () {

    $controller = new AuthController();

    $controller->logout();
});


$router->get("#^/alzikrayat/photo/upload$#", function () {

    $controller = new PhotoController();

    $controller->upload();
});


$router->post("#^/alzikrayat/photo/upload$#", function () {

    $controller = new PhotoController();

    $controller->upload();
});


$router->get("#^/alzikrayat/photo/([0-9]+)$#", function ($id) {

    $controller = new PhotoController();

    $controller->details($id);
});


$router->post("#^/alzikrayat/photo/([0-9]+)/comment$#", function ($id) {

    $controller = new PhotoController();

    $controller->comment($id);
});


$router->post("#^/alzikrayat/photo/([0-9]+)/delete$#", function ($id) {

    $controller = new PhotoController();

    $controller->delete($id);
});


$router->dispatch();