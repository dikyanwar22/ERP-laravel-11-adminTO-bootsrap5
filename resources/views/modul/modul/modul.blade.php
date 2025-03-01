<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $title)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                    <div style="padding-bottom: 30px;">
                        <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('modul') }}">Modul</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('menu') }}">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sub_menu') }}">Sub Menu</a>
                            </li>
                        </ul>
                    </div>
                        <a href="{{route('modul_add')}}" class="btn btn-md btn-success mb-3">TAMBAH</a>
                        <table class="table table-bordered" id="tabel1">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Modul</th>
                                <th scope="col">Folder di Controller</th>
                                <th scope="col">Akses Level</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if($data->count() > 0) : ?>
                              <?php $no = 1; foreach($data as $post) :
                                $params_id = base64_encode($post->id);
                                $id = rawurlencode($params_id);
                              ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $post->nama }}</td>
                                    <td>{{ $post->uri }}</td>
                                    <td>
                                        <?php foreach ($akses[$post->id] as $level_akses): ?>
                                            <li>{{ $level_akses }}</li>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>{{ ($post->deleted == '0') ? 'Tampil' : 'Tutup' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('modul_edit', $id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                              <?php else : ?>
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              <?php endif; ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Modal title</h4>
        <button type="button" class="btn-close" data-dismiss="modal">X</button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>

    <!-- Custom Datatables -->
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
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

</body>
</html>
