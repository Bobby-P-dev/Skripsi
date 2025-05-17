<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna_Model;
use App\Providers\RouteServiceProvider;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Pengguna_Model::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telepon' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
            'peran' => ['required', 'in:admin,teknisi,pelanggan'],
            'foto_profil' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        // dd($request);
        if ($request->hasFile('foto_profil')) {
            try {
                $uploadResult = Cloudinary::upload($request->file('foto_profil')->getRealPath(), [
                    'folder' => 'foto_profil',
                ]);

                $pathResult = $uploadResult->getSecurePath();
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['profile_picture' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'peran' => $request->peran ?? 'pelanggan',
            'foto_profil' => $pathResult,
        ];


        $user = Pengguna_Model::create($userData);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
