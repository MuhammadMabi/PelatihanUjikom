<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Buku;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $anggota = User::all();
        $bukus = Buku::all();

        return view('transaksi.create', compact('anggota', 'bukus'));
    }

    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'status' => 'required|in:dipinjam,dikembalikan',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($request->id) {
            $transaksi = Transaksi::findOrFail($request->id);

            if ($request->tanggal_pengembalian) {
                $tanggalKembali = \Carbon\Carbon::parse($transaksi->tanggal_kembali);
                $tanggalPengembalian = \Carbon\Carbon::parse($request->tanggal_pengembalian);

                if ($tanggalPengembalian->gt($tanggalKembali)) {
                    $denda = $tanggalPengembalian->diffInDays($tanggalKembali) * -1000;
                }
            }

            if ($request->status == 'dikembalikan') {

            }

            $transaksi->update([
                'user_id' => $request->user_id,
                'buku_id' => $request->buku_id,
                'status' => $request->status,
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'denda' => $denda ?? 0,
                'keterangan' => $request->keterangan,
            ]);

            $message = 'Data transaksi berhasil diperbarui.';
        } else {
            Transaksi::create([
                'user_id' => $request->user_id,
                'buku_id' => $request->buku_id,
                'status' => $request->status,
                'tanggal_pinjam' => now()->format('Y-m-d'),
                'tanggal_kembali' => \Carbon\Carbon::parse(now()->format('Y-m-d'))->addDays(3)->format('Y-m-d'),
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'keterangan' => $request->keterangan,
            ]);

            $message = 'Data transaksi berhasil ditambahkan.';
        }

        return redirect()->route('transaksi.index')->with('success', $message);
    }

    public function edit(int $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $anggota = User::all();
        $bukus = Buku::all();

        return view('transaksi.create', compact('transaksi', 'anggota', 'bukus'));
    }

    public function delete(int $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi) {
            $transaksi->delete();
        }

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus.');
    }
}
