<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Penugasan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            // DATA UNTUK ADMIN
            $totalPelanggan = User::where('role', 'pelanggan')->count();
            $laporanSelesai = Laporan::where('status', 'selesai')->count();
            $laporanProses = Laporan::where('status', 'proses')->count();
            $laporanDitolak = Laporan::where('status', 'ditolak')->count();
            $aktivitas = Laporan::with('pelanggan')->latest()->take(5)->get();

            return view('admin.dashboard', [
                'totalPelanggan' => $totalPelanggan,
                'laporanSelesai' => $laporanSelesai,
                'laporanProses' => $laporanProses,
                'laporanDitolak' => $laporanDitolak,
                'aktivitas' => $aktivitas
            ]);
        } elseif ($user->role == 'teknisi') {
            // DATA UNTUK TEKNISI
            $penugasan = Penugasan::where('teknisi_id', $user->id)
                ->with('laporan')
                ->latest()
                ->get();

            return view('teknisi.dashboard', [
                'penugasan' => $penugasan
            ]);
        } elseif ($user->role == 'pelanggan') {
            // DATA UNTUK PELANGGAN
            $laporanSaya = Laporan::where('pelanggan_id', $user->id)->latest()->get();

            return view('pelanggan.dashboard', [
                'laporanSaya' => $laporanSaya
            ]);
        } else {
            // fallback kalau role gak dikenali
            abort(403, 'Role tidak dikenali.');
        }
    }
}
