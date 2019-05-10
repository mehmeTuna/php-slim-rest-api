<?php
session_start();


if(!isset($_SESSION["operator"])){
  header("location: ../calisan");
  exit;
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>tel onay</title>

  <!-- Custom fonts for this template-->
  <link href="order_confirmation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="order_confirmation/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="order_confirmation/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top" >

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Zeki Usta</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Siparişler</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" onclick="siparis()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Siparişler</span>
        </a>
     
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" onclick="rezervasyon()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Rezervasyon</span>
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
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION["operator"]["name"]?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
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
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_gelen()">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1" id="gelen_title">Gelen Siparişler</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="gelen_num">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_onay()">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="onay_title">Onaylanan Siparişler </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="onaylanan">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4" onclick="control_iptal()">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" id="iptal_title">İptal Olan Siparişler</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="iptal_edilen">0</div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
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

window.onload = function() {
 title_rename();
 title_data_rename();
 titleTable();
 create_user_render("order-gelen"); 
};



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
        url: 'http://localhost:81/siparis-onay/order-detail', 
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
        url: 'http://localhost:81/siparis-onay/rezervasyon-detail', 
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

  return  '<tr id="'+obj.order_id+'" >'+
          '<td>'+obj.username+ '</td>'+
          '<td>'+ obj.tutar+'₺</td>'+
          '<td>'+ obj.phone+'</td>'+
          '<td>'+ obj.date+'</td>'+
          '<td>'+obj.adres+'</td>'+
          '<td>'+obj.order_id+'</td>'+
          '</tr>';
}


function create_rezervasyon(obj ){
    obj.date = HMtime( obj.date );

    return '<tr id="'+obj.id+'" >'+
          '<td>'+obj.name+ '</td>'+
          '<td>'+ obj.phone+'</td>'+
          '<td>'+ obj.kisi+'</td>'+
          '<td>'+ obj.date+'</td>'+
          '<td>'+obj.e_mail+'</td>'+
          '</tr>';
}



function rezervasyon() {
  durum = "rezervasyon" ;
  titleTable();
  title_rename();
  title_data_rename();
  create_rezervasyon_render("rezervasyon-gelen");
}



function siparis() {
    durum = "siparis";
      titleTable();
      title_rename();
      title_data_rename();
      create_user_render("order-gelen");
}

function  titleTable(){
  if(durum == "siparis"){
    $('#table_tr_name').html(
      '<th>Ad Soyad</th>'+
       '<th>Tutar</th>'+
       '<th>İletişim</th>'+
       '<th>Tarih</th>'+
       '<th>Adres</th>'+
       '<th>Sipariş Numarası</th>'
       );

       $('#table_tr_foot').html(
        '<th>Ad Soyad</th>'+
        '<th>Tutar</th>'+
        '<th>İletişim</th>'+
        '<th>Tarih</th>'+
        '<th>Adres</th>'+
        '<th>Sipariş Numarası</th>'
       );
  }else {
    $('#table_tr_name').html(
      '<th>Ad Soyad</th>'+
       '<th>Telefon</th>'+
       '<th>Kişi Sayısı</th>'+
       '<th>Tarih</th>'+
       '<th>E_mail</th>'
       );

       $('#table_tr_foot').html(
        '<th>Ad Soyad</th>'+
        '<th>Telefon</th>'+
        '<th>Kişi Sayısı</th>'+
        '<th>Tarih</th>'+
        '<th>E_mail</th>'
       );
  }
}

function HMtime(timestamp){
  return timestamp ;
}



function create_user_render(option){
  $.ajax({ 
        type: 'GET', 
        url: 'http://localhost:81/siparis-onay/order-detail/'+option, 
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

function create_rezervasyon_render(option){
  $.ajax({ 
        type: 'GET', 
        url: 'http://localhost:81/siparis-onay/rezervasyon-detail/'+option, 
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


function control_gelen(){
  title_data_rename();
  if(durum == "siparis")
  create_user_render("order-gelen" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("rezervasyon-gelen");
}


function control_onay(){
  title_data_rename();
  if(durum == "siparis")
  create_user_render("order-onay" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("rezervasyon-onay");
}


function control_iptal(){
  title_data_rename();
  if(durum == "siparis")
  create_user_render("order-iptal" );
  else if(durum == "rezervasyon")
   create_rezervasyon_render("rezervasyon-iptal");
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

  <script src="order_confirmation/js/demo/datatables-demo.js"></script>
</body>

</html>
