@extends('layout.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('layout.breadcrumb')

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?= asset('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>

<script>
  tinymce.init({
    selector: '.textEditor',
    plugins: 'link lists image advlist fullscreen media code table emoticons textcolor codesample hr preview',
    menubar: false,
    toolbar: [
      'undo redo | bold italic underline strikethrough forecolor backcolor bullist numlist | blockquote subscript superscript | alignleft aligncenter alignright alignjustify | image media link',
      ' formatselect | cut copy paste selectall | table emoticons hr | removeformat | preview code | fullscreen',
    ],
  });
</script>

<!-- Main content -->
<section>
  <div class="col-md-12">

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Form <?= $title; ?></h3>
      </div>

      @if(session('msg'))
      {!! session('msg') !!}
      @endif

      <form action="<?= url('Admin/Pengaturan/Update/'.$info->id); ?>" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

          <div class="col-md-3" hidden>
            <div class="form-group">
              <label>Logo Perumahan</label>
              <input type="text" name="gambar_lama" value="<?= $info->logo_perumahan; ?>" class="form-control">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Logo Perumahan</label>
              <input type="file" name="logo_perumahan" class="form-control">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Nama Perumahan</label>
              <input value="<?= $info->nama_perumahan; ?>" type="text" name="nama_perumahan" class="form-control" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Telp</label>
              <input value="<?= $info->telp; ?>" type="text" name="telp" class="form-control" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Email</label>
              <input value="<?= $info->email; ?>" type="text" name="email" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>URL FB</label>
              <input value="<?= $info->link_fb; ?>" type="text" name="link_fb" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>URL IG</label>
              <input value="<?= $info->link_ig; ?>" type="text" name="link_ig" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>URL WA</label>
              <input value="<?= $info->link_wa; ?>" type="text" name="link_wa" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>URL Maps</label>
              <input value="<?= $info->url_maps; ?>" type="text" name="url_maps" class="form-control" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Alamat</label>
              <input value="<?= $info->alamat; ?>" type="text" name="alamat" class="form-control" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Keterangan Perumahan</label>
              <textarea value="" name="ket_perumahan" class="textEditor" cols="80" rows="15"><?= $info->ket_perumahan; ?></textarea>
            </div>
          </div>

        </div>
        <div class="box-footer text-center">
          <a onclick="window.history.back()" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>&ensp;
          <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
        </div>
      </form>
    </div>

  </div>

  <div id="activator"></div>
</section>
<!-- Main content -->
</div>
<!-- /.content-wrapper -->
@endsection
