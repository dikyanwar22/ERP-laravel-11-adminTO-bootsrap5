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
  <title>AdminLTE 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/LTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/LTE/dist/css/adminlte.min.css')}}">

  <!-- css untuk modifikasi modul -->
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
      max-height: calc(100vh * 0.7); /* Ukuran 70% dari laptop */
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

  .active_link {
    color: #00BFFF; /* background ikon menjadi biru muda */
  }
  </style>

  <style>
  @media (min-width: 1024px) {
    .navbar {
      height: 80px; /* Set the desired height for the navbar */
    }
    .navbar-nav .nav-item-custom {
      text-align: center;
    }

    .navbar-nav .nav-link-custom {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 5px 15px; /* Reduced padding for closer alignment */
      height: 100%; /* Ensure links fill the navbar height */
    }

    .navbar-nav .nav-link-custom i {
      font-size: 25px; /* Icon size */
    }
    .navbar-nav .nav-link-custom .custom-text-menu {
      font-size: 15px;
    }

    .navbar-nav .dropdown-menu {
      position: absolute; /* Changed to absolute for better positioning */
      top: 100%; /* Aligns dropdown directly below the menu item */
      left: 0; /* Aligns dropdown to the left edge of the parent */
      border: 1px solid #ddd;
      z-index: 9999;
    }

    .dropdown-submenu .dropdown-menu {
      left: 50%; /* Adjusts the position of submenus */
      top: 0; /* Aligns submenu vertically with its parent */
      margin-top: 0; /* Remove margin to ensure no gap */
    }
  }
  </style>
  <!-- css untuk modifikasi modul -->

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

</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="../../index3.html" class="navbar-brand">
          <img src="{{asset('assets/LTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3 scroll-horizontal" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav" id="tampil_modul"></ul>
          <!-- Left navbar links -->
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('assets/LTE/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('assets/LTE/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('assets/LTE/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge" id="total_notifikasi"></span>
            </a>
            <div id="my-notification"></div>
          </li>

          <!-- My Profile -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">Since : 2024-09-13</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-cog mr-2"></i> Setting
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
            </div>
          </li>
          <!-- My Profile -->

          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1 class="m-0"> Top Navigation <small>Example 3.0</small></h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#"><i class="fas fa-th-large"></i> Layout</a>
                </li>
                <li class="breadcrumb-item active">
                  <i class="fas fa-map-marker-alt"></i> Top Navigation
                </li>
              </ol>

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">

            <!-- /.col-md-12 -->
            <div class="col-lg-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form</h3>
                </div>
                <form>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" class="form-control" placeholder="Nama">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" class="form-control" placeholder="Alamat">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <button type="submit" class="btn btn-primary form-control">
                            <i class="fas fa-search"></i> Cari
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.col-md-12 -->


            <!-- /.col-md-12 -->
            <div class="col-lg-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form</h3>
                </div>
                <form>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" class="form-control" placeholder="Nama">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" class="form-control" placeholder="Alamat">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-6">
                        <button type="button" class="btn btn-danger btn-block">
                          <i class="fas fa-times-circle"></i> Cancel
                        </button>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">
                          <i class="fas fa-paper-plane"></i> Send
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.col-md-12 -->



          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

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

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/LTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/LTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/LTE/dist/js/adminlte.min.js')}}"></script>

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

<!-- membuat modul disini -->
<script type="text/javascript">
$(document).ready(function () {
  tampil_modul();

  $(document).on('click', '.nav-item.nav-item-custom > a.dropdown-toggle', function (e) {
    e.preventDefault(); // Prevent default behavior
    const $submenu = $(this).siblings('.dropdown-menu');
    $('.dropdown-menu').not($submenu).slideUp(); // Hide other submenus
    $submenu.slideToggle(); // Toggle the related submenu

    // Position the submenu directly below the clicked module with slight left adjustment
    const rect = this.getBoundingClientRect();
    $submenu.css({
      top: `${rect.bottom + window.scrollY}px`, // Position below the clicked item
      left: `${rect.left - 50}px`, // Adjust left to move the submenu a bit to the left (adjust value as needed)
      display: 'block' // Ensure the submenu is displayed
    });
});

});

// Function to display main modules
function tampil_modul() {
  $.ajax({
    url: "{{ route('tampil_modul') }}",
    method: 'GET',
    dataType: 'JSON',
    success: function (response) {
      const currentSegment = '{{ request()->segment(1) }}';
      let elemenHTML = `
      <ul class="navbar-nav">
      <li class="nav-item nav-item-custom">
      <a href="index3.html" class="nav-link nav-link-custom">
      <i class="fas fa-home active_link"></i> <span class="custom-text-menu active_link">Home</span>
      </a>
      </li>
      `;

      // Display modules
      response.forEach(modul => {
        const isActive = currentSegment === modul.uri ? 'active_link' : '';
        elemenHTML += `
        <li class="nav-item nav-item-custom ${isActive}">
        <a id="topnav-apps-${modul.modul}" class="nav-link nav-link-custom dropdown-toggle drop-custom-click arrow-none" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="${modul.icon} ${isActive}"></i> <span class="custom-text-menu ${isActive}">${modul.modul}</span>
        </a>
        <ul aria-labelledby="topnav-apps-${modul.modul}" class="dropdown-menu">
        ${loadMenu(modul.uri)}
        </ul>
        </li>
        `;
      });

      elemenHTML += `</ul>`;
      $('#tampil_modul').html(elemenHTML);
    },
    error: function (error) {
      console.error('Error fetching modules:', error);
    }
  });
}

// Function to load menu based on module
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
          const active_link = currentSegment === menu.class ? 'active_link' : '';
          submenuHTML += `<li><a href="${menu.folder}/${menu.class}" class="dropdown-item ${active_link}"><i class="${menu.icon} ${active_link}"></i> <span class="${active_link}">${menu.menu}</span></a></li>`;
        });
      }

      if (response.sub_menu) {
        response.sub_menu.forEach(submenu => {
          const itemClass = submenu.class === currentSegment ? 'active_link' : '';
          submenuHTML += `
          <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu-${submenu.id}" href="#" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle ${itemClass}"><i class="${submenu.icon} ${itemClass}"></i> <span class="${itemClass}">${submenu.menu}</span></a>
          <ul aria-labelledby="dropdownSubMenu-${submenu.id}" class="dropdown-menu border-0 shadow">
          ${loadSubMenu(submenu)}
          </ul>
          </li>
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

// Function to load submenu
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

        submenuHTML += `<li><a href="${url}" class="dropdown-item ${active_link_sub}"><i class="${submenu.icon_sub}"></i> ${submenu.sub_menu} ${count_notif}</a></li>`;
      });
    },
    error: function (error) {
      console.error('Error loading submenu:', error);
    }
  });
  return submenuHTML;
}
</script>

<!-- custom dropdown menu dari modul -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.drop-custom-click').forEach(function(element) {
    element.addEventListener('click', function(event) {
      // Check if the clicked link is "/u/"
      if (element.getAttribute('href') === '/u/') {
        // Allow default action to proceed
        return;
      }

      // Prevent default for dropdowns
      event.preventDefault();

      // Close all other dropdowns
      document.querySelectorAll('.custom-click').forEach(function(menu) {
        if (menu !== element.nextElementSibling) {
          menu.classList.remove('show');
        }
      });

      // Toggle the clicked dropdown menu
      const dropdownMenu = element.nextElementSibling;
      const rect = element.getBoundingClientRect();
      dropdownMenu.style.top = `${rect.bottom}px`; // Position below the clicked item
      dropdownMenu.style.left = `${rect.left}px`; // Align left with the clicked item
      dropdownMenu.classList.toggle('show');
    });
  });

  // Hide dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    if (!event.target.closest('.drop-custom-click')) {
      document.querySelectorAll('.custom-click').forEach(function(menu) {
        menu.classList.remove('show');
      });
    }
  });
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
        // Set the notification count
        $('#total_notifikasi').text(response.total);

        // Construct the notification dropdown HTML
        let elemenHTML = `
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Your Notifications</span>
        <div style="max-height: 300px; overflow-y: auto;">
        `;

        response.data.forEach(function(notification) {
          elemenHTML += `
          <a href="#" class="dropdown-item">
          <img style="border-radius: 50%; width: 20px; heigt: 20px;" src="${notification.image}">
          <span class="text-sm">${notification.name}</span>
          <span class="float-right text-muted text-xs">${notification.time}</span>
          <p class="text-muted text-xs">${notification.message}</p>
          </a>
          <div class="dropdown-divider"></div>
          `;
        });

        elemenHTML += `
        </div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>`;

        // Update the notification section
        $('#my-notification').html(elemenHTML);
      } else {
        console.error("Failed to load notifications.");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error(`AJAX error: ${textStatus} : ${errorThrown}`);
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
</body>
</html>
