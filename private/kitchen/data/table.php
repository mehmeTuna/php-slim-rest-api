<?php
session_start();

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;

if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] == '0' ) {
    echo 'yetki sahibi degilsiniz';
    exit;
}

$data = new Data();

$id = $_GET['id'] ;
$result = array();
if( isset($_GET['search']  ) && $_GET['search'] =='ok'  )
    $result = $data->BringSearchAllOrders($id);
else 
   $result = $data->BringAllOrders($id) ; 


?>

<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" id="table_title">Siparişler</h6>
</div>
    <div class="card-body">
    <div class="table-responsive">

    <?php 
    if(count($result) == 0  ){
    ?>



Gosterilecek Veri bulunmamaktadir



    <?php exit ; } ?>
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
            <thead>
                <tr>
                   <th>Düzenle</th>
                    <th>Sıra No</th>
                    <th>İçerik</th>
                    <th>İletişim</th>
                    <th>Tarih</th>                                                           
                    <th>Sipariş Numarası</th>
                    <th>Kurye</th>
                 </tr>
            </thead>
            <tfoot >
            <tr>
                   <th>Düzenle</th>
                    <th>Sıra No</th>
                    <th>İçerik</th>
                    <th>İletişim</th>
                    <th>Tarih</th>                                                           
                    <th>Sipariş Numarası</th>
                    <th>Kurye</th>
                 </tr>
            </tfoot>
            <tbody id="table_body_render">
                <?php for ($a =  0 ; $a < count ($result) ; ) {

              $orderId = isset($result[$a]['orderId']) ? $result[$a]['orderId'] : '0' ;


                    $kuryeData = "select firstname ,lastname  from kurye where id=(select kurye_id from kurye_takip where order_id='{$orderId}')";
                    try{

                        $kuryeName = $data->db->query( $kuryeData ,  PDO::FETCH_ASSOC);

                        if($kuryeName->rowCount()){
                            foreach ($kuryeName as $val )
                                $kuryeName = $val["firstname"] . " " . $val["lastname"] ;
                        }else $kuryeName = "Kuryeye verilmedi veya kurye silindi";
                    }catch (PDOException $e){
                        $kuryeName = "Kuryeye verilmedi veya kurye silindi" ;
                    };

             
              if(isset ($result[$a]['content']) ){
                  $content = json_decode( $result[$a]['content']  , true);
                
                  $content = isset(  $content[0]['name'] ) ?  $content[0]['name']  : 'icerik bulunmuyor'; 
              }else $content = 'siparis yok';

             

              $phone = isset($result[$a]['phone']) ? $result[$a]['phone'] : 'hata' ;
              $mDate = isset($result[$a]['date']) ? date ('H:i' , $result[$a]['date'] ): 'hata' ;


             ?>
                <tr id='<?php echo $orderId ?> '>
                <td onclick="orderDetayTable(<?php echo  $orderId?>)"> <i  class="fas fa-eye ml-2"></i> </td>
                 <td> <?= ++$a ?></td>
                <td> <?= $content?></td>
                <td> <?= $phone?></td>
                <td> <?= $mDate?></td>
                <td> <?=$orderId ?></td>
                <td><?=$kuryeName?></td>
               
            </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>