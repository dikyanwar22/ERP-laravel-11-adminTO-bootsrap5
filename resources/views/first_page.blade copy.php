@extends('layout.default')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('layout.breadcrumb')
<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
    </div>
    <div class="box-body">
      <h1 class="title text-center">SELAMAT DATANG <b>DIKY ANWAR</b></h1>
      <h2 class="text-center">Di Aplikasi Enterprise Resource Planning (ERP)</h2>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
      <span id="date_indonesia"></span>
    </div>
    <!-- /.box-footer-->
  </div><!-- /.box -->

  <div id="activator"></div>
</section>
</div>
<!-- End Main content -->

<script type="text/javascript">
    // Mendapatkan tanggal saat ini
    show_date();
    function show_date() {
      var tanggalSekarang = new Date();
      // Array nama-nama hari dalam bahasa Indonesia
      var namaHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
      // Array nama-nama bulan dalam bahasa Indonesia
      var namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

      // Mendapatkan hari dalam bahasa Indonesia
      var hari = namaHari[tanggalSekarang.getDay()];
      // Mendapatkan tanggal
      var tanggal = tanggalSekarang.getDate();
      // Mendapatkan bulan dalam bahasa Indonesia
      var bulan = namaBulan[tanggalSekarang.getMonth()];
      // Mendapatkan tahun
      var tahun = tanggalSekarang.getFullYear();

      // Menampilkan hasil
      var date_indonesia = hari + ", " + tanggal + " " + bulan + " " + tahun;
      document.getElementById('date_indonesia').innerHTML = date_indonesia;
    }
</script>

@endsection