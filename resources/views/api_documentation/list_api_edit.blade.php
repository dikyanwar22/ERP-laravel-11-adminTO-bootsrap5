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
          <h1><?= $v->nama; ?></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Menu</a></li>
            <li class="active"><?= $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <?php
          $par_id = base64_encode($v->id);
          $id_API = rawurlencode($par_id);
          ?>

          <div class="row">
            <!-- left column -->
            <div class="col-md-12">

              <!-- Notifikasi -->
              @if(session('msg'))
              {!! session('msg') !!}
              @endif
              <!-- Notifikasi -->

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Form <?= $title; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="<?= url('api/Documentation/action_edit_list_api/'.$edit->id); ?>" method="POST" role="form">
                  @csrf
                  @method('PUT')
                  <div class="box-body">

                    <div class="col-md-12">
                    <div class="form-group" hidden>
                      <label>ID API</label>
                      <input type="text" name="api_id" value="<?= $v->id; ?>" class="form-control">
                    </div>
                  </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama API</label>
                        <input value="<?= $edit->nama; ?>" type="text" name="nama" class="form-control" placeholder="Ex : API upload bukti transaksi" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kegunaan API</label>
                        <input value="<?= $edit->ket_nama; ?>" type="text" name="ket_nama" class="form-control" placeholder="Ex : API ini digunakan untuk" required>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Method API</label>
                        <select name="method" id="method" class="form-control" required>
                          <option value="">- Pilih -</option>
                          <?php
                          $method = ['GET', 'POST', 'PUT', 'DELETE'];
                          foreach($method as $row) : ?>
                          <option value="<?= $row; ?>" <?= ($edit->method == $row) ? 'SELECTED' : ''; ?>><?= $row; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-10">
                    <div class="form-group">
                      <label>URL API</label>
                      <input value="<?= $edit->url; ?>" type="text" name="url" class="form-control" placeholder="URL" required>
                    </div>
                  </div>

                  <div class="col-md-6" id="struktural_form">
                    <div class="form-group">
                      <label>Struktural</label>
                      <select name="struktural" id="struktural" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php
                        $struktural = ['Params', 'Body'];
                        foreach($struktural as $row) : ?>
                        <option value="<?= $row; ?>" <?= ($edit->struktural == $row) ? 'SELECTED' : ''; ?>><?= $row; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6" id="permintaan">
                  <div class="form-group">
                    <label>Permintaan</label>
                    <select name="permintaan" class="form-control">
                      <option value="">- Pilih -</option>
                      <?php
                      $permintaan = ['form-data', 'x-www-form-urlencoded', 'raw'];
                      foreach($permintaan as $row) : ?>
                      <option value="<?= $row; ?>" <?= ($edit->permintaan == $row) ? 'SELECTED' : ''; ?>><?= $row; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-12" id="inputan_body">
                <div class="form-group">
                  <label for="inputBody">Inputan Body</label>
                  <textarea value="" name="inputan" class="form-control" rows="3" placeholder="Inputan Body">
                    <?= $edit->inputan; ?>
                  </textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputBody">Hasil API</label>
                  <textarea value="" name="hasil" class="form-control" rows="3" placeholder="Hasil API" required>
                    <?= $edit->hasil; ?>
                  </textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required> Saya bersedia bertanggung jawab atas data yang telah inputkan.
                  </label>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?= url('api/Documentation/list_api/'.$id_API); ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
              &ensp;
              <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Update</button>
            </div>
          </form>
        </div><!-- /.box -->

      </div><!--/.col (right) -->
    </div>

  </section>
  <!-- Main content -->

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

<script type="text/javascript">
  $(document).ready(function() {
    // Initial visibility based on values
    var jMethod = '<?= $edit->method; ?>';
    var jStruktural = '<?= $edit->struktural; ?>';

    updateVisibility(jMethod, jStruktural);

    // Handle changes in the 'method' dropdown
    $('#method').change(function() {
      var method = $(this).val();
      updateVisibility(method, jStruktural);
    });

    // Handle changes in the 'struktural' dropdown
    $('#struktural').change(function() {
      var struktural = $(this).val();
      updateVisibility(jMethod, struktural);
    });

    // Function to update visibility based on method and struktural values
    function updateVisibility(method, struktural) {
      $('#struktural_form').toggle(method === 'POST' || method === 'PUT');
      $('#permintaan').toggle(struktural === 'Body' && (method === 'POST' || method === 'PUT'));
      $('#inputan_body').toggle(struktural === 'Body' && (method === 'POST' || method === 'PUT'));
    }
  });
</script>

</body>
</html>
