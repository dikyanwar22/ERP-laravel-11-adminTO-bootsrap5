<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class NotifController extends Controller {

    public function my_notification() {
        $data = [];
        $total = 10;
    
        for ($i = 0; $i < $total; $i++) {
            $data[] = array(
                'img' => 'https://cdn-icons-png.flaticon.com/512/4034/4034092.png',
                'name' => 'Hadi Suhada',
                'message' => 'Jangan lupa membawa joran untuk mancing hari minggu ini yah',
                'time' => '2024-09-29 08:08:09'
            );
        }

        return response()->json([
            'message' => 200,
            'data' => $data,
            'total' => $total
        ]);
    }        

}
