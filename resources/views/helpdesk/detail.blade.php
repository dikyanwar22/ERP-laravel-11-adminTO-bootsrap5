@extends('layout.default')
@section('content')

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
                  <h3 class="box-title">Detail Helpdesk</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3 id="subjek"></h3>
                    <h5>From: <span id="sender"></span> <span class="mailbox-read-time pull-right" id="created_at"></span></h5>
                  </div><!-- /.mailbox-read-info -->

                  <div class="mailbox-read-message">
                    <p>Hello <span id="destination"></span> Team,</p>
                    <p id="message"></p>
                    <br>
                    <p>URL : <span id="url_error"></span></p>
                    <br>
                    <p>Thanks,<br><span id="sender-user"></span></p>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    
                <div id="attachment-container"></div>

                </div><!-- /.box-footer -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default" id="btn_reply"><i class="fa fa-reply"></i> Reply</button>
                  </div>
                  <!-- <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
                </div>
                <!-- /.box-footer -->

              <div class="box-body" id="reply_message">
                <div class="form-group">
                  <label>Reply</label>
                  <textarea id="compose-textarea" class="form-control" style="height: 200px" placeholder="Enter text reply here"></textarea>
                </div>
                <div class="pull-right">
                    <button class="btn btn-success" id="btn-reply"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
              </div>

              </div><!-- /. box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

@endsection

<script src="{{asset('assets/AdminLTE/bootstrap/js/jquery-3.6.0.min.js')}}"></script>
<script>
var $jq = jQuery.noConflict();
  $jq(document).ready(function() {

    $("#reply_message").hide();

    function detail_helpdesk() {
    const urlSegments = window.location.pathname.split("/");
    const id = urlSegments[urlSegments.length - 1];

    $.ajax({
        url: "{{ url('Helpdesk/look_helpdesk') }}",
        type: "POST",
        data: { id: id },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            if (response.status && response.data.length > 0) {
                let data = response.data[0];

                $("#sender").text(data.sender);
                $("#destination").text(data.destination);
                $("#sender-user").text(data.sender);
                $("#created_at").text(data.created_at);
                $("#message").text(data.message);
                $("#url_error").text(data.url);

                if (!data.reply_message) {
                    $("#btn_reply").show();
                  } else {
                    $("#btn_reply").hide();
                }

                if (data.doc) {
                let attachmentHtml = `
                    <ul class="mailbox-attachments clearfix">
                        <li>
                            <span class="mailbox-attachment-icon has-img">
                                <img src="https://cdn-icons-png.flaticon.com/512/124/124837.png" alt="File">
                            </span>
                            <div class="mailbox-attachment-info">
                                <a href="https://cdn-icons-png.flaticon.com/512/124/124837.png" target="_blank" class="mailbox-attachment-name">
                                    <i class="fa fa-camera"></i> Download File
                                </a>
                                <span class="mailbox-attachment-size">
                                    Document
                                    <a href="{{ url('Helpdesk/download') }}/${data.doc}" download class="btn btn-default btn-xs pull-right">
                                        <i class="fa fa-cloud-download"></i>
                                    </a>
                                </span>
                            </div>
                        </li>
                    </ul>`;
                $("#attachment-container").html(attachmentHtml);
            } else {
                $("#attachment-container").html("");
            }

            } else {
                console.warn("No data found");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching helpdesk data:", error);
        }
    });
}
    detail_helpdesk();

  });

  $jq(document).on('click', '#btn_reply', function() {
    $("#reply_message").show();
    $("#btn_reply").hide();
  });

  $jq(document).on('click', '#btn-reply', function() {

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

    const urlSegments = window.location.pathname.split("/");
    const id = urlSegments[urlSegments.length - 1];
    const caption = $('#compose-textarea').val();

    if (!caption) return showAlert("Please fill input field for Message");

    Swal.fire({
      title: 'Saving Data...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    $.ajax({
      url: "{{ url('Helpdesk/reply_helpdesk') }}",
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      data: {id: id, caption: caption},
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

function showAlert(message) {
Swal.fire({
    title: "Warning",
    text: message,
    icon: 'warning',
    confirmButtonText: 'Close'
});
}
</script>

