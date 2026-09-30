<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::all();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:255|unique:users,nik,' . $request->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ]);

        if ($request->id) {
            $anggota = User::findOrFail($request->id);

            $anggota->update([
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            if ($request->password) {
                $anggota->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            $message = 'Data user berhasil diperbarui.';
        } else {
            $request->validate([
                'password' => 'required',
            ]);

            User::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            $message = 'Data user berhasil ditambahkan.';
        }

        return redirect()->route('anggota.index')->with('success', $message);
    }

    public function edit(int $id)
    {
        $anggota = User::findOrFail($id);

        return view('anggota.create', compact('anggota'));
    }

    public function delete(int $id)
    {
        $anggota = User::findOrFail($id);
        $transaksi = Transaksi::where('user_id', $anggota->id)->first();

        if ($transaksi) {
            return redirect()->back()->with('error', 'Data user sedang digunakan.');
        }

        if ($anggota) {
            $anggota->delete();
        }

        return redirect()->back()->with('success', 'Data user berhasil dihapus.');
    }
}
