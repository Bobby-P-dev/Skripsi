<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanCreateRequest;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DB;
use Illuminate\Support\Facades\Auth;
class LaporanController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to view this page.']);
        }
        $laporan = Laporan_Model::where('pelanggan_id', Auth::id())->get();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(LaporanCreateRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to create a report.']);
        }
        DB::beginTransaction();

        if ($request->hasFile('foto_url')) {
            try {
                $uploadFile = Cloudinary::upload($request->file('foto_url')->getRealPath(), [
                    'folder' => 'laporan',
                ])->getSecurePath();
                Laporan_Model::create([
                    'pelanggan_id' => Auth::id(),
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi'],
                    'lokasi' => $request['lokasi'],
                    'foto_url' => $uploadFile,
                    'tingkat_urgensi' => $request['tingkat_urgensi'],
                    'status' => 'pending',
                ]);
                DB::commit();

                return redirect()->route('laporan.index')->with('success', 'Laporan created successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Failed to create laporan: ' . $e->getMessage()]);
            }
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
