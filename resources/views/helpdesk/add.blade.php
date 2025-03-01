@extends('layout.default')
@section('content')

<link rel="stylesheet" href="{{asset('assets/AdminLTE/plugins/select2/select2.min.css')}}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
@include('layout.breadcrumb')

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="{{ url('Helpdesk') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a><br>
              @include('helpdesk.tag')
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create New Helpdesk</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <div class="form-group">
                  <label>Destination</label>
                  <select id="level" class="form-control select2" style="width: 100%;">
                      <option value="">-Choose-</option>
                  </select>
                  </div>

                  <div class="form-group">
                  <label>Category</label>
                  <select id="category" class="form-control select2" style="width: 100%;">
                      <option value="">-Choose-</option>
                  </select>
                  </div>

                  <div class="form-group">
                  <label>URL</label>
                  <input class="form-control" name="url_error" id="url_error" placeholder="https://example.com/" required>
                  </div>

                  <div class="form-group">
                  <label>Message</label>
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" placeholder="input helpdesk in here..."></textarea>
                  </div>

                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
                      <input type="file" name="attachment" id="attachment">
                    </div>
                    <p id="file-name"></p>
                    <p class="help-block">Max. 32MB</p>
                  </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="submit" id="btn-save" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <!-- <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button> -->
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

@endsection

<script src="{{asset('assets/AdminLTE/bootstrap/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/AdminLTE/plugins/select2/select2.full.min.js')}}"></script>
<script>
var $jq = jQuery.noConflict();
  $jq(document).ready(function() {
    $jq(".select2").select2(); 

    function loadCategories() {
        $jq.ajax({
            url: "{{ url('Helpdesk/cat_helpdesk') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    let options = '<option value="">-Choose-</option>';
                    response.data.forEach(function(category) {
                        options += `<option value="${category.id}">${category.name}</option>`;
                    });
                    $jq("#category").html(options);
                } else {
                    console.error("Failed to load categories");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching categories:", error);
            }
        });
    }
    loadCategories();

    function loadLevel() {
      $jq.ajax({
            url: "{{ url('Helpdesk/level') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    let options = '<option value="">-Choose-</option>';
                    response.data.forEach(function(level) {
                        options += `<option value="${level.id}">${level.nama}</option>`;
                    });
                    $jq("#level").html(options);
                } else {
                    console.error("Failed to load categories");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching categories:", error);
            }
        });
    }
    loadLevel();

  });


  $jq(document).on('click', '#btn-save', function() {

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

    const destination = $('#level').val();
    const problem = $('#category').val();
    const url_error = $('#url_error').val();
    const caption = $('#compose-textarea').val();

    const upload_file = $('#attachment')[0].files[0];

    if (!destination) return showAlert("Please fill input field for Destination");
    if (!problem) return showAlert("Please fill input field for Category");
    if (!url_error) return showAlert("Please fill input field for URL");
    if (!caption) return showAlert("Please fill input field for Message");

    Swal.fire({
      title: 'Saving Data...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    const formData = new FormData();

    formData.append('destination', destination);
    formData.append('problem', problem);
    formData.append('url_error', url_error);
    formData.append('caption', caption);

    if (upload_file) formData.append('upload_file', upload_file);

    $.ajax({
      url: "{{ url('Helpdesk/sending_helpdesk') }}",
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        Swal.close();
        Swal.fire({
          title: "Success",
          text: response.message,
          icon: 'success',
          confirmButtonText: 'Close'
        }).then(() => window.location.reload());
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

$jq(document).on("change", "#attachment", function() {
    var fileName = this.files[0] ? this.files[0].name : "Nama File";
    document.getElementById("file-name").textContent = fileName;
});

function showAlert(message) {
Swal.fire({
    title: "Warning",
    text: message,
    icon: 'warning',
    confirmButtonText: 'Close'
});
}
</script>

