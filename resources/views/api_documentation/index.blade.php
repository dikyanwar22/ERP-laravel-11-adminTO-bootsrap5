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

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="{{ url('api/Documentation') }}" class="navbar-brand"><b>HOME</b></a>
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
          <h1><?= $title; ?></h1>
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
              <a href="#" data-toggle="modal" data-target="#modal-insert" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
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
                          <th width="80%">Nama API</th>
                          <th width="20%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($api_data as $key => $row) :
                          $params_id = base64_encode($row->id);
                          $id = rawurlencode($params_id);
                        ?>
                        <tr>
                          <td><?= $row->nama ?></td>
                          <td>
                            <a href="#" onclick="editModal('<?= $row->id; ?>')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="{{ url('api/Documentation/deleted_api/'.$row->id) }}" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            <a href="{{ url('api/Documentation/list_api/'.$id) }}" class="btn btn-warning btn-sm"><i class="fa fa-search"></i></a>
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
        <!-- Main content -->

        <!-- Insert Data -->
        <div class="modal" id="modal-insert">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('api/Documentation/api_add') }}" method="POST" class="form-horizontal form-validation">
                      @csrf
                      @method('POST')
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                            <div class="widget-content">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label class="form-label">Nama API</label>
                                        <input name="nama" class="form-control" placeholder="Nama" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:20px">
                                    <div class="col-lg-12">
                                        <label class="checkbox">
                                            <input type="checkbox" value="1" name="agreement" required>
                                            Saya bersedia bertanggung jawab atas data yang telah inputkan.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Simpan <i class="fa fa-check"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Insert Data -->

        <!-- Modal Edit -->
      <div class="modal" id="ViewEditModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form action="{{ url('api/Documentation/api_edit') }}" method="POST" class="form-horizontal form-validation">
                    @csrf
                    @method('PUT')
                      <div class="modal-header">
                          <h4 class="modal-title">Ubah Data</h4>
                      </div>
                      <div class="modal-body">
                          <div class="widget-content" id="formEdit">
                            <!-- inputan -->
                            <div class="form-group row" hidden>
                                <div class="col-lg-12">
                                    <label class="form-label">ID API</label>
                                    <input name="id" id="id-edit" class="form-control" placeholder="Nama" type="text" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="form-label">Nama API</label>
                                    <input name="nama" id="nama-edit" class="form-control" placeholder="Nama" type="text" required />
                                </div>
                            </div>
                            <div class="form-group row" style="margin-left:20px">
                                <div class="col-lg-12">
                                    <label class="checkbox">
                                        <input type="checkbox" value="1" name="agreement" required>
                                        Saya bersedia bertanggung jawab atas data yang telah inputkan.
                                    </label>
                                </div>
                            </div>
                            <!-- inputan -->
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Submit <i class="fa fa-check"></i></button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <!-- Modal Edit -->


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
  function editModal(id) {
    $.ajax({
      url: `/api/Documentation/editModal/${id}`,
      type: "GET",
      dataType: 'json',
      cache: false,
      success:function(response) {
        $('#id-edit').val(response.id);
        $('#nama-edit').val(response.nama);
        $('#ViewEditModal').modal('show');
      }
    });
  }

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
