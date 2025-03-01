<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="" />
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>Laravel - Panel Receipt</title>

  <link href="{{asset('assets/adminTo/css/lygsid/app.min.css?x=1727242591')}}" rel="stylesheet" type="text/css" id="app-style" />
  <link href="{{asset('assets/adminTo/css/lygsid/icons.min.css?x=1727242591')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/adminTo/css/lygsid/lyg-custom.css?x=1727242591')}}" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="{{asset('assets/adminTo/assets/images/icon.png')}}" />
  <link href="{{asset('assets/adminTo/js/lyglib/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/fixedColumn.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/fixedheader.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/datatables.button.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/css/select.datatable.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/assets/dropify/css/dropify.css')}}">
  <link rel="stylesheet" href="{{asset('assets/adminTo/js/lyglib/admin-resources/bootstrap-datepicker/css/daterangepicker.css')}}">

  <!-- ChatBox -->
  <style type="text/css">
  .chat_box {
    z-index: 9999;
    position: fixed;
    right: 20px;
    bottom: 0px;
    width: 300px;
  }

  .chat_head,
  .msg_head {
    background: #DCDCDC;
    /*background warna abu-abu */
    color: white;
    padding: 10px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px 5px 0px 0px;
  }

  .searchBox {
    padding: 0 !important;
    margin: 0 !important;
    height: 40px;
    width: 100%;
  }

  .searchBox-inner {
    height: 100%;
    width: 100%;
    padding: 0px !important;
    background-color: #eee;
  }

  .searchBox input {
    border: 1px solid #d0d0d0;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    padding-left: 15px;
    color: #808080;
  }

  .searchBox input:focus {
    border-color: #d0d0d0; /* Keeps the border color gray */
    outline: none; /* Removes the default outline */
  }

  .chat_body {
    background: whitesmoke;
    height: 300px;
  }

  .member_list {
    height: 300px;
    overflow-x: hidden;
    overflow-y: auto;
  }

  .msg_box {
    position: fixed;
    bottom: -5px;
    width: 300px;
    height: 305px;
    background: white;
    border-radius: 5px 5px 0px 0px;
  }

  .pull-left {
    float: left !important;
  }

  .img-circle {
    border-radius: 50%;
  }
</style>
<!-- ChatBox -->

<!-- css custom dropdown submenu -->
<style type="text/css">
@media (max-width: 768px) {
  .submenu-custom {
    display: none;
    position: absolute; /* Menyesuaikan posisi */
    left: 0;
    top: 100%;
  }

  .dropdown-toggle::after {
    display: none;
  }
}
</style>
<!-- css custom dropdown submenu -->

<!-- membuat custom scroll horizontal modul -->
<style type="text/css">
  @media (min-width: 1024px) {
  .scroll-horizontal {
    display: flex;
    overflow-x: auto;
    white-space: nowrap;
    padding: 0;
    margin: 0;
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #888 #f1f1f1; /* Firefox */
  }

  .scroll-horizontal .nav-item {
    display: inline-block;
    flex: 0 0 auto;
  }

  .navbar-nav .dropdown-menu {
    position: relative; /* Changed to relative */
    border: 1px solid #ddd;
    z-index: 9999;
    transform: translateX(80px); /* Adjust as needed */
  }

  .custom-horizontal {
    margin-top: 0;
    border: 1px solid #ddd;
    z-index: 9999;
  }
}

/* Custom scroll dropdown */
@media (min-width: 1024px) {
  .custom-scroll-new {
    max-height: calc(100vh * 0.3); /* Ukuran 30% dari laptop */
    overflow-y: auto; /* Enable vertical scrolling */
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #888 #f1f1f1; /* Firefox */
  }

  /* Chrome, Edge, Safari */
  .custom-scroll-new::-webkit-scrollbar {
    width: 8px;
  }

  .custom-scroll-new::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .custom-scroll-new::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
    border: 2px solid #f1f1f1;
  }

  .custom-scroll-new::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }

  .dropdown-menu {
    display: none;
  }

  .dropdown-menu.show {
    display: block;
  }
}
</style>
<!-- membuat custom scroll horizontal modul -->

<!-- css custom modul -->
<style>
@media (min-width: 1024px) {
  .scroll-horizontal {
    display: flex;
    overflow-x: auto;
    white-space: nowrap;
    padding: 0;
    margin: 0;
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #888 #f1f1f1; /* Firefox */
  }
  .scroll-horizontal .nav-item {
    display: inline-block;
    flex: 0 0 auto;
  }
  .navbar-nav .dropdown-menu {
    position: absolute;
    border: 1px solid #ddd;
    z-index: 9999;
    display: none; /* Hide by default */
  }
  .custom-horizontal {
    position: absolute;
    top: 100%;
    left: 0;
    margin-top: 0;
    border: 1px solid #ddd;
    z-index: 9999;
  }

  .custom-top {
    margin-top: 130px;
  }

  .active-custom {
    background-color: #add8e6; /* Warna biru muda */
    color: white;
  }
  .active-custom .nav-link {
    color: white;
  }
  .active-custom .nav-link i {
    color: white;
  }

}

@media (min-width: 1024px) {
  .custom-scroll-new {
    max-height: 400px; /* Set the height as needed */
    overflow-y: auto; /* Enable vertical scrolling */
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #888 #f1f1f1; /* Firefox */
  }

  /* Chrome, Edge, Safari */
  .custom-scroll-new::-webkit-scrollbar {
    width: 8px;
  }

  .custom-scroll-new::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .custom-scroll-new::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
    border: 2px solid #f1f1f1;
  }

  .custom-scroll-new::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }

  .dropdown-menu {
    display: none;
  }

  .dropdown-menu.show {
    display: block;
  }
}
</style>
<!-- css custom modul -->
</head>

<body class="loading" data-layout-mode="horizontal" data-layout-color="light" data-layout-size="fluid"
data-topbar-color="default" data-leftbar-position="fixed" data-leftbar-color="light"
data-leftbar-size='default' data-sidebar-user='false'>

<!-- start wrapper -->
<div id="wrapper">
  <div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">

      <li class="dropdown notification-list topbar-dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
          <i class="fe-bell noti-icon"></i>
          <span class="badge bg-danger rounded-circle noti-icon-badge" id="total_notifikasi"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-lg">

          <!-- item-->
          <div class="dropdown-item noti-title">
            <h5 class="m-0">
              <span class="float-end">
                <a href="" class="text-dark">
                  <small>Clear All</small>
                </a>
              </span>Notification
            </h5>
          </div>

          <!-- membuat notifikasi masuk -->
          <div id="my-notification"></div>
          <!-- membuat notifikasi masuk -->
          <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
            View all
            <i class="fe-arrow-right"></i>
          </a>

        </div>
      </li>

      <li class="dropdown notification-list topbar-dropdown">
        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
          <img src="{{asset('assets/adminTo/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
          <span class="pro-user-name ms-1">
            SID SA 01 <i class="mdi mdi-chevron-down"></i>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
          <!-- item-->
          <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome !</h6>
          </div>

          <!-- item-->
          <a href="/u/profile/" class="dropdown-item notify-item">
            <i class="fe-user"></i>
            <span>My Account</span>
          </a>

          <!-- item-->
          <a href="/u/lock/" class="dropdown-item notify-item">
            <i class="fe-lock"></i>
            <span>Lock Screen</span>
          </a>

          <div class="dropdown-divider"></div>

          <!-- item-->
          <a href="/auth/logout" class="dropdown-item notify-item">
            <i class="fe-log-out"></i>
            <span>Logout</span>
          </a>

        </div>
      </li>


    </ul>

    <div class="logo-box">

      <!-- logo marvel 2 -->
      <img src="{{asset('assets/adminTo/images/Marvel-Blue.png')}}" class="text-center marvel2_logo" alt="" >
      <!-- logo marvel 2 -->

      <a href="/u/" class="logo logo-light text-center">
        <span class="logo-sm">
          <img src="{{asset('assets/adminTo/images/icon.png')}}" alt="" data-type="logo-sm" height="22">
        </span>
        <span class="logo-lg">
          <img src="{{asset('assets/adminTo/images/LeeyinGroup.png')}}" alt="" data-type="logo-light" height="30">
        </span>
      </a>
      <a href="/u/" class="logo logo-dark text-center">
        <span class="logo-sm">
          <img src="{{asset('assets/adminTo/images/icon.png')}}" alt="" data-type="logo-sm" height="22">
        </span>
        <span class="logo-lg">
          <img src="{{asset('assets/adminTo/images/LeeyinGroup.png')}}" alt="" data-type="logo-dark" height="30">
        </span>
      </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
      <li>
        <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
          <div class="lines">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </a>
        <!-- End mobile menu toggle-->
      </li>

    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="topnav">
    <div class="container-fluid">
      <nav class="navbar navbar-light navbar-expand-lg topnav-menu ">

        <div class="collapse navbar-collapse scroll-horizontal" id="topnav-menu-content">
          <!-- menampilkan modul disini -->
          <ul class="navbar-nav" id="tampil_modul"></ul>
          <!-- menampilkan modul disini -->
        </div>

      </nav>
    </div>
  </div>

  <!-- content page -->
  <div class="content-page">

    <!-- content -->
    <div class="content">
      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#"><i class="fas fa-home fa-lg"></i> Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="#"><i class="fas fa-clipboard-list fa-lg"></i> Forms</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-file-alt fa-lg"></i> Form
          </li>
        </ol>
      </nav>
      <!-- breadcrumb -->

      <!-- start card -->
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0 p-0"><i class="dripicons-checklist"></i> Panel Receipt</h4>
        </div>
        <div class="card-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-panel-1" data-bs-toggle="tab" data-bs-target="#nav-tab1" type="button" role="tab" aria-controls="nav-tab1" aria-selected="true">Un-Process</button>
              <button class="nav-link" id="nav-panel-2" data-bs-toggle="tab" data-bs-target="#nav-tab2" type="button" role="tab" aria-controls="nav-tab2" aria-selected="true">History</button>
            </div>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-tab1" role="tabpanel" aria-labelledby="nav-panel-1">

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Date From</label>
                    <input type="date" id="date_from" name="date_from" class="form-control border-dark">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Date To</label>
                    <input type="date" id="date_end" name="date_end" class="form-control border-dark">
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="tableSendListFabric" class="table table-bordered table-bordered dt-responsive nowrap" width="100%">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center">Reference</th>
                          <th class="text-center">Site</th>
                          <th class="text-center">Order No</th>
                          <th class="text-center">TOD</th>
                          <th class="text-center">Send From</th>
                          <th class="text-center">Receiving Percentage %</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-tab2" role="tabpanel" aria-labelledby="nav-panel-2">
              <div class="row">
                <div class="col-md-12">

                  <div class="row mb-4">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Date From</label>
                        <input type="date" id="date_from_history" name="date_from" class="form-control border-dark">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Date To</label>
                        <input type="date" id="date_end_history" name="date_end" class="form-control border-dark">
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="tableSendListFabricHistory" class="table table-bordered table-bordered dt-responsive nowrap" width="100%">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center">Reference</th>
                          <th class="text-center">Site</th>
                          <th class="text-center">Order No</th>
                          <th class="text-center">TOD</th>
                          <th class="text-center">Send From</th>
                          <th class="text-center">Receiving Percentage %</th>
                          <th class="text-center">Status</th>
                          <!-- <th class="text-center">Action</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- end card -->

      <!-- start modal -->
      <div class="modal fade" id="modalWizardDoReceive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalWizardDoReceiveLabel">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalWizardDoReceiveLabel">RECEIVING</h5>

            </div>
            <div class="modal-body p-0">
              <div class="card">
                <div class="card-body">
                  <form id="formDoReceiving">
                    <div class="container-fluid m-0">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row mb-1" hidden>
                            <div class="row">
                              <label for="wzRefNo" class="col-4 col-form-label px-0">ID</label>
                              <div class="col-8">
                                <input type="text" class="form-control px-2" id="id_receipt" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-1" hidden>
                            <div class="row">
                              <label for="wzRefNo" class="col-4 col-form-label px-0">QTY</label>
                              <div class="col-8">
                                <input type="text" class="form-control px-2" id="qty_origin" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-1">
                            <div class="row">
                              <label for="wzRefNo" class="col-4 col-form-label px-0">Reference</label>
                              <div class="col-8">
                                <input type="text" class="form-control px-2" id="reference" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-1">
                            <div class="row">
                              <label for="wzSendBy" class="col-4 col-form-label px-0">Order No</label>
                              <div class="col-8">
                                <input type="text" class="form-control px-2" id="order_no" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="row" id="rowScanBin">
                              <label for="scanBin" class="col-4 col-form-label px-0">Scan Barcode:<span class="text-danger"></span></label>
                              <div class="col-8  px-0">
                                <div class="input-group mb-1 px-2">
                                  <input type="text" id="ScanBarcodeNew" class="form-control border-dark " placeholder="Scan Code" aria-label="ada" aria-describedby="basic-addon2">
                                  <div class="input-group-append">
                                    <button class="input-group-text border-dark text-black" type="button" id="scanButtonNew"> <i class="fa fa-qrcode" style= "font-size: 22px"></i></button>
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="col-md-6">

                          <div class="row mb-1">
                            <div class="row">
                              <label for="wzSite" class="col-4 col-form-label px-0">Date</label>
                              <div class="col-8">
                                <input type="date" class="form-control" id="date" value="2024-09-25">
                              </div>
                            </div>
                          </div>

                          <div class="row mb-1">
                            <div class="row">
                              <label for="wzSite" class="col-4 col-form-label px-0">Destination</label>
                              <div class="col-8">
                                <select id="destination" name="destination" class="select2 form-control" style="width: 100%;">
                                  <option value="">Choose</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row mb-1">
                            <div class="row">
                              <label for="wzSite" class="col-4 col-form-label px-0">Remark</label>
                              <div class="col-8">
                                <textarea class="form-control" id="remark" name="remark" value=""></textarea>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>

                    <div class="table-responsive mt-4">
                      <table id="table-roll-detail" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Reference</th>
                            <th scope="col" class="text-center">Order No</th>
                            <th scope="col" class="text-center">TOD</th>
                            <th scope="col" class="text-center">Style</th>
                            <th scope="col" class="text-center">Size</th>
                            <th scope="col" class="text-center">Color</th>
                            <th scope="col" class="text-center">Qty</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div> <!-- end card-body -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="cancel_receive"><i class="fa fa-close"></i> Close</button>
              <button type="button" class="btn btn-primary" id="save_receive"><i class="fa fa-plus"></i> Save Receive</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

    </div>
    <!-- content -->
  </div>
  <!-- content page -->
</div>
<!-- end wrapper -->

<!-- chatbox -->
<div class="chat_box">

  <!-- <div class="chat_head">
  <img src="{{asset('assets/icon/bell.png')}}" align="right" style="width:25px;height:25px;margin-bottom: -20px;margin-right: 8px;" border="0">
  <span class="label label-default" style="border-radius: 50px;width: 10px;text-align: center;background-color: #FF0000; color: white; margin-left: 264px;margin-bottom: 5px;" id="total_help"></span>
</div> -->

<div class="chat_head" style="display: flex; align-items: center; justify-content: flex-end;">
  <img src="{{asset('assets/icon/bell.png')}}" style="width:25px;height:25px;margin-right: 8px;" border="0">
  <span class="badge bg-danger rounded-circle noti-icon-badge" style="margin-left: -10px;" id="total_help"></span>
</div>

<div class="searchBox" style="display: none;">
  <div class="searchBox-inner" align="center" style="border-right: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0;">
    <input type="text" id="myInput1" class="span3"
    style="margin-top: 6px; width: 90%;"
    onkeyup="myFunction1()"
    placeholder="Search Support...">
  </div>
</div>


<div class="chat_body" style="display: none;">
  <div class="member_list" style="background: white;border: 1px solid #d0d0d0;">
    <!-- untuk menampilkan data helpdesk -->
    <span id="tampil_helpdesk"></span>
    <!-- untuk menampilkan data helpdesk -->
  </div>
</div>
</div>
<!-- chatbox -->

<!-- Footer Start -->
<footer class="footer" style="background-color: #001f3f;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 text-white">
        <script>document.write(new Date().getFullYear())</script> &copy; Adminto theme by <a href="">Coderthemes</a>
      </div>
      <div class="col-md-6">
        <div class="text-md-end footer-links d-none d-sm-block">
          <a href="javascript:void(0);">About Us</a>
          <a href="javascript:void(0);">Help</a>
          <a href="javascript:void(0);">Contact Us</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- end Footer -->

<script src="{{asset('assets/adminTo/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('assets/adminTo/js/lyglib/jquery-knob/jquery.knob.min.js')}}"></script>

<script src="{{asset('assets/adminTo/js/lyglib/morris.js06/morris.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/raphael/raphael.min.js')}}"></script>

<script src="{{asset('assets/adminTo/js/lyglib/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/jquery-validation/lib/jquery.form.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/jquery-validation/dist/jquery.validate.min.js')}}"></script>

<script src="{{asset('assets/adminTo/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/moment.min.js')}}"></script>
<script src="{{asset('assets/adminTo/js/lyglib/admin-resources/bootstrap-datepicker/js/daterangepicker.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/datatables.button.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/fixedColumn.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/fixedheader.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/datatables.button.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/jszip.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/pdfmake.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/vpsfont.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/button-html4.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/buttonprint.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/js/select.datatable.js')}}"></script>
<script src="{{asset('assets/adminTo/assets/dropify/js/dropify.js')}}"></script>
<script src="{{asset('assets/adminTo/js/customFunction.js')}}"></script>

<script src="{{asset('assets/adminTo/js/lyglib/app.min.js')}}"></script>

<?php
$db = new Illuminate\Support\Facades\DB;
$request = app('request');
$seg = $request->segment(1);
?>

<!-- Setup CSRF token for AJAX requests -->
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
<!-- Setup CSRF token for AJAX requests -->

<!-- custom dropdown menu dari modul -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Check if the viewport width is suitable for laptops
  if (window.innerWidth >= 1024) {  // Assuming laptop screen width is 1024px or more
    document.querySelectorAll('.dropdown-toggle').forEach(function(element) {
      element.addEventListener('click', function(event) {
        event.preventDefault();  // Prevent default action

        // Close all other dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
          if (menu !== element.nextElementSibling) {
            menu.classList.remove('show');
          }
        });

        // Toggle the clicked dropdown menu
        const dropdownMenu = element.nextElementSibling;
        const rect = element.getBoundingClientRect();
        dropdownMenu.style.top = `${rect.bottom}px`;
        dropdownMenu.style.left = `${rect.left - 80}px`;  // Adjust as needed
        dropdownMenu.classList.toggle('show');
      });
    });

    // Hide dropdowns when clicking outside
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown-toggle')) {
        document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
          menu.classList.remove('show');
        });
      }
    });
  }
});
</script>
<!-- custom dropdown menu dari modul -->

<!-- Membuat notifikasi -->
<script type="text/javascript">
function tampilkan_info_masuk() {
  $.ajax({
    url: "{{ route('my_notification') }}",
    method: 'GET',
    dataType: 'JSON',
    success: function(response) {
      if (response.message === 200) {
        var total = response.total;
        $('#total_notifikasi').text(total);

        var elemenHTML = '<div class="noti-scroll" data-simplebar>';
        response.data.forEach(function(notification) {
          elemenHTML += `
          <a href="javascript:void(0);" class="dropdown-item notify-item">
          <div class="notify-icon bg-primary">
          <img src="${notification.img}" alt="notification image" class="img-fluid">
          </div>
          <p><b>${notification.name}</b></p>
          <p class="notify-details">${notification.message}
          <small class="text-muted">${notification.time}</small>
          </p>
          </a>`;
        });
        elemenHTML += '</div>';
        $('#my-notification').html(elemenHTML);
      } else {
        console.error("Failed to load notifications.");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
  });
}

$(document).ready(function() {
  tampilkan_info_masuk();
});
</script>
<!-- Membuat notifikasi -->

<!-- chatbox -->
<script type="text/javascript">
$(document).ready(function() {
  // Load helpdesk details
  show_helpdesk();

  // Function to fetch and display helpdesk details
  function show_helpdesk() {
    $.ajax({
      url: "{{ route('helpdesk_in') }}",
      method: 'GET',
      dataType: 'JSON',
      success: function(response) {
        if (response.message === 200) {
          const hitung = response.total;
          let elemenHTML = '<ul class="list-unstyled" id="style-5">';

          for (let i = 0; i < hitung; i++) {
            elemenHTML += '<li class="left clearfix" style="padding: 10px 10px;border-bottom: 1px solid #d0d0d0;">';
            elemenHTML += '<a href="' + response.data[i].url + '" target="_blank">';
            elemenHTML += '<div class="pull-left">';
            elemenHTML += '<img src="' + response.data[i].image + '" class="img-circle" alt="User Image" style="margin: auto 10px auto auto;width: 40px;height: 40px;">';
            elemenHTML += '</div>';
            elemenHTML += '<h4 style="padding: 0;margin: 0 0 0 45px;color: #444444;font-size: 15px;position: relative;">' + response.data[i].name + '<small style="color: #999999;font-size: 10px;position: absolute;top: 0;right: 0;"><i class="fa fa-clock-o"></i> ' + response.data[i].waktu + '</small></h4>';
            elemenHTML += '<p style="margin: 0 0 0 45px;font-size: 12px;color: #888888;">' + response.data[i].helpdesk + '</p>';
            elemenHTML += '</a>';
            elemenHTML += '</li>';
          }

          elemenHTML += '</ul>';
          $('#tampil_helpdesk').html(elemenHTML);
          $('#total_help').text(hitung);
        } else {
          console.error('Unexpected response:', response);
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error:', xhr.responseText);
      }
    });
  }

  // Function for filtering helpdesk list
  function myFunction1() {
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput1');
    filter = input.value.toUpperCase();
    ul = document.getElementById("style-5");
    li = ul.getElementsByTagName('li');

    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }

  // Bind search function to input change
  $('#myInput1').on('keyup', myFunction1);
});

$('.chat_head').click(function() {
  $('.chat_body').slideToggle('slow');
  $('.searchBox').slideToggle('slow');
  $('.msg_box').hide('slow');
});

$('.msg_head').click(function() {
  $('.msg_wrap').slideToggle('slow');
});

$('.msg_box').hide();
$('.chat_body').hide();
$('.searchBox').hide();
</script>
<!-- chatbox -->

<!-- membuat modul -->
<script type="text/javascript">
$(document).ready(function () {
  tampil_modul();

  $(document).on('click', '.nav-item.dropdown > a', function (e) {
    if (window.innerWidth <= 768) {
      e.preventDefault(); // Mencegah default behavior
      const $submenu = $(this).siblings('.dropdown-menu');
      $('.dropdown-menu').not($submenu).slideUp(); // Sembunyikan semua submenu lainnya
      $submenu.slideToggle(); // Toggle submenu terkait
    }
  });

});

// Fungsi untuk menampilkan modul utama
function tampil_modul() {
  $.ajax({
    url: "{{ route('tampil_modul') }}",
    method: 'GET',
    dataType: 'JSON',
    success: function (response) {
      const currentSegment = '{{ request()->segment(1) }}';
      let elemenHTML = `
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle arrow-none" href="/u/" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="dripicons-home"></i>
      <div class="top-menu-parent-name">{{ 'Home' }}</div>
      </a>
      </li>
      `;

      // Menampilkan modul
      response.forEach(modul => {
        const isActive = currentSegment === modul.uri ? 'active' : '';
        elemenHTML += `
        <li class="nav-item ${isActive}">
          <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps-${modul.modul}" role="button"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="${modul.icon}"></i> ${modul.modul} &ensp;<div class="arrow-down"></div>
          </a>
        <div class="dropdown-menu" aria-labelledby="topnav-apps-${modul.modul}">
          ${loadMenu(modul.uri)}
        </div>
        </li>
        `;
      });

      $('#tampil_modul').html(elemenHTML);
    },
    error: function (error) {
      console.error('Error fetching modules:', error);
    }
  });
}

// Fungsi untuk memuat menu berdasarkan modul
function loadMenu(modulUri) {
  let submenuHTML = '';
  $.ajax({
    url: '{{ route('all_menu') }}',
    method: 'POST',
    dataType: 'JSON',
    data: { nama_modul: modulUri },
    async: false,
    success: function (response) {
      const currentSegment = '<?= $request->segment(2); ?>';
      if (response.menu_tunggal) {
        response.menu_tunggal.forEach(menu => {
          const active_link = currentSegment === menu.class ? 'active' : '';
          submenuHTML += `<a href="${menu.folder}/${menu.class}" class="dropdown-item ${active_link}"><i class="${menu.icon}"></i> ${menu.menu}</a>`;
        });
      }

      if (response.sub_menu) {
        response.sub_menu.forEach(submenu => {
          var itemClass = submenu.class === currentSegment ? 'active' : '';
          submenuHTML += `
          <div class="dropdown">
          <a class="dropdown-item dropdown-toggle arrow-none ${itemClass}" href="#" id="topnav-${submenu.id}"
          role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="${submenu.icon}"></i> ${submenu.menu} <div class="arrow-down"></div>
          </a>
          <div class="dropdown-menu submenu-custom" aria-labelledby="topnav-${submenu.id}">
          ${loadSubMenu(submenu)}
          </div>
          </div>
          `;
        });
      }
    },
    error: function (error) {
      console.error('Error loading menu:', error);
    }
  });
  return submenuHTML;
}

// Fungsi untuk memuat submenu
function loadSubMenu(menuItem) {
  let submenuHTML = '';
  $.ajax({
    url: '{{ route('modul_sub_menu') }}',
    method: 'POST',
    dataType: 'JSON',
    data: { menu_id: menuItem.id },
    async: false,
    success: function (response) {
      response.forEach(submenu => {
        const link_sub = '{{ request()->segment(3) }}';
        const active_link_sub = link_sub === submenu.uri_sub ? 'active' : '';
        const count_notif = submenu.total > 0 ? '(' + submenu.total + ')' : '';
        const url = submenu.folder + '/' + submenu.class + '/' + submenu.function;

        submenuHTML += `<a href="${url}" class="dropdown-item ${active_link_sub}"><i class="${submenu.icon_sub}"></i> ${submenu.sub_menu} ${count_notif}</a>`;
      });
    },
    error: function (error) {
      console.error('Error loading submenu:', error);
    }
  });
  return submenuHTML;
}
</script>
<!-- membuat modul -->

</body>
</html>
