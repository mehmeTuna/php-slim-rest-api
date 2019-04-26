<?php
session_start();

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];


require __DIR__ .'/vendor/autoload.php';
include __DIR__ .'/../database/connect.php';


include __DIR__ ."/../private/Users/Users.php";
include __DIR__ ."/../public/product.php";
include __DIR__ ."/../public/product/details.php";
include __DIR__ ."/../private/admin/product/create.php";




$app = new \Slim\App($config);

//upload file
$container = $app->getContainer();
$container['upload_directory'] = __DIR__ . '/../uploads/';

$user = new Users\User() ;


require __DIR__ . '/src/routes.php';

// Run app
$app->run();
