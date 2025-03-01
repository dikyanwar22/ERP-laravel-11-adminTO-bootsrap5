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
          <h1><?= $name_api->nama; ?></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Menu</a></li>
            <li class="active"><?= $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Notifikasi -->
          @if(session('msg'))
          {!! session('msg') !!}
          @endif
          <!-- Notifikasi -->

          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <?php
              $variable = isset($name_api->id) ? $name_api->id : '';
              $par_id = base64_encode($variable);
              $id_API = rawurlencode($par_id);
              ?>
              <a href="<?= url('api/Documentation/add_list_api/'.$id_API); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="row">
                  <div class="col-sm-12">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr>
                          <th>Method</th>
                          <th>ID</th>
                          <th>Judul</th>
                          <th>URL</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($list_api->get() as $key => $row) :
                          $params_id = base64_encode($row->id);
                          $id = rawurlencode($params_id);

                          if(isset($row->method)) {
                            $color = '';
                            switch ($row->method) {
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
                        <tr>
                          <td>
                            <a href="#" class="btn btn-<?= $color; ?> btn-sm"><?= $row->method; ?></a>
                          </td>
                          <td><?= $row->id; ?></td>
                          <td><?= $row->nama; ?></td>
                          <td><?= $row->url; ?></td>
                          <td>
                            <a href="<?= url('api/Documentation/edit_list_api/'.$id.'/'.$id_API); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="<?= url('api/Documentation/deleted_list_api/'.$row->id); ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            <a href="<?= url('api/Documentation/result/'.$id); ?>" class="btn btn-warning btn-sm"><i class="fa fa-search"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.content -->

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
