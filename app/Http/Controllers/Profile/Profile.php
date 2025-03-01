<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\admin\Pertanyaan AS M_pertanyaan;

class Profile extends Controller {

    public function __construct() {
        $this->model = new M_pertanyaan();
    }

    public function index(): View
    {
        $data['title'] = 'My Profile';
        $data['question'] = M_pertanyaan::orderBy('id', 'DESC')->get();
        return view('profile.index', $data);
    }

}
