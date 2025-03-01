<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\admin\Info AS M_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Info extends Controller
{

  public function __construct() {
    $this->model = new M_info();
  }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
      $id = '1';
      $data['title'] = 'Informasi Perumahan';
      $data['info'] = M_info::findOrFail($id);
      return view('admin.info.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $this->validate($request, [
        // 'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_perumahan' => 'required|min:2',
        'ket_perumahan' => 'required|min:2',
        'alamat' => 'required|min:2',
        'telp' => 'required|min:2',
        'email' => 'required|min:2',
        'link_fb' => 'required|min:2',
        'link_ig' => 'required|min:2',
        'link_wa' => 'required|min:2',
        'url_maps' => 'required|min:2',
      ]);

      $update = M_info::findOrFail($id);

      if ($request->hasFile('logo_perumahan')) {
        $uploadImage = $request->file('logo_perumahan');
        $imageNameWithExt = $uploadImage->getClientOriginalName();
        $imageName = $request->file(date('ymdHis'));
        $imageExt = $uploadImage->getClientOriginalExtension();
        $storeImage = $imageName . time() . "." . $imageExt;
        $uploadImage->move(public_path('file/info'), $storeImage);

        if ($request->gambar_lama) {
          unlink(public_path('file/info/' . $request->gambar_lama));
        }

        $update->update([
          'logo_perumahan' => $storeImage,
          'nama_perumahan' => $request->nama_perumahan,
          'ket_perumahan' => $request->ket_perumahan,
          'alamat' => $request->alamat,
          'telp' => $request->telp,
          'email' => $request->email,
          'link_fb' => $request->link_fb,
          'link_ig' => $request->link_ig,
          'link_wa' => $request->link_wa,
          'url_maps' => $request->url_maps,
          'deleted' => '0',
          'updated_by' => auth()->user()->id,
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      } else {
        $update->update([
          'nama_perumahan' => $request->nama_perumahan,
          'ket_perumahan' => $request->ket_perumahan,
          'alamat' => $request->alamat,
          'telp' => $request->telp,
          'email' => $request->email,
          'link_fb' => $request->link_fb,
          'link_ig' => $request->link_ig,
          'link_wa' => $request->link_wa,
          'url_maps' => $request->url_maps,
          'deleted' => '0',
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
    public function destroy(string $id)
    {
        //
    }
}
