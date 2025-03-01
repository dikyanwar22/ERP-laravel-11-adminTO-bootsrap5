<?php

namespace App\Http\Controllers\perumahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\perumahan\M_perumahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Contact extends Controller
{
    public function __construct() {
        $this->model = new M_perumahan();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data['title'] = 'Kontak Kami';
        return view('perumahan.contact', $data);
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
        M_perumahan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'pesan' => $request->pesan,
            'deleted' => '0',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        session()->flash('msg', '<div class="sent-message">Terima kasih. Pesanmu suda terkirim.</div>');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
