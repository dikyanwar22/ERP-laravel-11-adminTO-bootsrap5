<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\admin\Berita AS M_berita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Berita extends Controller
{

  public function __construct() {
    $this->model = new M_berita();

    //jika tidak ada session login maka otomatis logout
    // $this->middleware(function ($request, $next) {
    //   if (!Auth::check()) {
    //     return redirect()
    //     ->route('login')
    //     ->withErrors([
    //       'email' => 'Please login to access this system',
    //     ])
    //     ->onlyInput('email');
    //   }
    //   return $next($request);
    // });

  }

  /**
  * Display a listing of the resource.
  */
  public function index(Request $request): View
  {
    $start = $request->input('awal');
    $end = $request->input('akhir');
    if ($start && $end) {
        $data['qu'] = M_berita::where('deleted', '0')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('id', 'DESC')
            ->get();
    } else {
        $data['qu'] = [];
        $start = date('Y-m-01');
        $end = date('Y-m-t');
    }
    $data['title'] = 'Berita';
    $data['awal'] = $start;
    $data['akhir'] = $end;
    return view('admin.berita.index', $data);
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create(): View
  {
    $data['title'] = 'Tambah Berita';
    return view('admin.berita.add', $data);
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request): RedirectResponse
  {
    $this->validate($request, [
      'judul' => 'required|min:5',
      'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'isi' => 'required',
    ]);

    $uploadImage = $request->file('gambar');
    $imageNameWithExt = $uploadImage->getClientOriginalName();
    $imageName = $request->file(date('ymdHis'));
    $imageExt = $uploadImage->getClientOriginalExtension();
    $storeImage = $imageName . time() . "." . $imageExt;
    $uploadImage->move(public_path('file/berita'), $storeImage);

    M_berita::create([
      'judul' => $request->judul,
      'gambar' => $storeImage,
      'isi' => $request->isi,
      'penulis' => $request->penulis,
      'deleted' => '0',
      'penulis' => auth()->user()->email,
      'created_by' => auth()->user()->id,
      'created_at' => date('Y-m-d H:i:s'),
    ]);
    session()->flash('msg',
    '<div class="box-body">
    <div class="alert alert-dismissible" style="background-color: green; color: white;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Selamat</h4>
    Tambah Data Berhasil
    </div>
    </div>'
  );
  return redirect()->back();
}

/**
* Display the specified resource.
*/
public function show(string $id)
{
  //
}

/**
* Show the form for editing the specified resource.
*/
public function edit(string $params_id): View
{
  $decode_id = urldecode($params_id);
  $id = base64_decode($decode_id);

  $data['title'] = 'Ubah Berita';
  $data['e'] = M_berita::findOrfail($id);
  return view('admin.berita.edit', $data);
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, string $id): RedirectResponse
{
  $this->validate($request, [
    'judul' => 'required|min:5',
    // 'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'isi' => 'required',
  ]);

  $update = M_berita::findOrFail($id);

  if ($request->hasFile('gambar')) {
    $uploadImage = $request->file('gambar');
    $imageNameWithExt = $uploadImage->getClientOriginalName();
    $imageName = $request->file(date('ymdHis'));
    $imageExt = $uploadImage->getClientOriginalExtension();
    $storeImage = $imageName . time() . "." . $imageExt;
    $uploadImage->move(public_path('file/berita'), $storeImage);

    if ($request->gambar_lama) {
      unlink(public_path('file/berita/' . $request->gambar_lama));
    }

    $update->update([
      'judul' => $request->judul,
      'gambar' => $storeImage,
      'isi' => $request->isi,
      'penulis' => auth()->user()->email,
      'updated_by' => auth()->user()->id,
      'updated_at' => date('Y-m-d H:i:s'),
    ]);
  } else {
    $update->update([
      'judul' => $request->judul,
      'isi' => $request->isi,
      'penulis' => auth()->user()->email,
      'updated_by' => auth()->user()->id,
      'updated_at' => now(),
    ]);
  }

  session()->flash('msg',
  '<div class="box-body">
  <div class="alert alert-dismissible" style="background-color: green; color: white;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>Selamat</h4>
  Update Data Berhasil
  </div>
  </div>'
);
return redirect()->back();
}

/**
* Remove the specified resource from storage.
*/
public function destroy(string $id): RedirectResponse
{
  $delete = M_berita::findOrFail($id);
  $delete->update([
    'deleted' => '1'
  ]);
  session()->flash('msg',
  '<div class="box-body">
  <div class="alert alert-dismissible" style="background-color: green; color: white;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>Selamat</h4>
  Hapus Data Berhasil
  </div>
  </div>'
);
return redirect()->back();
}
}
