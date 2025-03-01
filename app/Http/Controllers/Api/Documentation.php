<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Documentation\M_api as Model_Api;

class Documentation extends Controller {

  public function __construct() {
    $this->model = new Model_Api();

    //jika tidak ada session login maka otomatis logout
    $this->middleware(function ($request, $next) {
      if (!Auth::check()) {
        return redirect()
        ->route('login')
        ->withErrors([
          'email' => 'Please login to access this system',
        ])
        ->onlyInput('email');
      }
      return $next($request);
    });
  }

  public function index(Request $request) {
    $data['title'] = 'Dokumentasi API';
    $data['api_data'] = $this->model->view_api();
    return view('api_documentation.index', $data);
  }

  public function editModal($id) {
    $record = Model_Api::findOrFail($id);
    echo json_encode($record);
  }

  public function api_add(Request $request) {
    $data = array(
      'nama' => $request->nama,
      'deleted' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'created_by' => auth()->id(),
    );
    $ex = $this->model->insert_api($data);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Simpan Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Simpan Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function api_edit(Request $request) {
    $id = $request->id;
    $data = array(
      'nama' => $request->nama,
      'deleted' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'created_by' => auth()->id(),
    );
    $ex = $this->model->edit_api($data, $id);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Update Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Update Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function deleted_api($id) {
    $data = array(
      'deleted' => '1',
    );
    $ex = $this->model->edit_api($data, $id);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Hapus Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Hapus Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function list_api($params_id) {
    $decode_id = urldecode($params_id);
    $id = base64_decode($decode_id);

    $data['title'] = 'Daftar API';
    $data['name_api'] = $this->model->db_api($id);
    $data['list_api'] = $this->model->list_api($id);
    return view('api_documentation.list_api', $data);
  }

  public function add_list_api($params_id) {
    $decode_id = urldecode($params_id);
    $id = base64_decode($decode_id);

    $data['title'] = 'Tambah API';
    $data['v'] = $this->model->db_api($id);
    return view('api_documentation.list_api_add',$data);
  }

  public function edit_list_api($var_id, $params_id) {
    $dec = urldecode($var_id);
    $id_var = base64_decode($dec);

    $decode_id = urldecode($params_id);
    $id = base64_decode($decode_id);

    $data['title'] = 'Edit API';
    $data['v'] = $this->model->db_api($id);
    $data['edit'] = $this->model->db_view($id_var);
    return view('api_documentation/list_api_edit',$data);
  }

  public function action_add_list_api(Request $request) {
    $method = $request->method;
    $struktural = ($method == 'GET' || $method == 'DELETE') ? 'Params' : $request->struktural;

    $data = array(
      'api_id' => $request->api_id,
      'nama' => $request->nama,
      'ket_nama' => $request->ket_nama,
      'method' => $method,
      'url' => $request->url,
      'struktural' => $struktural,
      'permintaan' => $request->permintaan,
      'inputan' => $request->inputan,
      'hasil' => $request->hasil,
      'deleted' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'created_by' => auth()->id(),
    );
    $ex = $this->model->db_add_api($data);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Simpan Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Simpan Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function action_edit_list_api($id, Request $request) {
    $method = $request->method;
    $data = array(
      'nama' => $request->nama,
      'ket_nama' => $request->ket_nama,
      'method' => $method,
      'url' => $request->url,
      'struktural' => ($method == 'GET' || $method == 'DELETE') ? 'Params' : $request->struktural,
      'permintaan' => ($method == 'GET' || $method == 'DELETE') ? null : $request->permintaan,
      'inputan' => ($method == 'GET' || $method == 'DELETE') ? null : $request->inputan,
      'hasil' => $request->hasil,
      'updated_at' => date('Y-m-d H:i:s'),
      'updated_by' => auth()->id(),
    );
    $ex = $this->model->db_edit_api($data, $id);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Update Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Update Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function deleted_list_api($id) {
    $data = array(
      'deleted' => '1',
    );
    $ex = $this->model->edit_list_api($data, $id);
    if ($ex) {
      session()->flash('msg', '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Hapus Data Berhasil</h4>
      </div>');
    } else {
      session()->flash('msg', '<div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Hapus Data Gagal</h4>
      </div>');
    }
    return redirect()->back();
  }

  public function result($params_id) {
    $decode_id = urldecode($params_id);
    $id_var = base64_decode($decode_id);

    $data['title'] = 'Result API';
    $data['v'] = $this->model->db_view($id_var);
    return view('api_documentation.result_api',$data);
  }

}
