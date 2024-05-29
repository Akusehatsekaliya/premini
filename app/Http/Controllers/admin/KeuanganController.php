<?php

namespace App\Http\Controllers\admin;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KeuanganController extends Controller
{
    public function keuangan()
    {
        $pembayaran = Pembayaran::all();

        return view('admin.keuangan.keuangan', compact('pembayaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);
        
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        // Periksa apakah verifikasi atau tolak
        if ($request->has('verifikasi')) {
            $pembayaran->status = 'Diterima';
        } elseif ($request->has('tolak')) {
            $pembayaran->status = 'Ditolak';
        }

        $pembayaran->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui');
    }
}
