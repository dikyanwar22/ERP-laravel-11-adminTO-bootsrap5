<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Documentation\M_erp as Model_ERP;
class Documentation extends Controller {
    
    public function __construct() {
        $this->model = new Model_ERP();    
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

    public function index() {
        $data['title'] = 'Dokumentasi Modul ERP';
        $data['modul'] = $this->model->getModul();
        return view('modul_documentation.index', $data);
    }

    public function fetchModul(Request $request) {
        $id = $request->post('id');

        $data = DB::table('doc_modul AS a')
                    ->join('modul AS b', 'a.modul_id', '=', 'b.id')
                    ->select('a.id', 'a.deskripsi', 'b.id AS modul_id', 'b.nama AS modul')
                    ->where('a.id', $id)
                    ->first();

        $modul = DB::table('modul')->where('deleted', '0')->orderBy('nama')->get();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mendapatkan data',
                'modul' => $modul,
                'data' => $data
            ]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function updateModul(Request $request) {
        $id = $request->post('id');
        $data = [
            'modul_id' => $request->post('modul_id'),
            'deskripsi' => $request->post('deskripsi'),
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        $update = $this->model->db_updateModul($data, $id);

        if ($update) {
            session()->flash('msg', '<div class="alert alert-success">Ubah Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Ubah Data Gagal</div>');
        }

        return redirect()->back();
    }

    public function getModul() {
        $data = DB::table('modul')->where('deleted', '0')->orderBy('nama')->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $data
        ]);
    }

    public function insertModul(Request $request) {
        $data = [
            'modul_id' => $request->post('modul'),
            'deskripsi' => $request->post('deskripsi'),
            'created_by' => auth()->id(),
            'created_at' => now(),
        ];

        $insert = $this->model->insertDBModul($data);

        if ($insert) {
            session()->flash('msg', '<div class="alert alert-success">Simpan Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Simpan Data Gagal</div>');
        }

        return redirect()->back();
    }

    public function deleteModul($id) {
        $data = ['deleted' => '1'];
        $delete = $this->model->db_updateModul($data, $id);

        if ($delete) {
            session()->flash('msg', '<div class="alert alert-success">Hapus Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Hapus Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Display Menu
    public function menu($params_id) {
        $decode_id = urldecode($params_id);
        $id = base64_decode($decode_id);

        $data['title'] = 'Dokumentasi Menu ERP';
        $data['menu'] = $this->model->getMenu($id);
        $data['breadcrumb'] = $this->model->getBreadcrumbModul($id);
        return view('modul_documentation.menu', $data);
    }

    // Fetch Menu using POST request
    public function fetchMenu(Request $request) {
        $id = $request->input('id');

        $data = DB::table('doc_menu AS a')
            ->join('menu AS b', 'a.menu_id', '=', 'b.id')
            ->select('a.id', 'a.deskripsi', 'b.id AS menu_id', 'b.nama AS menu', 'b.modul_id')
            ->where('a.id', $id)
            ->first();

        $menu = DB::table('menu')
            ->where('deleted', '0')
            ->where('modul_id', $data->modul_id)
            ->orderBy('nama', 'ASC')
            ->get();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mendapatkan data',
                'menu' => $menu,
                'data' => $data
            ]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }
    }

    // Update Menu
    public function updateMenu(Request $request) {
        $id = $request->input('id');
        $data = [
            'menu_id' => $request->input('menu_id'),
            'deskripsi' => $request->input('deskripsi'),
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        $result = $this->model->db_updateMenu($data, $id);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Ubah Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Ubah Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Get Menu by modul_id
    public function getMenu(Request $request) {
        $modul_id = $request->query('modul_id');

        $data = DB::table('menu')
            ->select('id', 'nama')
            ->where('deleted', '0')
            ->where('modul_id', $modul_id)
            ->orderBy('nama', 'ASC')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $data
        ]);
    }

    // Insert New Menu
    public function insertMenu(Request $request) {
        $data = [
            'menu_id' => $request->input('menu'),
            'deskripsi' => $request->input('deskripsi'),
            'created_by' => auth()->id(),
            'created_at' => now(),
        ];

        $result = $this->model->insertDBMenu($data);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Simpan Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Simpan Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Delete Menu
    public function deleteMenu($id) {
        $data = array('deleted' => '1');
        $result = $this->model->db_updateMenu($data, $id);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Hapus Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Hapus Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Display SubMenu
    public function submenu($params_id) {
        $decode_id = urldecode($params_id);
        $id = base64_decode($decode_id);

        $data['title'] = 'Dokumentasi Sub Menu ERP';
        $data['submenu'] = $this->model->getSubMenu($id);
        $data['breadcrumb'] = $this->model->getBreadcrumbMenu($id);
        
        return view('modul_documentation.submenu', $data);
    }

    // Fetch SubMenu using POST request
    public function fetchSubMenu(Request $request) {
        $id = $request->input('id');

        $data = DB::table('doc_submenu AS a')
            ->join('sub_menu AS b', 'a.submenu_id', '=', 'b.id')
            ->select('a.id', 'a.deskripsi', 'b.id AS submenu_id', 'b.nama AS submenu', 'b.menu_id')
            ->where('a.id', $id)
            ->first();

        $submenu = DB::table('sub_menu')
            ->where('deleted', '0')
            ->where('menu_id', $data->menu_id)
            ->orderBy('nama', 'ASC')
            ->get();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mendapatkan data',
                'submenu' => $submenu,
                'data' => $data
            ]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }
    }

    // Update SubMenu
    public function updateSubMenu(Request $request) {
        $id = $request->input('id');
        $data = [
            'submenu_id' => $request->input('submenu_id'),
            'deskripsi' => $request->input('deskripsi'),
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        $result = $this->model->db_updateSubMenu($data, $id);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Ubah Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Ubah Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Get SubMenu by menu_id
    public function getSubMenu(Request $request) {
        $menu_id = $request->query('menu_id');

        $data = DB::table('sub_menu')
            ->select('id', 'nama')
            ->where('deleted', '0')
            ->where('menu_id', $menu_id)
            ->orderBy('nama', 'ASC')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $data
        ]);
    }

    // Insert New SubMenu
    public function insertSubMenu(Request $request) {
        $data = [
            'submenu_id' => $request->input('submenu'),
            'deskripsi' => $request->input('deskripsi'),
            'created_by' => auth()->id(),
            'created_at' => now(),
        ];

        $result = $this->model->insertDBSubMenu($data);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Simpan Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Simpan Data Gagal</div>');
        }

        return redirect()->back();
    }

    // Delete SubMenu
    public function deleteSubMenu($id) {
        $data = array('deleted' => '1');
        $result = $this->model->db_updateSubMenu($data, $id);

        if ($result) {
            session()->flash('msg', '<div class="alert alert-success">Hapus Data Berhasil</div>');
        } else {
            session()->flash('msg', '<div class="alert alert-danger">Hapus Data Gagal</div>');
        }

        return redirect()->back();
    }

}
