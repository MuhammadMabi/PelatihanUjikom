<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Transaksi;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();

        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'isbn' => 'required|string|max:13|unique:bukus,isbn,' . $request->id,
        ]);

        if ($request->id) {
            $buku = Buku::findOrFail($request->id);

            $buku->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tanggal_terbit' => $request->tanggal_terbit,
                'isbn' => $request->isbn,
            ]);

            $message = 'Data buku berhasil diperbarui.';
        } else {
            Buku::create([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tanggal_terbit' => $request->tanggal_terbit,
                'isbn' => $request->isbn,
            ]);

            $message = 'Data buku berhasil ditambahkan.';
        }

        return redirect()->route('buku.index')->with('success', $message);
    }

    public function edit(int $id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.create', compact('buku'));
    }

    public function delete(int $id)
    {
        $buku = Buku::findOrFail($id);
        $transaksi = Transaksi::where('buku_id', $buku->id)->first();

        if ($transaksi) {
            return redirect()->back()->with('error', 'Data buku sedang digunakan.');
        }

        if ($buku) {
            $buku->delete();
        }

        return redirect()->back()->with('success', 'Data buku berhasil dihapus.');
    }
}
