<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', $title)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/skins/_all-skins.min.css')}}">

    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

    <!-- Modul -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hoe.css') }}" media="screen" />
    <style type="text/css">

    .tanggal-picker {
      position: relative;
    }

    .tanggal-picker i {
      position: absolute;
      bottom: 10px;
      right: 24px;
      top: auto;
      cursor: pointer;
    }

    .subnavbar-inner {
      height: auto;
    }

    .subnavbar .container>ul {
      display: flex;
      height: 70px;
      overflow-x: auto;
      overflow-y: hidden;
    }

    .subnavbar .container>ul {
      cursor: pointer;
    }

    .subnavbar .container>ul::-webkit-scrollbar {
      background: #fff;
      height: 7px;
    }

    .subnavbar .container>ul::-webkit-scrollbar-thumb {
      background: #eee;
      border-radius: 4px;
    }

    .subnavbar .container:hover>ul::-webkit-scrollbar-thumb {
      background: #9c0001;
    }

    .subnavbar .container>ul>li {
      min-width: fit-content;
      width: 100%;
      max-width: 130px;
    }

    .subnavbar .container>ul>li>a {
      font-size: 11px;
      font-weight: 400;
    }
    </style>
    <!-- End Modul -->

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

    <style>
    @media only screen and (min-width: 768px) {
      .scrollmenu {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
        width: 700px;
      }
      .navbar-custom-menu>.navbar-nav>li {
        /*border-left: 1px solid #db1414;*/
        border-left: 1px;
      }
      .navbar-nav.in {
        display: flex;
        overflow-x: auto;
        padding-right: 3rem;
      }
      .navbar-nav.in::-webkit-scrollbar {
        height: 6px;
        /*background: #0000FF; /*biru tua*/*/

      }
      .navbar-nav.in::-webkit-scrollbar-thumb {
        border-radius: 5px;
        /*background: #0000002e;*/
        /*border: 3px solid #f93154;*/
      }
      .navbar-nav.in:hover::-webkit-scrollbar-thumb {
        background: #00000059;
      }
      .box-modul {
        background: #6495ED;
        margin-right: 5px;
        border-radius: 5px;
      }
    }
    </style>

    <style>
    /* Media query untuk layar dengan lebar kurang dari atau sama dengan 600px */
    @media only screen and (max-width: 600px) {
      .name-enterprise-laptop {
        display: none;
      }
      .no-underline {
        text-decoration: none;
      }
    }

    /* Media query untuk layar dengan lebar lebih dari 600px */
    @media only screen and (min-width: 601px) {
      .name-enterprise-hp {
        display: none;
        text-decoration: none;
      }
      .no-underline {
        text-decoration: none;
      }
    }
  </style>

  </head>

  <!-- <body class="hold-transition skin-blue sidebar-mini"> -->
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
