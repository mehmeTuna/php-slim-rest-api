<?php

session_start();
/*

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
} */
$username = (isset($_SESSION['operator']['name'])) ? $_SESSION['operator']['name'] : '' ;

?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Zeki Usta Mutfak</title>

  <!-- Custom fonts for this template-->
  <link href="/../../../order_confirmation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/../../../order_confirmation/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="/../../../order_confirmation/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
    
      <!-- Divider -->
      <hr class="sidebar-divider">

     
       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item active">
        <a class="nav-link collapsed" onclick="siparis()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Siparişler</span>
        </a>
     
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
    

     
     

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
              <input type="text" class="form-control bg-light border-0 small" id='searchValue' placeholder="Siparis numarasi ..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button"    onclick="mtsearch()">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$username?></span>
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
            <h1 class="h1 mb-0 text-gray-800" id="page_title">Zeki Usta Mutfak</h1>
          
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onclick="tableRender(1)" >
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center" >
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1" >hHazirlanacak Siparisler</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="hazirlanacak">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onclick="tableRender(3)">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="onay_title">Hazirlanan Siparişler </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="hazirlanan">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" onclick="tableRender(4)">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" id="iptal_title">İptal Edilen Siparişler</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="iptal">0</div>
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
               <!-- Earnings (Monthly) Card Example -->
               <div class="col-xl-3 col-md-6 mb-4" onclick="tableRender(5)">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="kurye_title">Kuryeye Verilen Siparişler </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="kurye">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

    
  <div id="data_container">
    <div class='row'>  

<div class='col-md-8'>
   <!-- DataTales Example -->
 <div class="card shadow mb-4" id="table_display">
          
    </div>
          
    
  </div>
  <div class='col-md-4'>
   <!-- DataTales Example -->
 <div class="card shadow mb-4 "  >
            <div class="card-header py-3 " >
              <h6 class="m-0 font-weight-bold text-primary d-inline " id="table_info">Siparis Detaylari</h6> 
              <i class="fa fa-pencil-alt  float-right" onclick='alert("demo")'></i>
            
            </div>

            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table " id="orderdetail"  cellspacing="0">
                  
                </table>
              </div>
            </div>
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
    window.onload = function() {
 title_data_rename();
  tableRender(1);
};


function title_data_rename(){
      $.ajax({ 
        type: 'GET', 
        url: 'http://localhost:81/kitchen/detail/count', 
        success: function (data) { 
          let order_detail =  JSON.parse ( data) ;
          $("#hazirlanacak").html( order_detail.hazirlanacak  );
          $("#hazirlanan").html( order_detail.hazirlanan  );
          $("#iptal").html( order_detail.iptal  );
          $('#kurye').html(order_detail.kurye);
        }
      });
};

  

        function mtsearch(){
          const serachVal =  $('#searchValue').val();
            $.ajax({ 
                type: 'GET', 
                url: 'http://localhost:81/private/kitchen/data/table.php?search=ok&id='+serachVal, 
                success: function (data) { 
                  $('#table_display').html(data);
                }
            });
        };

        function tableRender(val){
          $.ajax({ 
                type: 'GET', 
                url: 'http://localhost:81/private/kitchen/data/table.php?id='+val, 
                success: function (data) { 
                  $('#table_display').html(data);
                }
            });
        }

        function orderDetayTable(val){
          $('#table_info').html(val + ' \'olu Sipariş Detayı');
          $.ajax({ 
                type: 'GET', 
                url: 'http://localhost:81/private/kitchen/data/orderDetail.php?id='+val, 
                success: function (data) { 
                  $('#orderdetail').html(data);
                }
            });
        }


  
  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="/../../../order_confirmation/vendor/jquery/jquery.min.js"></script>
  <script src="/../../../order_confirmation/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/../../../order_confirmation/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/../../../order_confirmation/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="/../../../order_confirmation/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/../../../order_confirmation/js/demo/chart-area-demo.js"></script>
  <script src="/../../../order_confirmation/js/demo/chart-pie-demo.js"></script>
    <!-- Page level plugins -->
    <script src="/../../../order_confirmation/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/../../../order_confirmation/vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- <script src="order_confirmation/js/demo/datatables-demo.js"></script> -->
</body>

</html>
