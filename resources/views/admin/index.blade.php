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

  <!-- <div class="box box-solid">
   <div class="box-header with-border">
     <i class="fa fa-list-alt"></i>
     <h3 class="box-title">Report Data</h3>
   </div>
   <div class="box-body">
     <div class="row">
       <div class="col-md-12">
         <div>
           <form action="" class="form-horizontal form-validation" method="post" accept-charset="utf-8">
             <div class="widget-content">
               <div class="form-group">

                 <div class="col-lg-3">
                   <div class="control-group">
                     <label>Email</label>
                     <input type="text" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-3">
                   <div class="control-group">
                     <label>Email</label>
                     <input type="text" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-3">
                   <div class="control-group">
                     <label>Email</label>
                     <input type="text" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-3">
                   <div class="control-group">
                     <label>Email</label>
                     <input type="text" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-12">
                   <label class="form-label">&nbsp;</label>
                   <button type="submit" id="find" name="find" class="btn btn-primary submit" value="Submit" style="width: 100%;margin-top: 5px;"><i class="fa fa-search"></i> Find</button>
                 </div>
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div> -->

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Pertanyaan Calon Konsumen</h3>
    </div>

    <div class="box-body">
      <table id="tabel1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telp</th>
            <th>Pesan</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 1; foreach($question as $key => $row) : ?>
          <tr>
            <td class="text-center"><?= $no; ?></td>
            <td><?= $row->nama; ?></td>
            <td><?= $row->email; ?></td>
            <td><?= $row->telp; ?></td>
            <td><?= $row->pesan; ?></td>
          </tr>
        <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>

  <div id="activator"></div>
</section>
</div>

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
    });
</script>
<!-- Custom Datatables -->

@endsection
