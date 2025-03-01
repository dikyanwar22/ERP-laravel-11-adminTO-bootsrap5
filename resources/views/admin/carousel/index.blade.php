@extends('layout.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('layout.breadcrumb')
<!-- Main content -->

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">

<section class="content">
  <div class="box">
    <div class="box-header">
      <a id="btn-modal-add" href="#" data-toggle="modal" data-target="#tambah" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
    </div>

    <div class="box-body">
      <table id="tabel1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Gambar</th>
            <th>Teks</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 1; foreach($carousel as $key => $row) : ?>
          <tr>
            <td class="text-center"><?= $no; ?></td>
            <td><img src="<?= asset('file/carousel/'.$row->img); ?>" width="50" height="50"></td>
            <td><?= $row->teks; ?></td>
            <td>
              <a onclick="editModal(<?= $row->id; ?>)" href="#" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&ensp;
              <a href="<?= url('Admin/Pengaturan/Destroy/'.$row->id); ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
          </tr>
        <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
  <!-- <div id="activator"></div> -->
</section>
</div>

<!-- Insert Data -->
<div class="modal custom-modal-add" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= url('Admin/Pengaturan/Store'); ?>" method="POST" class="form-horizontal form-validation" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
          <div class="widget-content">

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label">Gambar</label>
                <input name="img" class="form-control" type="file" required />
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label">Teks</label>
                <input name="teks" class="form-control" placeholder="Masukkan keterangan disini..." type="text" required />
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group" style="padding-left: 5%;">
                <label class="checkbox">
                  <input type="checkbox" value="1" name="agreement" required>
                  Saya bersedia bertanggung jawab atas data yang telah inputkan.
                </label>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal <i class="fa fa-close"></i></button>
          <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Simpan <i class="fa fa-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Insert Data -->

<!-- Modal Edit -->
<?php $no = 1; foreach($carousel as $key => $val) : ?>
<div class="modal custom-modal-edit<?= $val->id; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= url('Admin/Pengaturan/Update/'.$val->id); ?>" method="POST" class="form-horizontal form-validation" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h4 class="modal-title">Ubah Data</h4>
        </div>
        <div class="modal-body">
          <div class="widget-content" id="formEdit">
            <!-- inputan -->
            <div class="col-lg-12" hidden>
              <div class="form-group">
                <label class="form-label">Gambar Lama</label>
                <input name="img_lama" value="<?= $val->img; ?>" class="form-control" type="text"/>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label">Gambar</label>
                <input name="img" class="form-control" type="file"/>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label">Teks</label>
                <input value="<?= $val->teks; ?>" name="teks" class="form-control" placeholder="Masukkan keterangan disini..." type="text" required />
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group" style="padding-left: 5%;">
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
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal <i class="fa fa-close"></i></button>
          <button type="submit" name="submit" class="btn btn-primary submit" value="Submit">Update <i class="fa fa-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
<!-- Modal Edit -->

<!-- DataTables -->
<script src="{{asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- Custom Datatables -->
<script>
    $(document).ready(function(){
        $('#tabel1').DataTable();
        $('#tabel2').DataTable();
        $('#tabel3').DataTable();
        $('#tabel4').DataTable();
        $('#tabel5').DataTable();

        // custom modal
        $('#btn-modal-add').on('click', function() {
          $('.custom-modal-add').css('display', 'block').css('z-index', '9999');
        });
        // custom modal
    });

    // custom modal
    function editModal(id) {
      $('.custom-modal-edit'+id).modal('show');
      $('.custom-modal-edit'+id).css('display', 'block').css('z-index', '9999');
    }
    // custom modal
</script>
<!-- Custom Datatables -->
@endsection
