<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PenuggasanCreateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    public function rules()
    {
        return [
            'laporan_uuid'      => 'required|uuid|exists:laporan,uuid',
            'teknisi_id'        => 'required|exists:users,id', // Asumsi teknisi adalah user dengan role teknisi
            'tenggat_waktu'     => 'required|date|after:now',
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

    // Prepare the data for validation
    protected function prepareForValidation()
    {
        $this->merge([
            'admin_id' => Auth::id() // Otomatis isi admin_id dengan user yang login
        ]);
    }
}
