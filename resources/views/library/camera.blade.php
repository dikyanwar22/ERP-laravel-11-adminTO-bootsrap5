<style>
  #canvas {
    width: 100%;
    height: 100%;
    border: 1px solid #000; /* Opsional, hanya untuk memberikan border */
    box-sizing: border-box; /* Agar padding dan border dihitung dalam lebar/tinggi */
  }
</style>

<section class="content">
<!-- Notifikasi -->

  <!-- Notifikasi -->

  <div class="box box-solid">
    <div class="box-header with-border">
      <i class="fa fa-list-alt"></i>
      <h3 class="box-title">Tambah Data</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div>
          <form action="" method="post" enctype="multipart/form-data">
          <div class="widget-content">
                <div class="form-group">

                  <div class="col-lg-4 col-md-12">
                    <div class="control-group">

                    <select id="camera-select" class="form-control">
                        <option value="">-Pilih Kamera-</option>
                        <option value="user">Kamera depan</option>
                        <option value="environment">Kamera belakang</option>
                    </select>

                    <video id="video" autoplay width="100%" height="100%"></video>
                    <button id="capture" class="btn btn-danger"><i class="fa fa-camera"></i> Ambil Gambar</button>
                    <a href="" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>

                    </div>
                  </div>

                    <div style="height: 100px;"></div>

                  <div class="col-lg-4 col-md-12">
                    <div class="control-group">
                    <label>Foto Rumah Customer</label>
                    <input type="hidden" id="photo" name="photo" required>
                    <canvas id="canvas"></canvas>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-12">
                    <div class="control-group">
                      <label>Nama Customer</label>
                      <input type="text" name="nama" placeholder="ex: Diky Anwar" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                    <div class="control-group">
                      <label>HP</label>
                      <input type="text" name="hp" placeholder="ex: 089xxx" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="control-group">
                      <label>Alamat</label>
                      <textarea name="alamat" class="form-control" placeholder="ex: Jl. Kebon Nanas No. 01 Ds Sukamaju Kec. Selalu Rame" required></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6" hidden>
                    <div class="control-group">
                      <label>Latitude</label>
                      <input type="text" id="latitude" name="latitude" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6" hidden>
                    <div class="control-group">
                      <label>Longitude</label>
                      <input type="text" id="longitude" name="longitude" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" name="submit" class="btn btn-primary submit" value="Submit" style="width: 100%;margin-top: 5px;"><i class="fa fa-plus"></i> Tambahkan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="activator"></div>
</section>

 <script>
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const captureButton = document.getElementById('capture');
  const context = canvas.getContext('2d');
  const photoInput = document.getElementById('photo');
  const cameraSelect = document.getElementById('camera-select');

  // Mendapatkan akses kamera sesuai pilihan pengguna
  function getCameraStream() {
    const facingMode = cameraSelect.value;
    navigator.mediaDevices.getUserMedia({
        video: {
          facingMode: { exact: facingMode }
        }
      })
      .then((stream) => {
        video.srcObject = stream;
      })
      .catch((err) => {
        console.error('Error accessing camera: ', err);
      });
  }

  // Memanggil fungsi saat halaman dimuat
  document.addEventListener('DOMContentLoaded', getCameraStream);

  // Memperbarui akses kamera saat pilihan kamera berubah
  cameraSelect.addEventListener('change', getCameraStream);

  // Mengambil gambar dari kamera
  captureButton.addEventListener('click', () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Konversi gambar pada canvas ke data URL dan simpan di input tersembunyi
    const dataUrl = canvas.toDataURL('image/png');
    photoInput.value = dataUrl;

    // Menampilkan hasil tangkapan (opsional)
    canvas.style.display = 'block';
  });
</script>

<script src="{{ asset('assets/js/google-maps-jquery.min.js') }}"></script>
<script type="text/javascript">

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition, showError);
} else {
  alert("Geolocation is not supported by this browser.");
}

function showPosition(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;

  document.getElementById('latitude').value = latitude;
  document.getElementById('longitude').value = longitude;
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alert("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      alert("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      alert("An unknown error occurred.");
      break;
  }
}

</script>