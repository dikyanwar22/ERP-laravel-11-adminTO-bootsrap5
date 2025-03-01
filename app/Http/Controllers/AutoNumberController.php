<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\DB;

class AutoNumberController extends Controller
{
    
    public function index()
    {
        return view('library.otomatis_number');
    }

    public function generate()
    {
        $prefix = 'MJL';

        // Ambil nomor terakhir, atau buat baru jika belum ada
        $record = DB::table('auto_numbers')->where('prefix', $prefix)->first();

        if (!$record) {
            DB::table('auto_numbers')->insert([
                'prefix' => $prefix,
                'last_number' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $newNumber = 1;
        } else {
            $newNumber = $record->last_number + 1;
            DB::table('auto_numbers')->where('prefix', $prefix)->update([
                'last_number' => $newNumber,
                'updated_at' => now()
            ]);
        }

        // Format output (contoh: CRB-000001)
        $autoNumber = $prefix . '-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

        return response()->json(['auto_number' => $autoNumber]);
    }

    public function camera() {
        return view('library.camera');
    }

}
