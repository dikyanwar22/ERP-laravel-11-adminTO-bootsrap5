<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', $title)</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="{{ url('erp/Documentation/modul') }}" class="navbar-brand"><b>HOME</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <div class="container">
        <section class="content-header">
          <h1>{{ $title }}</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Menu</a></li>
            <li class="active">{{ $title }}</li>
          </ol>
        </section>

        <section class="content">

          <div id="notifikasi">
            @if(session('msg'))
              {!! session('msg') !!}
            @endif
          </div>

          <div class="box">
            <div class="box-header">
              <a href="#" data-toggle="modal" data-target="#modal-insert" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>

            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th width="15%">Nama Modul</th>
                            <th width="50%">Deskripsi</th>
                            <th width="20%">Hak Akses</th>
                            <th width="15%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($modul as $key => $row)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $row->modul }}</td>
                              <td>{{ $row->deskripsi }}</td>
                              <td>{{ $row->hak_akses }}</td>
                              <td>
                                <a href="#" onclick="editModal('{{ $row->id }}')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('erp/Documentation/deleteModul/'.$row->id) }}" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <a href="{{ url('erp/Documentation/menu/'.rawurlencode(base64_encode($row->modul_id))) }}" class="btn btn-warning btn-sm"><i class="fa fa-search"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Insert Data Modal -->
        <div class="modal" id="modal-insert">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ url('erp/Documentation/insertModul') }}" method="POST" class="form-horizontal form-validation">
                @csrf
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <label class="form-label">Pilih Modul</label>
                      <select id="modul" name="modul" class="form-control" required></select>
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label">Deskripsi Modul</label>
                      <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi disini" required></textarea>
                    </div>

                    <div class="col-lg-12" style="padding-top: 10px;">
                      <input type="checkbox" value="1" name="agreement" required> Saya bersedia bertanggung jawab atas data yang telah inputkan.
                    </div>

                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                  <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Simpan <i class="fa fa-check"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal" id="ViewEditModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ url('erp/Documentation/updateModul') }}" method="POST" class="form-horizontal form-validation">
                @csrf
                <div class="modal-header">
                  <h4 class="modal-title">Ubah Data</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <div class="col-lg-12" hidden>
                      <label class="form-label">ID</label>
                      <input name="id" id="id" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label">Pilih Modul</label>
                      <select name="modul_id" id="modul_id" class="form-control" required></select>
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label">Deskripsi Modul</label>
                      <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi disini" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                  <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Submit <i class="fa fa-check"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </div>
    </footer>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/plugins/fastclick/fastclick.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/dist/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/AdminLTE/dist/js/demo.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $.ajax({
            url: "{{ url('erp/Documentation/getModul') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#modul').empty();
                $.each(response.data, function(index, value) {
                    $('#modul').append('<option value="' + value.id + '">' + value.nama + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    });

    function editModal(id) {
        $("#ViewEditModal input[name='id']").val(id);

        $.ajax({
            url: "{{ url('erp/Documentation/fetchModul') }}",
            type: 'POST',
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == 200) {
                    // Isi input field dengan data dari response
                    $('#ViewEditModal input[name="id"]').val(response.data.id);
                    $('#deskripsi').val(response.data.deskripsi);

                    // Clear options di select modul
                    $('#modul_id').empty();

                    // Loop untuk menambahkan opsi modul
                    $.each(response.modul, function(index, modul) {
                        let selected = modul.id == response.data.modul_id ? 'selected' : '';
                        $('#modul_id').append('<option value="'+modul.id+'" '+selected+'>'+modul.nama+'</option>');
                    });

                    // Tampilkan modal
                    $("#ViewEditModal").modal('show');
                } else {
                    alert('Gagal mendapatkan data.');
                }
            },
            error: function() {
                alert('Terjadi kesalahan dalam memuat data.');
            }
        });
    }

    // Menutup notifikasi setelah 4 detik (4000 milidetik)
    setTimeout(function() {
        document.getElementById('notifikasi').style.display = 'none';
    }, 4000);
</script>
</body>
</html>
