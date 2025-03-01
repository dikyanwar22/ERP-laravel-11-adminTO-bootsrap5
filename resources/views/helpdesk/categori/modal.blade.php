<div class="modal-content">
  <div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><i class="fa fa-info-circle"></i> Modal</h4>
  </div>
  <div class="modal-body">

  <div class="box-body" hidden>
        <div class="form-group">
            <label>ID</label>
            <input type="text" class="form-control" id="category_id">
         </div>
 </div>

 <div class="box-body">
        <div class="form-group">
            <label>Category</label>
            <input type="text" class="form-control" id="edit_category">
         </div>
 </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close <i class="fa fa-close"></i></button>
    <button id="btn-simpan" type="button" class="btn btn-primary">Update <i class="fa fa-save"></i></button>
  </div>
</div>

<script type="text/javascript">
function showDetail(id) {
    $.ajax({
    url: "{{ url('Helpdesk/det_cat') }}",
    method: 'POST',
    data: {id: id},
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    success: function(response) {
        
        if (response.status) {
                $("#category_id").val(id);
                $('#edit_category').val(response.data.name);
            } else {
                $('#edit_category').val('');
                Toast.fire({
                    icon: 'error',
                    title: 'Data kategori tidak ditemukan.'
                });
        }

    },
    error: function(xhr, status, error) {
      Toast.fire({
        icon: "error",
        title: JSON.parse(xhr.responseText).error
      });
    }
  });
}

$("#btn-simpan").on("click", function() {
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

        const id = $("#category_id").val();
        const category = $("#edit_category").val();

        if (!category) {
            return showAlert("Please fill input field for Category");
        }

        Swal.fire({
            title: 'Saving Data...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: "{{ url('Helpdesk/update_category') }}",
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: { id: id, category: category },
            success: function(response) {
                Swal.close();
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'Close'
                }).then(() => {
                    $('#tabel_main').DataTable().ajax.reload();
                    $('#myModal').modal('hide');
                    // window.location.reload();
                });
            },
            error: function(xhr) {
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
</script>