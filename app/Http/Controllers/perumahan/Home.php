<?php

namespace App\Http\Controllers\perumahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\perumahan\M_perumahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{

    public function __construct() {
        $this->model = new M_perumahan();
    }

    public function index(): View
    {
        $data['title'] = 'Home';
        return view('perumahan.home', $data);
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
