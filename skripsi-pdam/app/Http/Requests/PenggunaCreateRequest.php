<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PenggunaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();

        return $user->peran === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $penggunaId = $this->route('pengguna_id');
        return [
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pengguna', 'email')->ignore($penggunaId, 'pengguna_id')
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:1000',
            'peran' => ['required', 'string', Rule::in(['teknisi', 'admin', 'pelanggan'])],
        ];
    }
}
