<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PenuggasanCreateRequest extends FormRequest
{
    public function authorize()
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();

        return $user->peran === 'admin';
    }

    public function rules()
    {
        return [
            'laporan_uuid'      => 'required|uuid|exists:laporan,laporan_uuid',
            'teknisi_id'        => 'required|exists:pengguna,pengguna_id|integer',
            'admin_id'          => 'required|integer|exists:pengguna,pengguna_id',
            'tenggat_waktu'     => 'required|date|after_or_equal:now',
            'catatan'           => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'laporan_uuid.required' => 'Laporan harus dipilih.',
            'laporan_uuid.exists' => 'Laporan yang dipilih tidak valid.',
            'teknisi_id.required' => 'Teknisi harus dipilih.',
            'teknisi_id.exists' => 'Teknisi yang dipilih tidak valid.',
            'tenggat_waktu.required' => 'Tenggat waktu harus diisi.',
            'tenggat_waktu.after' => 'Tenggat waktu harus setelah waktu sekarang.',
        ];
    }
}
