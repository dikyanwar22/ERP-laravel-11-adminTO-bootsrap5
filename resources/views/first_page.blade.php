<!DOCTYPE html>
<html lang="en" data-layout="topnav">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{csrf_token()}}">    
    <title>@yield('title', $title)</title>

    <!-- font awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- tabler icon  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- remix icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Vector Maps css -->
    <link href="{{asset('assets/AdminTO/assets/vendor/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="{{asset('assets/AdminTO/assets/js/config.js')}}"></script>

    <!-- Vendor css -->
    <link href="{{asset('assets/AdminTO/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/AdminTO/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('assets/AdminTO/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- agar ketika mode smartphone tidak ada scroll horizontal -->
    <style>
        @media (min-width: 1024px) {
        /* Menghapus scroll horizontal */
        html, body {
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        /* Memastikan semua elemen tidak melebihi viewport */
        *, *::before, *::after {
            max-width: 100% !important;
        }

        /* Mencegah elemen flex atau grid melampaui lebar layar */
        body {
            display: flex !important;
        }
        
        /* Memberi jarak pada modules di sisi kiri dan kanan */
        .spacing-modules {  
            margin-left: 30px !important;
            margin-right: 30px !important;
        }
    }

    .dropdown-item.custom-dropdown {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 5px !important;
        margin: 0 !important;
        width: auto !important;
        max-width: none !important;
        min-width: 0 !important;
        white-space: nowrap !important;
    }

    .dropdown-item.custom-dropdown i {
        margin: 0 !important;
        padding: 0 !important;
        width: auto !important;
        min-width: 0 !important;
    }
    </style>

    <!-- setting ukuran icon -->
    <style>
        @media (min-width: 1024px) {
        /* untuk agar icon ditengah dan teks dibawahnya */
        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 2px;
        }
        
        .menu-icon i {
            font-size: 30px !important; /* ukuran icon */
        }
    
        .menu-text {
            font-size: 12px;  /* ukuran teks */
            margin-top: 2px;
        }

        .menu-arrow {
            margin-top: -7px !important; /*untuk membuat icon mendekat keatas */
        }
    }
    </style>
    <!-- setting ukuran icon -->

    <!-- untuk setting agar dropdown tidak terhalang scroll  -->
    <style>
        @media (min-width: 1024px) {
        
        /* untuk membuat scroll horizontal tanpa scroll vertikal */
        .custom-scroll-horizontal {
            position: relative !important;
            overflow-x: auto;
            overflow-y: hidden;
            /* z-index: 1 !important; */
            /* Untuk Firefox */
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
        }

        /* Untuk browser berbasis Webkit */
        .custom-scroll-horizontal::-webkit-scrollbar {
            height: 3px; /* Ukuran scrollbar lebih kecil */
        }

        .custom-scroll-horizontal::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scroll-horizontal::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 1.5px;
        }

        /* Dropdown harus bisa keluar dari scroll */
        .dropdown-menu {
            position: fixed !important;  
            /* z-index: 1050 !important;  */
            margin-top: -28px !important;
        }

        /* Menampilkan submenu saat hover pada dropdown */
        .custom-dropdown-submenu {
            position: absolute !important;
        }
    }
    </style>
    <!-- untuk setting agar dropdown tidak terhalang scroll  -->

    <!-- ChatBox -->
    <style type="text/css">
    .chat_box {
      z-index: 9999;
      position: fixed;
      right: 20px;
      bottom: 0px;
      width: 300px;
    }
    .chat_head, .msg_head {
      background: #222222;
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
    .chat_body {
      background: whitesmoke;
      height: 300px;
    }
    .member_list {
      height: 300px;
      overflow-x: hidden;
      overflow-y: auto;
    }
    .msg_box{
      position:fixed;
      bottom:-5px;
      width:300px;
      height:305px;
      background:white;
      border-radius:5px 5px 0px 0px;
    }
    .pull-left {
      float: left!important;
    }
    .img-circle {
      border-radius: 50%;
    }
    </style>
    <!-- ChatBox -->
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
        <header class="app-topbar" id="header">
            <div class="page-container topbar-menu">
                <div class="d-flex align-items-center">

                    <!-- Brand Logo -->
                    <a href="index.html" class="logo">
                        <span class="logo-light">
                            <span class="logo-lg"><img src="{{asset('assets/AdminTO/assets/images/logo.png')}}" alt="logo"></span>
                            <span class="logo-sm"><img src="{{asset('assets/AdminTO/assets/images/logo-sm.png')}}" alt="small logo"></span>
                        </span>

                        <span class="logo-dark">
                            <span class="logo-lg"><img src="{{asset('assets/AdminTO/assets/images/logo-dark.png')}}" alt="dark logo"></span>
                            <span class="logo-sm"><img src="{{asset('assets/AdminTO/assets/images/logo-sm.png')}}" alt="small logo"></span>
                        </span>
                    </a>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="sidenav-toggle-button px-2">
                        <i class="ri-menu-5-line fs-24"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="ri-menu-5-line fs-24"></i>
                    </button>

                    <!-- Topbar Page Title -->
                    <div class="topbar-item d-none d-md-flex px-2">
                        
                        <div>
                            <h4 class="page-title fs-20 fw-semibold mb-0">Horizontal</h4>

                        </div>
                        
                    </div>

                </div>

                <div class="d-flex align-items-center gap-2">

                      
                    <!-- Notification Dropdown -->
                    <div class="topbar-item">
                        <div class="dropdown">
                            
                            <button class="topbar-link dropdown-toggle drop-arrow-none position-relative" data-bs-toggle="dropdown"
                                data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                                <i class="ri-notification-snooze-line animate-ring fs-22"></i>
                                <span class="noti-icon-badge position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger text-white">
                                    5
                                </span>
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                                <div class="p-2 border-bottom position-relative border-dashed">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle drop-arrow-none link-dark"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,15" aria-expanded="false">
                                                    <i class="ri-settings-2-line fs-22 align-middle"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Mark as Read</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Delete All</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Do not Disturb</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Other Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative rounded-0" style="max-height: 300px;" data-simplebar>
                                    <!-- item-->
                                    <div class="dropdown-item notification-item py-2 text-wrap active" id="notification-1">
                                        <span class="d-flex align-items-center">
                                            <span class="me-3 position-relative flex-shrink-0">
                                                <img src="{{asset('assets/AdminTO/assets/images/users/avatar-2.jpg')}}" class="avatar-lg rounded-circle"
                                                    alt="" />
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Glady Haid</span> commented on <span
                                                    class="fw-medium text-body">Adminto admin status</span>
                                                <br />
                                                <span class="fs-12">25m ago</span>
                                            </span>
                                            <span class="notification-item-close">
                                                <button type="button"
                                                    class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                    data-dismissible="#notification-1">
                                                    <i class="ri-close-line fs-16"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>

                                    <!-- item-->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="notification-2">
                                        <span class="d-flex align-items-center">
                                            <span class="me-3 position-relative flex-shrink-0">
                                                <img src="{{asset('assets/AdminTO/assets/images/users/avatar-4.jpg')}}" class="avatar-lg rounded-circle"
                                                    alt="" />
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Tommy Berry</span> donated <span
                                                    class="text-success">$100.00</span> for <span
                                                    class="fw-medium text-body">Carbon removal program</span>
                                                <br />
                                                <span class="fs-12">58m ago</span>
                                            </span>
                                            <span class="notification-item-close">
                                                <button type="button"
                                                    class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                    data-dismissible="#notification-2">
                                                    <i class="ri-close-line fs-16"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>

                                    <!-- item-->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="notification-3">
                                        <span class="d-flex align-items-center">
                                            <div class="avatar-lg flex-shrink-0 me-3">
                                                <span class="avatar-title bg-success-subtle text-success rounded-circle fs-22">
                                                    <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>
                                                </span>
                                            </div>
                                            <span class="flex-grow-1 text-muted">
                                                You withdraw a <span class="fw-medium text-body">$500</span> by <span
                                                    class="fw-medium text-body">New York ATM</span>
                                                <br />
                                                <span class="fs-12">2h ago</span>
                                            </span>
                                            <span class="notification-item-close">
                                                <button type="button"
                                                    class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                    data-dismissible="#notification-3">
                                                    <i class="ri-close-line fs-16"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>

                                    <!-- item-->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="notification-4">
                                        <span class="d-flex align-items-center">
                                            <span class="me-3 position-relative flex-shrink-0">
                                                <img src="{{asset('assets/AdminTO/assets/images/users/avatar-7.jpg')}}" class="avatar-lg rounded-circle"
                                                    alt="" />
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Richard Allen</span> followed you in <span
                                                    class="fw-medium text-body">Facebook</span>
                                                <br />
                                                <span class="fs-12">3h ago</span>
                                            </span>
                                            <span class="notification-item-close">
                                                <button type="button"
                                                    class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                    data-dismissible="#notification-4">
                                                    <i class="ri-close-line fs-16"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>

                                    <!-- item-->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="notification-5">
                                        <span class="d-flex align-items-center">
                                            <span class="me-3 position-relative flex-shrink-0">
                                                <img src="{{asset('assets/AdminTO/assets/images/users/avatar-10.jpg')}}" class="avatar-lg rounded-circle"
                                                    alt="" />
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Victor Collier</span> liked you recent photo
                                                in <span class="fw-medium text-body">Instagram</span>
                                                <br />
                                                <span class="fs-12">10h ago</span>
                                            </span>
                                            <span class="notification-item-close">
                                                <button type="button"
                                                    class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                                    data-dismissible="#notification-5">
                                                    <i class="ri-close-line fs-16"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item notification-item text-center text-reset text-decoration-underline fw-bold notify-item border-top border-light py-2">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Button Trigger Customizer Offcanvas -->
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                            type="button">
                            <i class="ri-settings-4-line fs-22"></i>
                        </button>
                    </div>

                    <!-- Light/Dark Mode Button -->
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link" id="light-dark-mode" type="button">
                            <i class="ri-moon-line light-mode-icon fs-22"></i>
                            <i class="ri-sun-line dark-mode-icon fs-22"></i>
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="topbar-item nav-user">
                        <div class="dropdown">
                            <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                                data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{asset('assets/AdminTO/assets/images/users/avatar-1.jpg')}}" width="32" class="rounded-circle me-lg-2 d-flex"
                                    alt="user-image">
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">Nowak Helme</h5>
                                </span>
                                <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Wallet : <span class="fw-semibold">$89.25k</span></span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-question-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Support</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-lock-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger">
                                    <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Sign Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->

        <!-- Horizontal Menu Start Dicky -->
        <header class="topnav">
            <nav class="navbar navbar-expand-lg spacing-modules">
                <!-- Start Modul -->
                <span id="tampil_modul"></span>
                <!-- End Modul -->
            </nav>
        </header>
        <!-- Horizontal Menu End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">

                <div class="row">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light bg-opacity-50 p-1 mb-2">
                        <li class="breadcrumb-item"><a href="#"><i class="ti ti-smart-home fs-16 me-1"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>

                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="d-flex card-header justify-content-between align-items-center">
                                <h4 class="header-title">Brands Listing</h4>
                                <a href="javascript:void(0);" class="btn btn-sm btn-light">Add Brand <i class="ti ti-plus ms-1"></i></a>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xxl-6">
                        <div class="card card-h-100">
                            <div class="card-header d-flex flex-wrap align-items-center gap-2 border-bottom border-dashed">
                                <h4 class="header-title me-auto">Top Selling Products</h4>

                                <div class="d-flex gap-2 justify-content-end text-end">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Import <i class="ti ti-download ms-1"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary">Export <i class="ti ti-file-export ms-1"></i></a>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-custom align-middle table-nowrap table-hover mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 85px;">
                                                    <div class="avatar-lg border rounded">
                                                        <img src="{{asset('assets/AdminTO/assets/images/products/p-1.png')}}" alt="Product-10" class="img-fluid rounded-2">
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h5 class="fs-14 my-1"><a href="#!" class="link-reset">Modern Desk
                                                            Lamp</a></h5>
                                                    <span class="text-muted fs-12">15 April 2024</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">$45.99</h5>
                                                    <span class="text-muted fs-12">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">120</h5>
                                                    <span class="text-muted fs-12">Quantity</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <div class="me-2">
                                                            <h5 class="fs-14 my-1">$5,518.80</h5>
                                                            <span class="text-muted fs-12">Amount</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 85px;">
                                                    <div class="avatar-lg border rounded">
                                                        <img src="{{asset('assets/AdminTO/assets/images/products/p-2.png')}}" alt="Product-11" class="img-fluid rounded-2">
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h5 class="fs-14 my-1"><a href="#!" class="link-reset">Vintage
                                                            Wooden Chair</a></h5>
                                                    <span class="text-muted fs-12">10 April 2024</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">$99.00</h5>
                                                    <span class="text-muted fs-12">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">80</h5>
                                                    <span class="text-muted fs-12">Quantity</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <div class="me-2">
                                                            <h5 class="fs-14 my-1">$7,920.00</h5>
                                                            <span class="text-muted fs-12">Amount</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 85px;">
                                                    <div class="avatar-lg border rounded">
                                                        <img src="{{asset('assets/AdminTO/assets/images/products/p-3.png')}}" alt="Product-12" class="img-fluid rounded-2">
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h5 class="fs-14 my-1"><a href="#!" class="link-reset">Wireless
                                                            Keyboard</a></h5>
                                                    <span class="text-muted fs-12">05 April 2024</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">$29.99</h5>
                                                    <span class="text-muted fs-12">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">150</h5>
                                                    <span class="text-muted fs-12">Quantity</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <div class="me-2">
                                                            <h5 class="fs-14 my-1">$4,498.50</h5>
                                                            <span class="text-muted fs-12">Amount</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 85px;">
                                                    <div class="avatar-lg border rounded">
                                                        <img src="{{asset('assets/AdminTO/assets/images/products/p-4.png')}}" alt="Product-13" class="img-fluid rounded-2">
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h5 class="fs-14 my-1"><a href="#!" class="link-reset">Bluetooth
                                                            Speaker</a></h5>
                                                    <span class="text-muted fs-12">02 April 2024</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">$65.00</h5>
                                                    <span class="text-muted fs-12">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">90</h5>
                                                    <span class="text-muted fs-12">Quantity</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <div class="me-2">
                                                            <h5 class="fs-14 my-1">$5,850.00</h5>
                                                            <span class="text-muted fs-12">Amount</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 85px;">
                                                    <div class="avatar-lg border rounded">
                                                        <img src="{{asset('assets/AdminTO/assets/images/products/p-5.png')}}" alt="Product-14" class="img-fluid rounded-2">
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h5 class="fs-14 my-1"><a href="#!" class="link-reset">Classic Table
                                                            Lamp</a></h5>
                                                    <span class="text-muted fs-12">29 March 2024</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">$42.50</h5>
                                                    <span class="text-muted fs-12">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1">110</h5>
                                                    <span class="text-muted fs-12">Quantity</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <div class="me-2">
                                                            <h5 class="fs-14 my-1">$4,675.00</h5>
                                                            <span class="text-muted fs-12">Amount</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end card-body-->

                            <div class="card-footer">
                                <div class="align-items-center justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">10</span> Results
                                        </div>
                                    </div>
                                    <div class="col-sm-auto mt-3 mt-sm-0">
                                        <ul class="pagination pagination-boxed pagination-sm mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link"><i class="ti ti-chevron-left"></i></a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link"><i class="ti ti-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- -->
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->

            </div> <!-- container -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="page-container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <script>document.write(new Date().getFullYear())</script> © Adminto - By <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Coderthemes</span>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center gap-2 px-3 py-3 offcanvas-header border-bottom border-dashed">
            <h5 class="flex-grow-1 fs-16 fw-bold mb-0">Theme Settings</h5>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0 h-100" data-simplebar>
            <div class="p-3 border-bottom border-dashed">
                <h5 class="mb-3 fs-13 text-uppercase fw-bold">Color Scheme</h5>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light"
                                value="light">
                            <label class="form-check-label p-3 w-100 d-flex justify-content-center align-items-center"
                                for="layout-color-light">
                                <iconify-icon icon="solar:sun-bold-duotone" class="fs-32 text-muted"></iconify-icon>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Light</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark"
                                value="dark">
                            <label class="form-check-label p-3 w-100 d-flex justify-content-center align-items-center"
                                for="layout-color-dark">
                                <iconify-icon icon="solar:cloud-sun-2-bold-duotone" class="fs-32 text-muted"></iconify-icon>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Dark</h5>
                    </div>
                </div>
            </div>

            <div class="p-3 border-bottom border-dashed sidebarMode">
                <h5 class="mb-3 fs-13 text-uppercase fw-bold">Layout Mode</h5>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-fluid"
                                value="fluid">
                            <label class="form-check-label p-0 avatar-xl w-100" for="layout-mode-fluid">
                                <div>
                                    <span class="d-flex h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column rounded-2">
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </span>
                                    </span>
                                </div>

                                <div>
                                    <span class="d-flex h-100 flex-column">
                                        <span
                                            class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                            <span class="d-block p-1 bg-dark-subtle rounded me-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        </span>
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </div>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Fluid</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-layout-mode" id="data-layout-detached"
                                value="detached">
                            <label class="form-check-label p-0 avatar-xl w-100" for="data-layout-detached">
                                <span class="d-flex h-100 flex-column">
                                    <span class="bg-light d-flex p-1 align-items-center border-bottom ">
                                        <span class="d-block p-1 bg-dark-subtle rounded me-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                    </span>
                                    <span class="d-flex h-100 p-1 px-2">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                </span>

                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Detached</h5>
                    </div>
                </div>
            </div>

            <div class="p-3 border-bottom border-dashed">
                <h5 class="mb-3 fs-16 fw-bold">Topbar Color</h5>

                <div class="row">
                    <div class="col-3 darkMode">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-light"
                                value="light">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="topbar-color-light">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle bg-white"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Light</h5>
                    </div>

                    <div class="col-3">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark"
                                value="dark">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="topbar-color-dark">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle"
                                        style="background-color: #000000;"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Dark</h5>
                    </div>

                    <div class="col-3">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-brand"
                                value="brand">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="topbar-color-brand">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle bg-primary"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Brand</h5>
                    </div>
                </div>
            </div>

            <div class="p-3 border-bottom border-dashed">
                <h5 class="mb-3 fs-16 fw-bold">Menu Color</h5>

                <div class="row">
                    <div class="col-3">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-menu-color" id="sidenav-color-light"
                                value="light">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="sidenav-color-light">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle bg-white"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Light</h5>
                    </div>

                    <div class="col-3">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-menu-color" id="sidenav-color-dark"
                                value="dark">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="sidenav-color-dark">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle"
                                        style="background-color: #000000;"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Dark</h5>
                    </div>
                    <div class="col-3">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-menu-color" id="sidenav-color-brand"
                                value="brand">
                            <label class="form-check-label p-0 avatar-lg w-100 bg-light" for="sidenav-color-brand">
                                <span class="d-flex align-items-center justify-content-center h-100">
                                    <span class="p-2 d-inline-flex shadow rounded-circle bg-primary"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Brand</h5>
                    </div>
                </div>
            </div>

            <div class="p-3 .border-bottom .border-dashed sidebarMode">
                <h5 class="mb-3 fs-13 text-uppercase fw-bold">Sidebar Size</h5>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size" id="sidenav-size-default"
                                value="default">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-default">
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                            <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Default</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size" id="sidenav-size-compact"
                                value="compact">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-compact">
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 border-end  flex-column p-1">
                                            <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Compact</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size" id="sidenav-size-small"
                                value="condensed">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-small">
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 border-end flex-column" style="padding: 2px;">
                                            <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Condensed</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size"
                                id="sidenav-size-small-hover" value="sm-hover">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-small-hover">
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 border-end flex-column" style="padding: 2px;">
                                            <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Hover View</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size" id="sidenav-size-full"
                                value="full">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-full">
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="d-block p-1 bg-dark-subtle mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Full Layout</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidenav-size"
                                id="sidenav-size-fullscreen" value="fullscreen">
                            <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-fullscreen">
                                <span class="d-flex h-100">
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-14 text-center text-muted mt-2">Hidden</h5>
                    </div>
                </div>
            </div>

            <div class="p-3 border-bottom border-dashed d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fs-16 mb-0">Container Width</h5>

                    <div class="btn-group radio" role="group">
                        <input type="radio" class="btn-check" name="data-container-position" id="container-width-fixed"
                            value="fixed">
                        <label class="btn btn-sm btn-soft-primary w-sm" for="container-width-fixed">Full</label>

                        <input type="radio" class="btn-check" name="data-container-position" id="container-width-scrollable"
                            value="scrollable">
                        <label class="btn btn-sm btn-soft-primary w-sm ms-0" for="container-width-scrollable">Boxed</label>
                    </div>
                </div>
            </div>

            <div class="p-3 border-bottom border-dashed d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fs-16 mb-0">Layout Position</h5>

                    <div class="btn-group radio" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed"
                            value="fixed">
                        <label class="btn btn-sm btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable"
                            value="scrollable">
                        <label class="btn btn-sm btn-soft-primary w-sm ms-0"
                            for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 px-3 py-2 offcanvas-header border-top border-dashed">
            <button type="button" class="btn w-50 btn-soft-danger" id="reset-layout">Reset</button>
            <a href="https://1.envato.market/coderthemes" target="_blank" class="btn w-50 btn-soft-info">Buy Now</a>
        </div>

    </div>

<!-- chatbox -->
<div class="chat_box">
<div class="chat_head d-flex align-items-center justify-content-end" style="background: #3c8dbc; padding: 5px 10px; position: relative;">
  <img src="{{asset('assets/icon/bell.png')}}" style="width:25px; height:25px; margin-right: 0px;">
  <span id="total_help" class="badge bg-danger rounded-circle">0</span>
</div>

<div class="searchBox" style="display: none;">
  <div class="searchBox-inner" align="center" style="border-right: 1px solid #d0d0d0;border-left: 1px solid #d0d0d0;border-top: 1px solid #d0d0d0;">
    <input type="text" id="myInput1" class="span3" style="margin-top: 6px;width: 90%;" onkeyup="myFunction1()" placeholder="Search Support...">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- chatbox -->
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

show_helpdesk();
function show_helpdesk() {
  $.ajax({
  url: "{{ url('Helpdesk/helpdesk_in') }}",
  method: 'GET',
  dataType: 'JSON',
  success: function(response) {
    var hitung = response.data.length;
    var elemenHTML = '<ul class="list-unstyled" id="style-5">';
    for (var i = 0; i < hitung; i++) {
      elemenHTML += '<li class="left clearfix" style="padding: 10px 10px; border-bottom: 1px solid #d0d0d0; position: relative;">';
      elemenHTML += '<a href="' + response.data[i].url + '" target="_blank" style="display: block;">';
      
      elemenHTML += '<small style="color: #999999; font-size: 10px; position: absolute; top: 5px; right: 10px;">';
      elemenHTML += '<i class="fa fa-clock-o"></i> ' + response.data[i].waktu + '</small>';

      elemenHTML += '<div style="display: flex; align-items: center; margin-top: 15px;">';
      elemenHTML += '<img src="' + response.data[i].image + '" class="img-circle" alt="User Image" style="width: 40px; height: 40px; margin-right: 10px;">';

      elemenHTML += '<div>';
      elemenHTML += '<h4 style="margin: 0; color: #444444; font-size: 15px;">' + response.data[i].name + '</h4>';
      elemenHTML += '<p style="margin: 0; font-size: 12px; color: #888888;">' + response.data[i].helpdesk + '</p>';
      elemenHTML += '</div>';

      elemenHTML += '</div>'; 
      elemenHTML += '</a>';
      elemenHTML += '</li>';
    }
    elemenHTML += '</ul>';
    $('#tampil_helpdesk').html(elemenHTML);
    $('#total_help').text(hitung);
  },
  error: function(xhr, status, error) {
    console.error("AJAX Error: ", error);
  }
});
}

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
</script>
<!-- chatbox -->

<!-- chatbox -->
<script type="text/javascript">
$('.chat_head').click(function(){
  $('.chat_body').slideToggle('slow');
  $('.searchBox').slideToggle('slow');
  $('.msg_box').hide('slow');
});

$('.msg_head').click(function(){
  $('.msg_wrap').slideToggle('slow');
});

$('.msg_box').hide();
$('.chat_body').hide();
$('.searchBox').hide();
</script>
<!-- chatbox -->

<script type="text/javascript">
function tampil_modul() {
    $.ajax({
        url: "{{ url('tampil_modul') }}",
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var elemenHTML = `
            <nav class="page-container">
                <div class="collapse navbar-collapse custom-scroll-horizontal" id="topnav-menu-content">
                    <ul class="navbar-nav">
            `;

            for (var i = 0; i < response.length; i++) {
                var modul = response[i];

                elemenHTML += `
                    <li class="nav-item dropdown hover-dropdown">
                        <a class="nav-link menu-item dropdown-toggle drop-arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="menu-icon"><i class="${modul.modul_icon}"></i></span>
                            <span class="menu-text">${modul.modul}</span>
                            <div class="menu-arrow"></div>
                        </a>
                        <div class="dropdown-menu">
                `;

                var menus = modul.menus;
                for (var j = 0; j < menus.length; j++) {
                    var menu = menus[j];

                    if (menu.tipe === 'dropdown' && menu.sub_menus.length > 0) {
                        elemenHTML += `
                            <div class="dropdown hover-dropdown">
                                <a class="dropdown-item dropdown-toggle drop-arrow-none" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="${menu.menu_icon}"></i>&ensp;${menu.menu}
                                    <div class="menu-arrow"></div>
                                </a>
                                <div class="dropdown-menu custom-dropdown-submenu">
                        `;

                        var sub_menus = menu.sub_menus;
                        for (var k = 0; k < sub_menus.length; k++) {
                            var sub_menu = sub_menus[k];

                            elemenHTML += `
                                <a href="#" class="dropdown-item custom-dropdown">
                                    <i class="${sub_menu.sub_menu_icon}"></i> ${sub_menu.sub_menu}
                                </a>
                            `;
                        }

                        elemenHTML += `</div></div>`; // Tutup submenu dropdown
                    } else {
                        elemenHTML += `
                        <a href="#" class="dropdown-item custom-dropdown">
                            <i class="${menu.menu_icon}"></i> ${menu.menu}
                        </a>
                        `;
                    }
                }

                elemenHTML += `</div></li>`; // Tutup modul dan menu
            }

            elemenHTML += `</ul></div></nav>`; // Tutup navbar

            $('#tampil_modul').html(elemenHTML);
        }
    });
}

tampil_modul();
</script>
    
<!-- Vendor js -->
<script src="{{asset('assets/AdminTO/assets/js/vendor.min.js')}}"></script>
<!-- App js -->
<script src="{{asset('assets/AdminTO/assets/js/app.js')}}"></script>
</body>
</html>