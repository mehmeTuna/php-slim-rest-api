<?php

namespace Ürünler ;

require_once __DIR__ . "/../../../database/connect.php";

use DATABASE\Database ;
use PDO ;



$allRezervasyon = array();

$db = new Database();
$db = $db->conn ;


/* Ürünler sorgu kısmı  */
//TODO bir düzene sokulması lazım
$nowDate = time();

  $allProductQuery = "SELECT * from rezervasyon WHERE time <='{$nowDate}'" ;

//db deki ürün sayısını öğrenme

$rezervasyonCount = $db->query("SELECT count(*) from rezervasyon WHERE time <='{$nowDate}'", PDO::FETCH_ASSOC) ;
foreach($rezervasyonCount as $result)
   $rezervasyonCount = $result["count(*)"];



$resultAllRezervasyon = $db->query($allProductQuery , PDO::FETCH_ASSOC);
if($resultAllRezervasyon->rowCount()){
     
    foreach($resultAllRezervasyon as $value){
      array_push($allRezervasyon , 
      array(
        "id"=>$value["id"],
        "time"=>$value["time"],
        "name"=>$value["name"],
        "e_mail"=>$value["e_mail"],
        "phone"=>$value["phone"],
        "sayi"=>$value["kisi_sayisi"],
        "m_status"=>$value["m_status"],
        "rez_date"=>$value["rez_date"],
      )
     );
    }

}else {
  echo "<h1>HATA ÜRÜNLER</h1>" ;
}



?>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Rezervasyonlar </h1>
          <p class="mb-4">Şu an görülen Rezervasyonlar Mayıs ayına aittir.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 row">
              <span class="m-0 font-weight-bold text-primary col-8">Mayıs ayı rezervasyon</span>

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
                      <th>Rezervasyon Numarası</th>
                      <th>Ad Soyad</th>
                      <th>e_mail</th>
                      <th>Telefon </th>
                      <th>Kisi Sayısı</th>
                      <th>Rezervasyon Tarihi</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <th>Rezervasyon Numarası</th>
                      <th>Ad Soyad</th>
                      <th>e_mail</th>
                      <th>Telefon </th>
                      <th>Kisi Sayısı</th>
                      <th>Rezervasyon Tarihi</th>
                  </tfoot>
                  <tbody>
                    <?php foreach($allRezervasyon as $result){ ?>
                    <tr>
                        <td><?=$result["id"]?></td>
                        <td><?=$result["name"]?></td>
                        <td><?=$result["e_mail"]?></td>
                        <td><?=$result["phone"]?></td>
                        <td><?=$result["sayi"]?></td>
                        <td><?=$result["rez_date"]?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
