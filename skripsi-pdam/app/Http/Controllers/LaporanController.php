<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanCreateRequest;
use App\Models\Laporan_Model;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function getLaporan()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporans = Laporan_Model::where('pelanggan_id', Auth::id())->get();

        return view('laporan.index', compact('laporans'));
    }

    public function realtime()
    {
        // Ambil semua laporan, bisa juga tambahkan with('user') jika perlu relasi user
        $laporans = Laporan_Model::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($laporans);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to view this page.']);
        }
        $laporan = Laporan_Model::where('pelanggan_id', Auth::id())->get();
        return view('laporan.index', \compact('laporan'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(LaporanCreateRequest $request)
    {
        DB::beginTransaction();

        try {
            if (!$request->hasFile('foto_url')) {
                throw new \Exception('File foto wajib diupload.');
            }

            $uploadFile = Cloudinary::upload($request->file('foto_url')->getRealPath(), [
                'folder' => 'laporan',
            ])->getSecurePath();

            Laporan_Model::create([
                'pelanggan_id' => Auth::id(),
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'foto_url' => $uploadFile,
                'tingkat_urgensi' => $request->tingkat_urgensi,
                'status' => 'tertunda',
            ]);

            DB::commit();
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal membuat laporan: ' . $e->getMessage()]);
        }
    }
    public function showUpdate($id)
    {
        $laporan = Laporan_Model::findOrFail($id);
        return view('laporan.update', compact('laporan'));
    }

    public function update(LaporanCreateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $laporan = Laporan_Model::findOrFail($id);
            if ($laporan->pelanggan_id !== Auth::id()) {
                return redirect()->route('laporan.index')->withErrors(['error' => 'You do not have permission to delete this report.']);
            }

            $laporan->update([
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                'lokasi' => $request['lokasi'],
                'tingkat_urgensi' => $request['tingkat_urgensi'],
            ]);
            DB::commit();

            return redirect()->route('laporan.index')->with('success', 'Laporan updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update laporan: ' . $e->getMessage()]);
        }
    }

    public function showDelete()
    {
        return view('laporan.delete');
    }

    public function Delete($id)
    {
        DB::beginTransaction();
        try {
            $laporan = Laporan_Model::findOrFail($id);
            if ($laporan->pelanggan_id !== Auth::id()) {
                return redirect()->route('laporan.index')->withErrors(['error' => 'You do not have permission to delete this report.']);
            }
            $laporan->delete();
            DB::commit();
            return view('laporan.index', compact('laporan'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to delete laporan: ' . $e->getMessage()]);
        }
    }
}
