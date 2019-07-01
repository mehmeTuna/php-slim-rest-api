<?php

namespace Ürünler ;

require_once __DIR__ . "/../../../database/connect.php";

use DATABASE\Database ;
use PDO ;


$allOrders = array();

$db = new Database();
$db = $db->conn ;


/* Ürünler sorgu kısmı  */
//TODO bir düzene sokulması lazım
 $allOrderQuery = "SELECT * FROM order_items LIMIT 0,10" ;
 


//db deki ürün sayısını öğrenme
$productCount = $db->query("SELECT count(*) from order_items", PDO::FETCH_ASSOC) ;
foreach($productCount as $result)
   $OrderCount = $result["count(*)"];



$resultAllOrder = $db->query($allOrderQuery , PDO::FETCH_ASSOC);
if($resultAllOrder->rowCount()){
     
  foreach($resultAllOrder as $value){

     $categoryName = $db->query("SELECT firstname,lastname from users WHERE id='{$value['user_id']}'", PDO::FETCH_ASSOC) ;
     foreach($categoryName as $result)
        $name = $result["firstname"] . " " . $result["lastname"];

      array_push($allOrders , 
        array(
          "id"=>$value["order_id"],
          "price"=>$value["order_amount"],
          "name"=>$name,
          "icerik"=>$value["icerik"],
          "date"=>$value["m_date"],
          "orders"=>$value["orders"],
          "durum"=>$value["m_status"],
         
        )
       );
  }

}else {
  echo "<h1>HATA ÜRÜNLER</h1>" ;
}




?>


          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Siparişler </h1>
          <p class="mb-4">Şu an görülen Siparişler Mayıs ayına aittir.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 row">
              <span class="m-0 font-weight-bold text-primary col-8">Mayıs ayı siparişleri</span>

                    <span class="col-4">
                        <label class="m-0 font-weight-bold text-primary">Ay seçiniz</label>
                            <select id="inputState" class="form-control">
                            <option selected>Db den seç</option>
                            <option>2019-01</option>
                            <option>2019-02</option>
                            <option>2019-03</option>
                        </select>
                    </span>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sipariş Numarası</th>
                      <th>Ad Soyad</th>
                      <th>Tutar</th>
                      <th>Not </th>
                      <th>Tarih</th>
                      <th>Sipariş</th>
                      <th>Durum</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <th>Sipariş Numarası</th>
                      <th>Ad Soyad</th>
                      <th>Tutar</th>
                      <th>Not </th>
                      <th>Tarih</th>
                      <th>Sipariş</th>
                      <th>Durum</th>
                  </tfoot>
                  <tbody>
                    <?php foreach($allOrders as $value){ ?>
                    <tr>
                        <td><?=$value["id"]?></td>
                        <td><?=$value["name"]?></td>
                        <td><?=$value["price"]?></td>
                        <td><?=$value["icerik"]?></td>
                        <td><?=$value["date"]?></td>
                        <td><?=$value["orders"]?></td>
                        <td><?=$value["durum"]?></td>
                    </tr>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
