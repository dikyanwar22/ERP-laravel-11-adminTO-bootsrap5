@extends('layout.default')
@section('content')
<!-- Bootstrap 3 for modal -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('layout.breadcrumb')
<!-- Main content -->
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
<section class="content">

   <div class="box box-solid">
   <div class="box-header with-border">
     <i class="fa fa-list-alt"></i>
     <h3 class="box-title">Report Data</h3>
   </div>

   <div class="box-body">
     <div class="row">
       <div class="col-md-12">
         <div>
           <!-- <form action="" class="form-horizontal form-validation" method="post" accept-charset="utf-8"> -->
             <div class="widget-content">
               <div class="form-group">

                 <div class="col-lg-8">
                   <div class="control-group">
                     <label>Category</label>
                     <input type="text" id="category" name="category" class="form-control" placeholder="Category">
                   </div>
                 </div>

                 <div class="col-lg-4">
                   <div class="control-group">
                     <label>Date</label>
                     <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control">
                   </div>
                 </div>

                 <div class="col-lg-12">
                   <label class="form-label">&nbsp;</label>
                   <button type="submit" id="btn-save" name="btn-save" class="btn btn-primary submit" value="Submit" style="width: 100%;margin-top: 5px;"><i class="fa fa-plus"></i> Add</button>
                 </div>
               </div>
             </div>
           <!-- </form> -->
         </div>
       </div>
     </div>
   </div>

   <div class="box-body">
     <div class="row">
       <div class="col-md-12">
         <div>
             <div class="widget-content">
               <div class="form-group">

               <div class="box-body">

                  <div class="form-group col-md-3">
                    <label>Scan Here</label>
                    <div class="input-group">
                      <input type="text" id="input-scan" class="form-control" placeholder="Scan Here">
                      <a href="#" id="btn-scan" class="input-group-addon"><i class="fa fa-qrcode"></i></a>
                    </div>
                  </div>

              </div>

               </div>
             </div>
         </div>
       </div>
     </div>
   </div>

   
  <div class="box-body">
     <div class="row">
       <div class="col-md-12">
         <div>
             <div class="widget-content">
               <div class="form-group">

               <div class="box-body">

                  <form action="{{ url('import_excel') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group col-md-3">
                          <label>Impor Excel</label>
                          <div class="input-group">
                              <input type="file" name="file" id="input-import-excel" class="form-control" required> 
                              <span class="input-group-btn">
                                  <button type="submit" id="btn-import-excel" class="btn btn-primary">
                                      <i class="fa fa-upload"></i>
                                  </button>
                              </span>
                          </div>
                      </div>
                  </form>

                  <a href="{{ url('export_excel') }}" class="btn btn-success">Download Excel</a>


              </div>

               </div>
             </div>
         </div>
       </div>
     </div>
   </div>

   

   
 </div> 

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Helpdesk Categories</h3>
    </div>

    <div class="box-body">
      <div class="table-responsive">
      <table id="tabel_main" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>ID</th>
            <th>Categories</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      </div>
    </div>

  </div>

<!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div id="myModalBody"></div>
    </div>
</div>
<!-- modal -->

@include('library.qr_code')
</section>
</div>

<!-- jQuery for modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- jQuery for DataTables -->
<script src="{{asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- Custom Datatables -->
<script>
$("#btn-scan").on('click', function() {
  $('#modal-qr').modal('show');
});

$("#btn-scan").click(function() {
  $('#modal-qr').modal('show');
  docReady(function() {
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
      if (decodedText !== lastResult) {
        $("#input-scan").val(decodedText);
        html5QrcodeScanner.clear();
        $('#modal-qr').modal('hide');

        // ajax here
        // ajax here

      }
    }
    html5QrcodeScanner.render(onScanSuccess);
  });
});


$(document).ready(function(){
    $('#tabel_main').DataTable({
        destroy: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ url('Helpdesk/data_category') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dataSrc: function(data) {
                console.log("Data received: ", data);
                return data.data ? data.data : [];
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        columns: [
            {
                data: null,
                className: "text-center",
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    return `<a href="">${data}</a>`;
                }
            },
            {
                data: 'name',
                render: function(data, type, row) {
                    return `<a href="">${data}</a>`;
                }
            },
            {
                data: 'name',
                className: "text-center",
                render: function(data, type, row) {
                    return `<a onclick="getDetail(${row.id})" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a>`;
                }
            }
        ]
    });
});

$("#btn-save").on('click', function() {

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, save it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }

    const category = $("#category").val();

    if (!category) return showAlert("Please fill input field for Category");

    Swal.fire({
      title: 'Saving Data...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    $.ajax({
      url: "{{ url('Helpdesk/insert_category') }}",
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      data: {category: category},
      success: function (response) {
        Swal.close();
        Swal.fire({
          title: "Success",
          text: response.message,
          icon: 'success',
          confirmButtonText: 'Close'
        }).then(() => {
            $('#tabel_main').DataTable().ajax.reload();
            // window.location.reload()
        });
      },
      error: function (xhr) {
        Swal.close();
        Swal.fire({
          title: "Error",
          text: xhr.responseJSON?.message || "Failed to save data, please try again.",
          icon: 'error',
          confirmButtonText: 'Close'
        });
      }
    });

    });

});

function getDetail(id) {
  $.ajax({
    url: "{{ url('Helpdesk/detail_modal') }}",
    method: 'GET',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    success: function(data) {
      $('#myModalBody').html(data);
      $('#myModal').modal('show');
      showDetail(id);
    },
    error: function(xhr, status, error) {
      Toast.fire({
        icon: "error",
        title: JSON.parse(xhr.responseText).error
      });
    }
  });
}

function showAlert(message) {
Swal.fire({
    title: "Warning",
    text: message,
    icon: 'warning',
    confirmButtonText: 'Close'
});
}
</script>
<!-- Custom Datatables -->

@endsection
