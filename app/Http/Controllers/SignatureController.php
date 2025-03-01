<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\DB;
class SignatureController extends Controller
{

    public function index() {
        return view('library.signature');
    }
    
    public function store(Request $request) {
        $request->validate([
            'signature' => 'required',
        ]);

        $ttd = $request->input('signature');

        $data = [
            'signature' => $ttd,
        ];

        $signature = DB::table('signatures')->insert($data);
        
        if($signature) {
            return response()->json(['status' => true, 'message' => 'TTD berhasil disimpan'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'TTD gagal disimpan'], 400);
        } 
    }
   
    public function show($id)
    {
        $signature = (array) DB::selectOne("SELECT * FROM signatures WHERE id = :id", ['id' => $id]);
        return view('library.show_signature', compact('signature'));
    }
    
    public function show_qr() {
        return view('library.show_qr');
    }

    public function show_static_qr() {
        return view('library.show_static_qr');
    }

}
