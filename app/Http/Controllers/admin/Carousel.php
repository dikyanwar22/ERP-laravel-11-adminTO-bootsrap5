<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\admin\Carousel AS M_carousel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Carousel extends Controller
{

  public function __construct() {
    $this->model = new M_carousel();
  }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
      $data['title'] = 'Informasi Perumahan';
      $data['carousel'] = M_carousel::orderBy('id', 'DESC')->get();
      return view('admin.carousel.index', $data);
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
    public function store(Request $request): RedirectResponse
    {
      $this->validate($request, [
        'teks' => 'required|min:5',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $uploadImage = $request->file('img');
      $imageNameWithExt = $uploadImage->getClientOriginalName();
      $imageName = $request->file(date('ymdHis'));
      $imageExt = $uploadImage->getClientOriginalExtension();
      $storeImage = $imageName . time() . "." . $imageExt;
      $uploadImage->move(public_path('file/carousel'), $storeImage);

      M_carousel::create([
        'img' => $storeImage,
        'teks' => $request->teks,
        'deleted' => '0',
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
        'teks' => 'required|min:5',
        // 'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $update = M_carousel::findOrFail($id);

      if ($request->hasFile('img')) {
        $uploadImage = $request->file('img');
        $imageNameWithExt = $uploadImage->getClientOriginalName();
        $imageName = $request->file(date('ymdHis'));
        $imageExt = $uploadImage->getClientOriginalExtension();
        $storeImage = $imageName . time() . "." . $imageExt;
        $uploadImage->move(public_path('file/carousel'), $storeImage);

        if ($request->img_lama) {
          unlink(public_path('file/carousel/' . $request->img_lama));
        }

        $update->update([
          'img' => $storeImage,
          'teks' => $request->teks,
          'deleted' => '0',
          'updated_by' => auth()->user()->id,
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      } else {
        $update->update([
          'teks' => $request->teks,
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
       $data_img = M_carousel::findOrFail($id);

       // Menghapus file dari direktori
       unlink(public_path('file/carousel/' . $data_img->img));

       // Menghapus data dari database
       $data_img->delete();

       // Flash message
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

}
