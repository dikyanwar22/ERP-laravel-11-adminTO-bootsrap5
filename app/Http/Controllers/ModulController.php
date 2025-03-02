<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ModulController extends Controller {

    public function __construct() {
        $this->model = new Modul();

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

    public function modul() {
        if(Auth::check()) {
            $data['title'] = 'Data Modul';
            $data['data'] = $this->model->getModul();

            foreach($data['data'] as $value) {
                $string = "$value->level_id";
                $level = explode(",", $string);
            //perulangan didalam perulangan
                $array = array();
                for($i = 0; $i < count($level); $i++) {
                    $db = DB::table('level')
                    ->select('nama')
                    ->where('deleted', '0')
                    ->where('id', $level[$i])
                    ->orderBy('nama', 'ASC')
                    ->first();
                    $array[] = $db->nama;
                }
                $data['akses'][$value->id] = $array;
            //perulangan didalam perulangan
            }
            return view('modul.modul.modul', $data);
        }

    }

    public function modul_add() {
        if(Auth::check()) {
            $data['title'] = 'Tambah Modul';
            $data['level'] = $this->model->level();
            return view('modul.modul.add', $data);
        }
    }

    public function modul_edit($params_id) {
        $decode_id = urldecode($params_id);
        $id = base64_decode($decode_id);

        if(Auth::check()) {
            $data['title'] = 'Edit Modul';
            $data['level'] = $this->model->level();
            $data['e'] = $this->model->db_modul_row($id);
            return view('modul.modul.edit', $data);
        }
    }

    public function modul_add_action(Request $request): RedirectResponse {
        $level_id = $request->hak_akses;
        $hak_akses = implode(',', $level_id);

        $modul = $request->modul;
        $folder = preg_replace("/\s+/", "_", $modul);

        $data = [
            'nama' => $modul,
            'uri' => $folder,
            'icon' => $request->icon,
            'level_id' => $hak_akses,
            'deleted' => '0',
            'created_by' => Auth::user()->id,
            'created_username' => Auth::user()->email,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $db = DB::table('modul')->insert($data);
        if($db) {
            return redirect()->route('modul')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('modul')->with(['danger' => 'Data Gagal Disimpan!']);
        }
    }

    public function modul_update($id, Request $request) : RedirectResponse {
       $level_id = $request->hak_akses;
       $hak_akses = implode(',', $level_id);

       $modul = $request->modul;
       $folder = preg_replace("/\s+/", "_", $modul);
       $data = [
        'nama' => $modul,
        'uri' => $folder,
        'icon' => $request->icon,
        'level_id' => $hak_akses,
        'deleted' => $request->deleted,
        'updated_by' => Auth::user()->id,
        'updated_username' => Auth::user()->email,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $db = DB::table('modul')->where('id',$id)->update($data);
    if($db) {
        return redirect()->route('modul')->with(['success' => 'Data Berhasil Diupdate!']);
    } else {
        return redirect()->route('modul')->with(['danger' => 'Data Gagal Diupdate!']);
    }
}

public function menu() {
    if(Auth::check()) {
        $data['title'] = 'Data Menu';
        $data['menu'] = $this->model->db_menu();

    //nested looping
        foreach($data['menu'] as $key => $value) {
            $string = "$value->level_id";
            $level = explode(",", $string);

            $array = array();
            for($i = 0; $i < count($level); $i++) {
                $db = DB::table('level')
                ->select('nama')
                ->where('deleted', '0')
                ->where('id', $level[$i])
                ->orderBy('nama', 'ASC')
                ->first();
                $array[] = $db->nama;
            }
            $data['akses'][$value->id] = $array;
        }
    //nested looping

    //row in looping
        foreach ($data['menu'] as $key => $v) {
            $nilai = DB::table('modul')
            ->select('*')
            ->where('id', $v->modul_id)
            ->orderBy('nama', 'ASC')
            ->limit(1)
            ->first();
            $data['menu'][$key]->modul_nama = $nilai ? $nilai->nama : '';
        }
    //row in looping
        return view('modul.menu.menu',$data);
    }
}

public function menu_add() {
    if(Auth::check()) {
        $data['title'] = 'Tambah Menu';
        $data['modul'] = $this->model->db_modul();
        $data['level'] = $this->model->level();
        return view('modul.menu.add', $data);
    }
}

public function menu_add_action(Request $request) : RedirectResponse {
    $level_id = $request->hak_akses;
    $hak_akses = implode(',', $level_id);

    $menu = $request->menu;
    $file = preg_replace("/\s+/", "_", $menu);
    $data = [
        'modul_id' => $request->modul_id,
        'nama' => $menu,
        'uri' => $file,
        'icon' => $request->icon,
        'tipe' => $request->tipe,
        'level_id' => $hak_akses,
        'created_by' => Auth::user()->id,
        'created_username' => Auth::user()->email,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $db = DB::table('menu')->insert($data);
    if($db) {
        return redirect()->route('menu')->with(['success' => 'Data Berhasil Disimpan!']);
    } else {
        return redirect()->route('menu')->with(['danger' => 'Data Gagal Disimpan!']);
    }
}

public function menu_edit($params_id) {
    if(Auth::check()) {
        $decode_id = urldecode($params_id);
        $id = base64_decode($decode_id);

        $data['title'] = 'Ubah Menu';
        $data['modul'] = $this->model->db_modul();
        $data['level'] = $this->model->level();
        $data['e'] = $this->model->view_menu($id);
        return view('modul.menu.edit', $data);
    }
}

public function menu_update($id, Request $request) : RedirectResponse {
    $level_id = $request->hak_akses;
    $hak_akses = implode(',', $level_id);

    $menu = $request->menu;
    $file = preg_replace("/\s+/", "_", $menu);
    $data = [
        'modul_id' => $request->modul_id,
        'nama' => $menu,
        'uri' => $file,
        'icon' => $request->icon,
        'tipe' => $request->tipe,
        'level_id' => $hak_akses,
        'deleted' => $request->deleted,
        'updated_by' => Auth::user()->id,
        'updated_username' => Auth::user()->email,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $db = DB::table('menu')->where('id',$id)->update($data);
    if($db) {
        return redirect()->route('menu')->with(['success' => 'Data Berhasil Diupdate!']);
    } else {
        return redirect()->route('menu')->with(['danger' => 'Data Gagal Diupdate!']);
    }
}

public function submenu() {
    if(Auth::check()) {
        $data['title'] = 'Sub Menu';
        $data['sub'] = $this->model->db_submenu();

        foreach($data['sub'] as $key => $v) {
          $string = "$v->level_id";
          $level = explode(",", $string);
          $array = array();
          for($i=0; $i < count($level); $i++) {
            $db = DB::table('level')
            ->select('nama')
            ->where('deleted', '0')
            ->where('id', $level[$i])
            ->orderBy('nama', 'ASC')
            ->first();
            $array[] = $db->nama;
        }
        $data['akses'][$v->id] = $array;
    }
        return view('modul.sub_menu.sub_menu',$data);
    }
}

public function submenu_add() {
    if(Auth::check()) {
        $data['title'] = 'Tambah Sub Menu';
        $data['menu'] = $this->model->menu_modul();
        $data['level'] = $this->model->level();
        return view('modul.sub_menu.add', $data);
    }
}

public function submenu_edit($params_id) {

    if(Auth::check()) {
        $decode_id = urldecode($params_id);
        $id = base64_decode($decode_id);

        $data['title'] = 'Edit Sub Menu';
        $data['menu'] = $this->model->menu_modul();
        $data['level'] = $this->model->level();
        $data['e'] = $this->model->db_submenu_row($id);
        return view('modul.sub_menu.edit', $data);
    }
}

public function submenu_add_action(Request $request) : RedirectResponse {
    $level_id = $request->hak_akses;
    $hak_akses = implode(',', $level_id);

    $sub_menu = $request->sub_menu;
    $file = preg_replace("/\s+/", "_", $sub_menu);
    $data = array(
        'menu_id' => $request->menu_id,
        'nama' => $sub_menu,
        'uri' => $file,
        'icon' => $request->icon,
        'level_id' => $hak_akses,
        'created_by' => Auth::user()->id,
        'created_username' => Auth::user()->email,
        'created_at' => date('Y-m-d H:i:s')
    );
    $db = DB::table('sub_menu')->insert($data);
    if($db) {
        return redirect()->route('sub_menu')->with(['success' => 'Data Berhasil Disimpan!']);
    } else {
        return redirect()->route('sub_menu')->with(['danger' => 'Data Gagal Disimpan!']);
    }
}

public function submenu_update($id, Request $request) : RedirectResponse {
    $level_id = $request->hak_akses;
    $hak_akses = implode(',', $level_id);

    $sub_menu = $request->sub_menu;
    $file = preg_replace("/\s+/", "_", $sub_menu);
    $data = array(
        'menu_id' => $request->menu_id,
        'nama' => $sub_menu,
        'uri' => $file,
        'icon' => $request->icon,
        'level_id' => $hak_akses,
        'deleted' => $request->deleted,
        'updated_by' => Auth::user()->id,
        'updated_username' => Auth::user()->email,
        'updated_at' => date('Y-m-d H:i:s')
    );
    $db = DB::table('sub_menu')->where('id',$id)->update($data);
    if($db) {
        return redirect()->route('sub_menu')->with(['success' => 'Data Berhasil Diupdate!']);
    } else {
        return redirect()->route('sub_menu')->with(['danger' => 'Data Gagal Diupdate!']);
    }
}

public function tampil_modul() {
    $level_akses = Auth::user()->level_id;

    $menus = DB::table('menu')
        ->leftJoin('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
        ->leftJoin('modul', 'menu.modul_id', '=', 'modul.id')
        ->select(
            'modul.id as modul_id', 'modul.nama as modul_nama', 'modul.icon AS modul_icon',
            'menu.id as menu_id', 'menu.nama as menu_nama', 'menu.icon AS menu_icon', 'menu.tipe',
            'sub_menu.id as sub_menu_id', 'sub_menu.icon AS sub_menu_icon', 'sub_menu.nama as sub_menu_nama'
        )
        ->whereRaw('FIND_IN_SET(?, modul.level_id) > 0', [$level_akses])
        ->orWhereRaw('FIND_IN_SET(?, menu.level_id) > 0', [$level_akses])
        ->orWhereRaw('FIND_IN_SET(?, sub_menu.level_id) > 0', [$level_akses])
        ->orderBy('modul.id', 'asc')
        ->orderBy('menu.sequence', 'asc')
        ->orderBy('sub_menu.sequence', 'asc')
        ->get();

    $data = [];

    foreach ($menus as $menu) {
        if (!isset($data[$menu->modul_id])) {
            $data[$menu->modul_id] = [
                'modul_id' => $menu->modul_id,
                'modul' => $menu->modul_nama,
                'modul_icon' => $menu->modul_icon,
                'menus' => []
            ];
        }

        if (!isset($data[$menu->modul_id]['menus'][$menu->menu_id])) {
            $data[$menu->modul_id]['menus'][$menu->menu_id] = [
                'menu_id' => $menu->menu_id,
                'menu' => $menu->menu_nama,
                'menu_icon' => $menu->menu_icon,
                'tipe' => $menu->tipe,
                'sub_menus' => []
            ];
        }

        if ($menu->tipe === 'dropdown' && $menu->sub_menu_id) {
            $data[$menu->modul_id]['menus'][$menu->menu_id]['sub_menus'][] = [
                'sub_menu_id' => $menu->sub_menu_id,
                'sub_menu' => $menu->sub_menu_nama,
                'sub_menu_icon' => $menu->sub_menu_icon
            ];
        }
    }

    foreach ($data as &$modul) {
        $modul['menus'] = array_values($modul['menus']);
    }
    return response()->json(array_values($data));
}

public function tampil_modul_old() {
    $level_akses = Auth::user()->level_id;
    $db = DB::table('modul')
    ->select('id', 'nama AS modul', 'icon', 'uri')
    ->where('deleted', '0')
    ->whereRaw('FIND_IN_SET(?, level_id) > 0', [$level_akses])
    ->orderBy('sequence', 'ASC')
    ->get();
    echo json_encode($db);
}

public function modul_sub_menu(Request $request) {
    $level_akses = Auth::user()->level_id;
    $menu_id = [$request->menu_id];

    $db = DB::table('sub_menu AS a')
    ->select('a.id', 'a.menu_id', 'a.nama AS sub_menu', 'a.icon AS icon_sub', 'c.uri AS folder', 'b.uri AS class', 'a.uri AS function')
    ->join('menu AS b', 'a.menu_id', '=', 'b.id')
    ->join('modul AS c', 'b.modul_id', '=', 'c.id')
    ->whereIn('a.menu_id', $menu_id)
    ->where('a.deleted','0')
    ->where('b.deleted', '0')
    ->where('c.deleted', '0')
    ->whereRaw('FIND_IN_SET(?, b.level_id) > 0', [$level_akses])
    // ->groupBy('a.id')
    ->orderBy('b.sequence', 'ASC')
    ->get();

    $array = array();
    foreach($db as $key => $row) {

    $count_notif = '';
    switch ($row->id) {
      case '19':
        $count_notif = '17';
        break;
      case '16':
        $count_notif = '21';
        break;
      case '18':
        $count_notif = '15';
        break;
    }

    $array[] = array(
      'id' => $row->id,
      'menu_id' => $row->menu_id,
      'sub_menu' => $row->sub_menu,
      'folder' => $row->folder,
      'class' => $row->class,
      'function' => $row->function,
      'total' => $count_notif,
      'icon_sub' => $row->icon_sub,
      'uri_sub' => $row->function,
    );
  }
  echo json_encode($array);
}

public function all_menu(Request $request) {
  $level_akses = Auth::user()->level_id;
  $url_modul = $request->nama_modul;

  $db_modul = DB::table('modul')
  ->select('id', 'uri')
  ->where('uri', $url_modul)
  ->limit(1)
  ->first();
  $modul_id = $db_modul->id;

  //menu tunggal
  $menu = DB::table('menu AS a')
  ->select('a.id', 'a.modul_id', 'a.icon', 'a.nama AS menu', 'a.uri AS class', 'a.tipe', 'b.uri AS folder')
  ->join('modul AS b','a.modul_id', '=', 'b.id')
  ->where('a.modul_id', $modul_id)
  ->where('a.deleted','0')
//   ->where('a.tipe','menu')
  ->whereRaw('FIND_IN_SET(?, a.level_id) > 0', [$level_akses])
  ->orderBy('a.sequence','ASC')
  ->get();
  //menu tunggal

  //sub menu
  $dropdown = DB::table('menu')
  ->select('id', 'modul_id', 'icon', 'nama AS menu', 'uri AS class')
  ->where('modul_id', $modul_id)
  ->where('deleted','0')
  ->where('tipe','dropdown')
  ->whereRaw('FIND_IN_SET(?, level_id) > 0', [$level_akses])
  ->orderBy('sequence','ASC')
  ->get();
  //sub menu

  $array = array();
  foreach($menu as $ket => $menu_tunggal) {
    $array['menu_tunggal'][] = $menu_tunggal;
  }
//   foreach($dropdown as $key => $sub) {
//     $array['sub_menu'][] = $sub;
//   }
  echo json_encode($array);
}


}
