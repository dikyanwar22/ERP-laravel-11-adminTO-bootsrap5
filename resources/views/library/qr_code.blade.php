<!-- modal QR Code -->
<div class="modal fade" id="modal-qr" tabindex="-1" role="dialog" aria-labelledby="modal-qr-code">
<div class="modal-dialog modal-md" role="document">
    
    <div class="modal-content">
  <div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><i class="fa fa-qrcode"></i> Scan Here</h4>
  </div>
  <div class="modal-body">

 <div id="qr-reader" style="width:360px important; border: 1px solid #cacaca; "></div>
 <div id="qr-reader-results"></div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close <i class="fa fa-close"></i></button>
  </div>
</div>

    </div>
</div>
<!-- modal QR Code -->


<!-- Custom QR Code By Dicky --> 
<script src="{{asset('assets/js/qr_code/html5-qrcode.min.js')}}"></script>
<script type="text/javascript">
var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
  fps: 10,
  qrbox: 250
});

$(".btn_close_modal").click(function() {
  customQRCodeByDicky();
});

function docReady(fn) {
  if (document.readyState === "complete" || document.readyState === "interactive") {
    setTimeout(fn, 1);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

customQRCodeByDicky = function() {
  html5QrcodeScanner.clear();
  closeModal('scanQRModal');
}
</script>
<!-- Custom QR Code By Dicky -->