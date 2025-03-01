<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Dompdf\Dompdf;
use Dompdf\Options;

class WelcomeController extends Controller
{

    public function __construct() {
        // $this->model = new Modul();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data['title'] = 'Welcome';
        return view('first_page', $data);
    }

    public function generatePDF()
    {
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', true); // Pastikan PHP diizinkan jika perlu
        $options->set('isFontSubsettingEnabled', true);
    
        // Matikan default footer yang menampilkan "Page: 1"
        $options->set('isJavascriptEnabled', false); 
        $options->set('isPhpEnabled', false);
    
        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
    
        // Render Blade view jadi HTML
        $html = View::make('layout.pdf')->render();
    
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
    
        // Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF tanpa footer
        $dompdf->render();
    
        // Langsung tampilkan PDF di browser
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="laporan.pdf"');
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
