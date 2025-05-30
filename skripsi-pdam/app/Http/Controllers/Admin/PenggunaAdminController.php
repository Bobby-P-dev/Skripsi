<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Pengguna_Model;
use Illuminate\Http\Request;

class PenggunaAdminController extends Controller
{
    public function teknisiGetOption()
    {
        $users = Pengguna_Model::where('peran', 'teknisi')->select('pengguna_id', 'nama')->get();
        return response()->json($users);
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

    public function DeleteUser($id)
    {
        $user = Pengguna_Model::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
