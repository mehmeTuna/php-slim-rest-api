<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

use Product\Category  ;
use Product\details   ;
use Admin\Product\product ;

//user create update delete and user data
$app->group('/user', function () use ($app , $user) {
    $app->post('/' , function (Request $request, Response $response, array $args ) use ($user){
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        $firstname = $request->getParam('firstname');
        $lastname = $request->getParam('lastname');
        $phone = $request->getParam('phone');
        $adress = $request->getParam('adress');

        $user->add($email , $password , $firstname , $lastname , $phone , $adress);
        $response->getBody()->write( $user->control() ? "veriler doğru" : "hatalı veri var" );

      $response->getBody()->write($user->userCreate() ? "kayıt başarılı" : "kayıt başarısız" );

      return $response;
    });
    $app->put('/' , function (Request $request, Response $response, array $args ) use ($user){
      //şifremi unuttum kısmı işlemleri bu kısımda yapılacak
    });
});



//admin create update delete and user data
$app->group('/admin/product/', function () use ($app) {
  $app->post('upload' , function (Request $request, Response $response, array $args ){
      $name = $request->getParam('name');
      $discount = $request->getParam('discount');
      $card_desc = $request->getParam('card_desc');
      $short_desc = $request->getParam('short_desc');
      $long_desc = $request->getParam('long_desc');
      $category = $request->getParam('category');
      $stok = $request->getParam('stok');
      $live = $request->getParam('live');
      $location = $request->getParam('location');

      $directory = $this->get('upload_directory');

      $uploadedFiles = $request->getUploadedFiles();
  
      // handle single input with single file upload
      $uploadedFile = $uploadedFiles['image_logo'];
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
          $filename = moveUploadedFile($directory, $uploadedFile);
          $image_logo = $filename ;
      }

     if( isset($uploadedFiles['product_img_1']) ){
      $uploadedFile = $uploadedFiles['product_img_1'];
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
          $filename = moveUploadedFile($directory, $uploadedFile);
          $product_img_1 =  $filename ;
      }
     }else $product_img_1 ="";

     if( isset($uploadedFiles['product_img_2']) ){
      $uploadedFile = $uploadedFiles['product_img_2'];
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
          $filename = moveUploadedFile($directory, $uploadedFile);
          $product_img_2 =  $filename ;
      }
     }else $product_img_2  ="";

     if( isset($uploadedFiles['product_img_3']) ){
      $uploadedFile = $uploadedFiles['product_img_3'];
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
          $filename = moveUploadedFile($directory, $uploadedFile);
          $product_img_3 =  $filename ;
      }
     }else $product_img_3  ="";

      $product = new product();
      $product->add($name , $discount , $card_desc , $short_desc , $long_desc , $image_logo , $product_img_1 , $product_img_2 , $product_img_3 , $category);
      $result = $product->addDb() ;
      $response->getBody()->write( $result );
    return $response;
  });
});


//details ürün id si ürüne ait detaylar verir
$app->get("/home/product/{details}" , function (Request $request, Response $response, array $args){
  $route = $request->getAttribute('route');
  $id = $route->getArgument('details'); 

  $detail = new details();
  $result = $detail->name($id)->run();
  $response->getBody()->write(json_encode($result , JSON_UNESCAPED_UNICODE) );
    
});



//name kategori ismi page kaçıncı sayfa olduğu
$app->get("/category/{name}/{page}" , function (Request $request, Response $response, array $args){
  $route = $request->getAttribute('route');
    $name = $route->getArgument('name');
    $page = $route->getArgument('page') ; 
    $categoryItem = new Category();
    $item = $categoryItem->name($name)->page($page)->run() ;
    $response->getBody()->write(json_encode($item , JSON_UNESCAPED_UNICODE));
    
});




$app->get("/" , function (Request $request, Response $response, array $args){

  if(isset($_SESION["user"])){
    echo "amacın ne?";
    //print_r($_SESION["user"]);
  }else {
    $response->getBody()->write("oturum ihlali");
  }
});




function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}