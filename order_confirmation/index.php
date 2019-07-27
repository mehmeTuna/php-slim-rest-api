<?php

session_start();



if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}

if($_SESSION['operator']['authority'] == '0'){
   echo 'Yetki sahibi degilsiniz';
 exit ;
}

require_once  __DIR__ . '/../Config.php';
$siteName = (new WebRoot)->name();
$siteUrl = (new WebRoot)->url();

?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $siteName ?> tel onay</title>

  <!-- Custom fonts for this template-->
  <link href="order_confirmation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="order_confirmation/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="order_confirmation/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body id="page-top" >

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://www.ay-soft.com/">
        <div class="sidebar-brand-icon ">
         <img src="http://www.ay-soft.com/images/logo.png" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $siteName ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" onclick="siparis()">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Siparişler</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" onclick="siparis()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i  style='color:white' class="fas fa-fw fa-cog"></i>
          <span style='color:white'>Siparişler</span>
        </a>
     
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" onclick="rezervasyon()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i style='color:white' class="fas fa-fw fa-cog 0"></i>
          <span style='color:white'>Rezervasyon</span>
        </a>
     
      </li>

     
     

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" id='searchValue' placeholder="siparis, rezervasyon ara" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="mtSearch()">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Ara" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            

            <!-- Nav Item - Messages -->
           

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline  small"><?=$_SESSION["operator"]["name"]?></span>
                  <i class="fa fa-user" aria-hidden="true"></i>
               <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Çıkış Yap
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" id="page_title">Sipariş Onay</h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
             </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_gelen('gelenbtn')">
              <div id="gelenbtn" class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" id="gelen_title">Gelen Siparişler</div>
                      <div class="h5 mb-0 font-weight-bold " id="gelen_num">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-4x "></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_onay('onaybtn')">
              <div id="onaybtn" class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold  text-uppercase mb-1" id="onay_title">Onaylanan Siparişler </div>
                      <div class="h5 mb-0 font-weight-bold " id="onaylanan">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check fa-4x "></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_iptal('iptalbtn')">
              <div id='iptalbtn' class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold  text-uppercase mb-1" id="iptal_title">İptal Olan Siparişler</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold " id="iptal_edilen">0</div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-times fa-4x "></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

    
  <div id="data_container">
 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="table_display">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" id="table_title">Siparişler</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr id="table_tr_name">
                    </tr>
                  </thead>
                  <tfoot >
                    <tr id="table_tr_foot">
                     
                    </tr>
                  </tfoot>
                  <tbody id="table_body_render">
            
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
  </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer 
      <footer class="sticky-footer ">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Çıkış Yap </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Çıkış Yapmak istediğine eminmisin ? </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
          <a class="btn btn-primary" href="calisan/cikis-yap">Çıkış Yap</a>
        </div>
      </div>
    </div>
  </div>

  <script>
  
var durum = "siparis" ;//siparis or rezervasyon
var siteUrl = '../';
var firstsession = 'gelen';

window.onload = function() {

 title_rename();
 title_data_rename();
 titleTable();
 create_user_render(firstsession);
 btnBackground(firstsession);
};

 function mtSearch(){
  const serachVal =  $('#searchValue').val();
  if(durum == 'siparis'){
    create_user_render(serachVal , 'search' );
  }else if($durum = 'rezervasyon'){
   create_rezervasyon_render(serachVal , 'search' );
  }
}

function btnBackground(opt){
     firstsession = opt ;
  if(opt == 'gelen'){
      $('#onaybtn').removeClass('card bg-info text-light shadow h-100 py-2').addClass('card border-left-info text-info shadow h-100 py-2');
      $('#iptalbtn').removeClass('card bg-danger text-light shadow h-100 py-2').addClass('card border-left-danger text-danger shadow h-100 py-2');
      $('#gelenbtn').addClass('card bg-success text-light shadow h-100 py-2');
  }else if(opt == 'onay'){
      $('#onaybtn').addClass('card bg-info text-light shadow h-100 py-2');
      $('#iptalbtn').removeClass('card bg-danger text-light shadow h-100 py-2').addClass('card border-left-danger text-danger shadow h-100 py-2');
      $('#gelenbtn').removeClass('card bg-success text-light shadow h-100 py-2').addClass('card border-left-success text-success shadow h-100 py-2');
  }else if(opt == 'iptal'){
      $('#onaybtn').removeClass('card bg-info text-light shadow h-100 py-2').addClass('card border-left-info text-info shadow h-100 py-2');
      $('#iptalbtn').addClass('card bg-danger text-light shadow h-100 py-2');
      $('#gelenbtn').removeClass('card bg-success text-light shadow h-100 py-2').addClass('card border-left-success text-success shadow h-100 py-2');
  }
}


function create_rezervasyon_render(option , yontem = ''){
  if(yontem == 'search'){
    $.ajax({ 
          type: 'GET', 
          url: siteUrl + 'order_confirmation/order_detail/rezervasyon_detail.php?search=ok&ord='+option, 
            success: function (data) { 
            if(data == ""){
              $('#table_body_render').html('Gösterilecek Veri Yok');
            }else {
            let rezervasyon_detail =  JSON.parse ( data) ;
            let rezervasyon = rezervasyon_detail.map(
            data => {
              return create_rezervasyon(data)
            }
            );
            $('#table_body_render').html(rezervasyon);
            }
          }
    });
  }else{
    $.ajax({ 
          type: 'GET', 
          url: siteUrl + 'order_confirmation/order_detail/rezervasyon_detail.php?ord='+option, 
            success: function (data) { 
           
            if(data == ""){
              $('#table_body_render').html('Gösterilecek Veri Yok');
            }else {
            let rezervasyon_detail =  JSON.parse ( data) ;
            let rezervasyon = rezervasyon_detail.map(
            data => {
              return create_rezervasyon(data)
            }
            );
            $('#table_body_render').html(rezervasyon);
            }
          }
    });
  }

}

function create_user_render(option , yontem = ''){
  if(yontem == 'search'){
       $.ajax({ 
        type: 'GET', 
        url: siteUrl + 'order_confirmation/order_detail/order_user_detail.php?search=ok&order='+option, 
        success: function (data) {
        
          if(data == ""){
            $('#table_body_render').html('Gösterilecek Veri Yok');
          }else {
          let order_detail =  JSON.parse ( data) ;
          let user = order_detail.map(
          data => {
            return create_user(data)
          }
          );
          $('#table_body_render').html(user);
          }
        }
  });
  }else {
  $.ajax({ 
        type: 'GET', 
        url: siteUrl+ 'order_confirmation/order_detail/order_user_detail.php?order='+option, 
        success: function (data) {

          if(data == ""){
            $('#table_body_render').html('Gösterilecek Veri Yok');
          }else {
           
          let order_detail =  JSON.parse ( data) ;
          let user = order_detail.map(
          data => {
            return create_user(data)
          }
          );
          $('#table_body_render').html(user);
          }
        }
  });
  }
}


function title_rename(){
   if(durum == "rezervasyon"){
      $("#page_title").html("Rezervasyon Onay");
      $("#gelen_title").html("Gelen Rezervasyonlar");
      $("#onay_title").html("Onaylanan Rezervasyonlar");
      $("#iptal_title").html("İptal Edilen Rezervasyonlar");
      $("#table_title").html("Rezervasyonlar");
   }else if(durum == "siparis"){
      $("#page_title").html("Sipariş Onay");
      $("#gelen_title").html("Gelen Siparişler");
      $("#onay_title").html("Onaylanan Siparişler");
      $("#iptal_title").html("İptal Edilen Siparişler");
      $("#table_title").html("Siparişler");
   }
}

function title_data_rename(){
    if(durum == "siparis"){
      $.ajax({ 
        type: 'GET', 
        url: siteUrl + 'order_confirmation/order_detail/order_detail.php', 
        success: function (data) { 
          let order_detail =  JSON.parse ( data) ;
          $("#gelen_num").html( order_detail.waiting  );
          $("#onaylanan").html( order_detail.ok  );
          $("#iptal_edilen").html( order_detail.red  );
        }
      });
    }else if(durum == "rezervasyon"){
      $.ajax({ 
        type: 'GET', 
        url: siteUrl + 'order_confirmation/order_detail/rezervasyon.php', 
        success: function (data) { 
          let order_detail =  JSON.parse ( data) ;
          $("#gelen_num").html( order_detail.waiting  );
          $("#onaylanan").html( order_detail.ok  );
          $("#iptal_edilen").html( order_detail.red  );
         
        }
      });
    }
}

function create_user(obj ){
        let order = JSON.parse( obj.orders  );

    obj.date = HMtime( obj.date );
    firstOrder = obj.first_order == 1 ? '<i class="fas fa-check fa-2x text-info"> </i>': '<i class="fas fa-times fa-2x text-danger"> </i>' ;

  return  '<tr id="'+obj.order_id+'" >'+
          '<td onclick="edit_order_detay('+obj.order_id+',\''+obj.username+'\',\''+obj.tutar+'\',\''+obj.phone+'\',\''+obj.adres+'\',\''+obj.orderType+'\')"><i class="fas fa-pencil-alt"></i></td>'+
          '<td>'+obj.username+ '</td>'+
          '<td>'+ obj.tutar+'₺</td>'+
          '<td>'+ obj.phone+'</td>'+
          '<td>'+ obj.date+'</td>'+
          '<td>'+obj.adres+'</td>'+
          '<td>'+obj.order_id+'</td>'+ 
          '<td>'+firstOrder+'</td>'+
          '<td>'+obj.kurye+'</td>'+
          '</tr>';
}

function create_rezervasyon(obj ){
    obj.date = HMtime( obj.date );
    let message = obj.message == "" ? "Açıklama yok" : obj.message ;

    return '<tr id="'+obj.id+'" >'+
    '<td onclick="edit_rezervasyon_detay('+obj.id+')"><i class="fas fa-pencil-alt"></i></td>'+
          '<td>'+obj.name+ '</td>'+
          '<td>'+ obj.phone+'</td>'+
          '<td>'+ obj.kisi+'</td>'+
          '<td>'+ obj.date+'</td>'+
          '<td>'+obj.e_mail+'</td>'+
          '<td>'+message+'</td>'+
          '</tr>';
}


function rezervasyon() {
  durum = "rezervasyon" ;
  titleTable();
  title_rename();
  title_data_rename();
  create_rezervasyon_render("gelen");
}


function siparis() {
    durum = "siparis";
      titleTable();
      title_rename();
      title_data_rename();
      create_user_render("gelen");
}


function  titleTable(){
  if(durum == "siparis"){
    $('#table_tr_name').html(
      '<th>Onay</th>'+
      '<th>Ad Soyad</th>'+
       '<th>Tutar</th>'+
       '<th>İletişim</th>'+
       '<th>Tarih</th>'+
       '<th>Adres</th>'+
       '<th>Sipariş Numarası</th>'+
       '<th>İlk Sipariş </th>'+
       '<th>Kurye</th>'
       );

       $('#table_tr_foot').html(
        '<th>Onay</th>'+
        '<th>Ad Soyad</th>'+
        '<th>Tutar</th>'+
        '<th>İletişim</th>'+
        '<th>Tarih</th>'+
        '<th>Adres</th>'+
        '<th>Sipariş Numarası</th>'+
        '<th>İlk Sipariş </th>'+
        '<th>Kurye</th>'
       );
  }else {
    $('#table_tr_name').html(
      '<th>Onay</th>'+
      '<th>Ad Soyad</th>'+
       '<th>Telefon</th>'+
       '<th>Kişi Sayısı</th>'+
       '<th>Tarih</th>'+
       '<th>E_mail</th>'+
       '<th>Açıklama</th>'
       );

       $('#table_tr_foot').html(
        '<th>Onay</th>'+
        '<th>Ad Soyad</th>'+
        '<th>Telefon</th>'+
        '<th>Kişi Sayısı</th>'+
        '<th>Tarih</th>'+
        '<th>E_mail</th>'+
         '<th>Açıklama</th>'
       );
  }
}

function HMtime(timestamp){
  return timestamp ;
}


function edit_rezervasyon_detay(id){
 
  swal("Rezervasyon onaylama işlemi", {
  buttons: {
    onayla: {
      text: "Onayla",
      value: "onayla",
    },
    catch: {
      text: "Onaylama",
      value: "catch",
    }
  },
})
.then((value) => {
  switch (value) {
    case "catch":
    $.ajax({ 
        type: 'GET', 
        url: siteUrl + "order_confirmation/order_detail/rezervasyon_onay.php?id=" +id+ "&durum=red", 
          success: function (data) { 
            let control = JSON.parse(data);

              title_rename();
              title_data_rename();
              titleTable();


           if(control.status == "red"){
               swal("Rezervasyon Onaylanmadı !");
               create_rezervasyon_render(firstsession);
           } else    swal(control.status);
        }
  }) ;
      break;
 
    case 'onayla' :

    $.ajax({ 
        type: 'GET', 
        url: siteUrl + "order_confirmation/order_detail/rezervasyon_onay.php?id=" +id+ "&durum=ok", 
          success: function (data) { 
            let control = JSON.parse(data);
              title_rename();
              title_data_rename();
              titleTable();
         

           if(control.status == "ok"){
               swal("Rezervasyon onaylandı !");
               create_rezervasyon_render(firstsession);
           } else      swal(control.status);
        }
  }) ;
      break;
  }
});

}

function edit_order_detay(id,username,tutar,tel,adres , orderDetay){
     let orderText = "";

     if(orderDetay == 0 )
         orderText = "Kapıda Ödeme";
     else if(orderDetay == 1)
         orderText = "Kart ile Kapıda Ödeme";
     else if(orderDetay == 2)
         orderText = "Kredi İle Ödeme";

 let data = "Ödeme Tipi: "+orderText+"\nSipariş Numarası: "+id+"\nAd Soyad: "+username+"\nTutar: "+tutar+"₺\nTelefon: "+tel+"\nAdres: "+adres ;
  swal(data, {
  buttons: {
    reddet: {
      text: "İptal Et",
      value: "reddet",
    },
    onayla: {
      text: "Siparişi Onayla",
      value: "onayla",
    },
    catch: {
      text: "Siparişe detay ekle",
      value: "catch",
    }
  },
})
.then((value) => {
  switch (value) {
    case "catch":
    swal({
  text: 'Bu kısıma eklenen şeyler Mutfak bölümünde görülecektir',
  content: "input",
  button: {
    text: "Ekle",
    closeModal: false,
  },
})
.then(name => {
  if (!name) throw null;

  $.ajax({ 
        type: 'POST', 
        url: siteUrl + 'order_confirmation/order_detail/order_detail_add.php?id='+id+'&opt=onay', 
        data : {
          content : name
        },
          success: function (data) {
              title_rename();
              title_data_rename();
              titleTable();
              create_user_render(firstsession);

            let control = JSON.parse(data);
        
           swal.stopLoading();
           if(control.status == "ok")
              swal("İletiniz Eklenmiştir. Sipariş Onaylandı");
           else 
              swal(control.status);
        }
  }) ;
})
.catch(err => {
  if (err) {
    swal("Bağlantı hatası");
  } else {
    swal.stopLoading();
    swal.close();
  }
});
        create_user_render(firstsession);
      break;
 
    case "onayla":
    $.ajax({ 
        type: 'GET', 
        url: siteUrl + `order_confirmation/order_detail/order_detail_add.php?id=`+id+'&opt=onay', 
          success: function (data) {
              title_rename();
              title_data_rename();
              titleTable();

            console.log(data);
            let control = JSON.parse(data);

           if(control.status == "ok"){
               swal("Sipariş Onaylandı");
               create_user_render(firstsession);
           }else
                swal(control.status);


        }
  }) ;
      break;

      case "reddet":
    $.ajax({ 
        type: 'GET', 
        url: siteUrl + `order_confirmation/order_detail/order_detail_add.php?id=`+id+'&opt=red', 
          success: function (data) {
              title_rename();
              title_data_rename();
              titleTable();

            console.log(data);
            let control = JSON.parse(data);

           if(control.status == "ok"){
               swal("Sipariş İptal Edildi !");
               create_user_render(firstsession);
           }else
                swal(control.status);
        }
  }) ;
      break;
  }
});
}

function control_gelen(){
    btnBackground('gelen');

  title_data_rename();
  if(durum == "siparis")
  create_user_render("gelen" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("gelen");
}


function control_onay(){
    btnBackground('onay');
  title_data_rename();
  if(durum == "siparis")
  create_user_render("onay" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("onay");
}


function control_iptal(){
    btnBackground('iptal');
  title_data_rename();
  if(durum == "siparis")
  create_user_render("iptal" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("iptal");
}


  
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="order_confirmation/vendor/jquery/jquery.min.js"></script>
  <script src="order_confirmation/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="order_confirmation/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="order_confirmation/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="order_confirmation/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="order_confirmation/js/demo/chart-area-demo.js"></script>
  <script src="order_confirmation/js/demo/chart-pie-demo.js"></script>
    <!-- Page level plugins -->
    <script src="order_confirmation/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="order_confirmation/vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- <script src="order_confirmation/js/demo/datatables-demo.js"></script> -->
</body>

</html>
