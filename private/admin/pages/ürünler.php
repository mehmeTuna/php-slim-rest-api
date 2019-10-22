<?php

namespace Ürünler ;

require_once __DIR__ . "/../../../database/connect.php";

use DATABASE\Database ;
use PDO ;

$categoryId = "all";
$page = 0;
$tablePage = 1;

if(isset($_GET) && isset($_GET["categoryId"])){
  $categoryId = strip_tags(trim($_GET["categoryId"]));  
}


if(isset($_GET) && isset($_GET["page"])){
 $page = strip_tags(trim($_GET["page"]));
}


$allProduct = array();

$db = new Database();
$db = $db->conn ;


/* Ürünler sorgu kısmı  */
//TODO bir düzene sokulması lazım
$pageCount = $page * 10 ;

if($categoryId == "all"){
  $allProductQuery = "SELECT * FROM products LIMIT 0,10" ;
  
}else if($categoryId != "" && $page != "")
  $allProductQuery = "SELECT * FROM products where categoryId='{$categoryId}' LIMIT {$pageCount},10";
else if($categoryId != ""){
  $allProductQuery = "SELECT * FROM products where categoryId='{$categoryId}' LIMIT 0,10";
}
 


//db deki ürün sayısını öğrenme
$productCount = $db->query("SELECT count(*) from products", PDO::FETCH_ASSOC) ;
foreach($productCount as $result)
   $productCount = $result["count(*)"];



$resultAllProduct = $db->query($allProductQuery , PDO::FETCH_ASSOC);
if($resultAllProduct->rowCount()){
     
  foreach($resultAllProduct as $value){

     $categoryName = $db->query("SELECT name from category WHERE id='{$value['categoryId']}'", PDO::FETCH_ASSOC) ;
     foreach($categoryName as $result)
        $categoryName = $result["name"];

      array_push($allProduct , 
        array(
          "id"=>$value["id"],
          "price"=>$value["price"],
          "name"=>$value["name"],
          "date"=>$value["date"],
          "numberOfProduct"=>$value["numberOfProduct"],
          "categoryName"=>$categoryName,
          "unlimited"=>$value["unlimited"],
          "live"=>$value["live"],
          "card_text"=>$value["card_text"],
          "stores"=>$value["stores"],
        )
       );
  }

}else {
  echo "<h1>HATA ÜRÜNLER</h1>" ;
}




//kategori kısmı
$allCategory = array();
$allCategoryQuery = "SELECT * FROM category";
$resultAllCategory = $db->query($allCategoryQuery , PDO::FETCH_ASSOC);
if($resultAllCategory->rowCount()){
     
  foreach($resultAllCategory as $value){

      array_push($allCategory , 
        array(
          "id"=>$value["id"],
         "name"=>$value["name"]
        )
       );
  }

}else {
  echo "<h1>HATA</h1>" ;
}


?>


          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Toplam <?=$productCount?> adet ürün var </h1>
          <p class="mb-4">Tüm ürünler aşağıda listelenmekte</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 row">
              <span class="m-0 font-weight-bold text-primary col-8">Kategori:</span>

                    <span class="col-4">
                        <label class="m-0 font-weight-bold text-primary">Kategori Seçiniz: </label>
                            <select id="inputState"  class="form-control" onchange="category(this.value)">
                            <option value="all" >Hepsi</option>
                            <?php foreach($allCategory as $result){ ?>
                              
                            <option  value="<?=$result["id"]?>"  <?php echo ($categoryId == $result["id"]) ? "selected" : "" ?> ><?=$result["name"]?></option>
                            <?php } ?>
                        </select>
                    </span>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Düzenle</th>
                      <th>Fiyat</th>
                      <th>İsmi</th>
                      <th>Stok</th>
                      <th>kategori</th>
                      <th>Açıklama</th>
                      <th>Mağaza</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <th>Düzenle</th>
                      <th>Fiyat</th>
                      <th>İsmi</th>
                      <th>Stok</th>
                      <th>kategori</th>
                      <th>Açıklama</th>
                      <th>Mağaza</th>
                  </tfoot>
                  <tbody>
                     
                       <?php foreach($allProduct as $result) { ?>
                        <tr>
                        <td></td>
                        <td><?=$result["price"]?>₺</td>
                        <td><?=$result["name"]?></td>
                        <td><?=$result["numberOfProduct"]?></td>
                        <td><?=$result["categoryName"]?></td>
                        <td><?=$result["card_text"]?></td>
                        <td><?=$result["stores"]?></td>
                        </tr>
                       <?php } ?>
                   
                  </tbody>

             
              <script>
                  function category(val){
                  
                          $.get("http://localhost:81/admin/ürünler/"+val+"/0", {suggest: ""}, function(result){
                          $("#"+container).html(result);
                          });
                      
                  }

                  function page(val){
                    let categoryId =  document.getElementById("inputState").value;

                      $.get("http://localhost:81/admin/ürünler/"+categoryId+"/"+val, {suggest: ""}, function(result){
                        $("#"+container).html(result);
                      });
                  }


                </script>

                </table>
              </div>
            </div>
          </div>
