<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function index()
    {
        $buku = Buku::all()->count();
        $anggota = User::all()->count();
        $transaksi = Transaksi::all()->count();

        return view('home', compact('buku', 'anggota', 'transaksi'));
    }
}
