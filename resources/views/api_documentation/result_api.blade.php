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
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/skins/_all-skins.min.css')}}">
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?= url('api/Documentation'); ?>" class="navbar-brand"><b>HOME</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
        </div>
      </nav>
    </header>

    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Menu</a></li>
            <li class="active"><?= $title; ?></li>
          </ol>
        </section>

    <!-- Main Content -->
    <div class="content body">

      <section id="introduction">
        <h1 class="page-header"><?= $v->nama; ?></h1>
        <p><?= $v->ket_nama; ?></p>
      </section>

      <?php
      if(isset($v->method)) {
        $color = '';
        switch ($v->method) {
          case 'GET':
          $color = 'primary';
          break;

          case 'DELETE':
          $color = 'danger';
          break;

          case 'PUT':
          $color = 'warning';
          break;

          default:
          $color = 'success';
          break;
        }
      }
      ?>
      <section id="introduction">
        <a href="#" class="btn btn-<?= $color; ?> btn-xs"><?= $v->method; ?></a>
        <p></p>
        <div class="form-group">
          <input type="text" class="form-control" value="<?= $v->url; ?>" readonly>
        </div>
      </section>

      <section>
        <div style="display: flex; flex-direction: row;">
          <h5 style="width: 8%;">Struktural</h5>
          <h5>: <?= $v->struktural; ?></h5>
        </div>

        <?php if (in_array($v->method, ['POST', 'PUT'])) : ?>
          <div style="display: flex; flex-direction: row;">
            <h5 style="width: 8%;">Permintaan</h5>
            <h5>: <?= $v->permintaan; ?></h5>
          </div>
        <?php endif; ?>
      </section>

      <?php if (in_array($v->method, ['POST', 'PUT'])) : ?>
      <section id="components" data-spy="scroll" data-target="#scrollspy-components">
        <h4>Inputan :</h4>
        <pre class="prettyprint"><?= $v->inputan; ?></pre>
      </section>
      <?php endif; ?>

      <section id="components" data-spy="scroll" data-target="#scrollspy-components">
        <h4>Hasil :</h4>
        <pre class="prettyprint"><?= $v->hasil; ?></pre>
      </section>

        </div>
        <!-- Main Content -->

      </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </div><!-- /.container -->
    </footer>
  </div><!-- ./wrapper -->

  <!-- DataTables -->
  <script src="{{asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('assets/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('assets/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('assets/AdminLTE/plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/AdminLTE/dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('assets/AdminLTE/dist/js/demo.js')}}"></script>
  <!-- page script -->

  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  </script>

</body>
</html>
