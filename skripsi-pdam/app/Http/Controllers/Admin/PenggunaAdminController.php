<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Pengguna_Model;
use App\Services\Pengguna\Admin\PenggunaAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaAdminController extends Controller
{

    protected $dataPengguna;

    public function __construct(PenggunaAdmin $dataPengguna)
    {
        $this->dataPengguna = $dataPengguna;
    }

    public function EditStore(PenggunaCreateRequest $request, int $pengguna_id)
    {

        DB::beginTransaction();
        try {
            $validatedData = $request->validated();

            if (empty($validatedData['password'])) {
                unset($validatedData['password']);
            } else {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $this->dataPengguna->EditStore($validatedData, $pengguna_id);

            DB::commit();

            return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function Delete(int $pengguna_id)
    {
        $destory = $this->dataPengguna->DeletePengguna($pengguna_id);

        if ($destory) {
            return redirect()->back()->with('success', 'data penguna berhasil di hapus');
        }
        return redirect()->back()->withErrors('error', 'gagal mengahpus data');
    }

    public function teknisiGetOption()
    {
        $users = Pengguna_Model::where('peran', 'teknisi')->select('pengguna_id', 'nama')->get();
        return response()->json($users);
    }

    public function index()
    {
        $users = Pengguna_Model::select('pengguna_id', 'nama', 'email', 'alamat', 'no_telepon', 'peran', 'foto_profil')->paginate(7);

        return view('admin.data-pengguna-index', compact('users'));
    }

    public function GetUserById($id)
    {
        $user = Pengguna_Model::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function UpdateUser(ProfileUpdateRequest $request, $id)
    {
        $user = Pengguna_Model::findOrFail($id);
        $user->update($request->validated());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
