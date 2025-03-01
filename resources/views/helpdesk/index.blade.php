@extends('layout.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
@include('layout.breadcrumb')

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="{{ url('Helpdesk/create') }}" class="btn btn-success btn-block margin-bottom"><i class="fa fa-plus"></i> CREATE HELPDESK</a><br>
              @include('helpdesk.tag')
            </div><!-- /.col -->

            <div class="col-md-9">
            <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">Inbox</h3>
                      </div>

                      <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                          <table id="table-main" class="table table-hover table-striped">
                            <tbody></tbody>
                          </table>
                        </div>
                      </div>

                    </div>
            </div><!-- /.col -->

            
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

@endsection

<!-- DataTables -->
<script src="{{asset('assets/AdminLTE/bootstrap/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var $jq = jQuery.noConflict();
$jq(document).ready(function() {

  $jq('#table-main').DataTable({
    destroy: true,
    processing: true,
    serverSide: false,
    ajax: {
      url: "{{ url('Helpdesk/data_main') }}",
      method: 'POST',
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
      { data: null, orderable: false, render: function() { return '<input type="checkbox">'; } },
      { data: null, orderable: false, render: function() { return '<a href="#"><i class="fa fa-star-o text-yellow"></i></a>'; } },
      {
        data: 'name',
        render: function(data, type, row) {
            return `<a href="{{ url('Helpdesk/detail_inbox') }}/${row.id}">${data}</a>`;
        }
      },
      { 
        data: 'message', 
        render: function(data) { 
          const truncatedMessage = data.length > 40 ? data.substring(0, 40) + '...' : data; 
          return `<b>${truncatedMessage}</b>`; 
        } 
      },

      { 
        data: 'file', 
        render: function(data) { 
          return data ? `<i class="fa fa-paperclip"></i>` : ''; 
        } 
      },
     
      { data: 'created_at', render: function(data) { return new Date(data).toLocaleString(); } }
    ]

  });

});
</script>
