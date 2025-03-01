<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{

  public function __construct() {

  }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $data['title'] = 'Dashboard';
        return view('admin.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $data['title'] = 'Dashboard';
      return view('akunting.create', $data);
    }

    public function munculkan() {
      $data['title'] = 'Dashboard';
      return view('akunting.create', $data);
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
