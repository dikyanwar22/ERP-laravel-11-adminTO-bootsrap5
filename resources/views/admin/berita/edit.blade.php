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

      <form action="<?= url('Admin/Berita/EditBerita/'.$e->id); ?>" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

          <div class="col-md-4" hidden>
            <div class="form-group">
              <label>Gambar Berita Lama</label>
              <input type="text" value="<?= $e->gambar; ?>" name="gambar_lama" class="form-control" required>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Gambar Berita</label>
              <input type="file" name="gambar" class="form-control">
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
              <label>Judul Berita</label>
              <input type="text" value="<?= $e->judul; ?>" name="judul" class="form-control" placeholder="Judul Berita" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Isi Berita</label>
              <textarea name="isi" value="" class="textEditor" cols="80" rows="15"><?= $e->isi; ?></textarea>
            </div>
          </div>

        </div>
        <div class="box-footer text-center">
          <a onclick="window.history.back()" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>&ensp;
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update</button>
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
