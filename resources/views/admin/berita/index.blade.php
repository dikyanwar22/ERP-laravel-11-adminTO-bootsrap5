@extends('layout.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('layout.breadcrumb')
<!-- Main content -->
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">

<section class="content">

  @if(session('msg'))
  {!! session('msg') !!}
  @endif

  <div class="box box-solid">
   <div class="box-header with-border">
     <i class="fa fa-list-alt"></i>
     <h3 class="box-title">Report Data</h3>
   </div>
   <div class="box-body">
     <div class="row">
       <div class="col-md-12">
         <div>
           <form action="<?= url('Admin/Berita'); ?>" class="form-horizontal form-validation" method="post" accept-charset="utf-8">
             @csrf
             @method('POST')
             <div class="widget-content">
               <div class="form-group">

                 <div class="col-md-6">
                   <div class="control-group">
                     <label>Tanggal Awal</label>
                     <input type="date" name="awal" value="<?= $awal; ?>" class="form-control">
                   </div>
                 </div>

                 <div class="col-md-6">
                   <div class="control-group">
                     <label>Tanggal Akhir</label>
                     <input type="date" name="akhir" value="<?= $akhir; ?>" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-12">
                   <label class="form-label">&nbsp;</label>
                   <button type="submit" name="submit" class="btn btn-primary submit" value="Submit" style="width: 100%;margin-top: 5px;"><i class="fa fa-search"></i> Cari Data</button>
                 </div>
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
  </div>

<?php if(count($qu) > 0) : ?>
  <div class="box">
    <div class="box-header">
        <a href="<?= url('Admin/Berita/Tambah'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
    </div>

    <div class="box-body">
      <div class="table-responsive">
    <table id="tabel1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 1; foreach($qu as $key => $row) :
          $params_id = base64_encode($row->id);
          $id = rawurlencode($params_id);
        ?>
          <tr>
            <td class="text-center"><?= $no; ?></td>
            <td><?= $row->judul; ?></td>
            <td>
                <img style="max-width: 20%; max-heigt: 10%;" src="<?= asset('file/berita/'.$row->gambar); ?>">
            </td>
            <td><?= $row->isi; ?></td>
            <td><?= $row->penulis; ?></td>
            <td>
              <a href="<?= url('Admin/Berita/Edit/'.$id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&ensp;
              <a onclick="return confirm('Yakin Hapus?')" href="<?= url('Admin/Berita/Hapus/'.$row->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
  <?php endif; ?>
  <div id="activator"></div>
</section>
</div>

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<!-- Custom Datatables -->
<script>
    $(document).ready(function(){
        $('#tabel1').DataTable();
        $('#tabel2').DataTable();
        $('#tabel3').DataTable();
        $('#tabel4').DataTable();
        $('#tabel5').DataTable();
    });
</script>
<!-- Custom Datatables -->

@endsection
