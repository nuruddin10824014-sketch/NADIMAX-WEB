<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Halaman laporan.
     */
    public function index()
    {
        return view('report.index');
    }
}