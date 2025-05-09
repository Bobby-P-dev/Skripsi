<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanCreateRequest;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use DB;
use Illuminate\Support\Facades\Auth;
class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function create()
    {

        return view('laporan.create');
    }

    public function store(LaporanCreateRequest $request)
    {
        if(!Auth::check()){
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to create a report.']);
        }
        DB::beginTransaction();

        try{
        Laporan_Model::create([
            'pelanggan_id' => Auth::id(),
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'lokasi' => $request['lokasi'],
            'tingkat_urgensi' => $request['tingkat_urgensi'],
            'status' => 'pending',
        ]);
        DB::commit();

        return redirect()->route('laporan.index')->with('success', 'Laporan created successfully.');
    }catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Failed to create laporan: ' . $e->getMessage()]);
    }
    }


    public function show($id)
    {
        return view('laporan.show', compact('id'));
    }

    public function edit($id)
    {
        return view('laporan.edit', compact('id'));
    }
}
