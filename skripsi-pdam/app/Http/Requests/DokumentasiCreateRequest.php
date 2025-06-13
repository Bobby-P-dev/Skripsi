<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumentasiCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'laporan_uuid' => 'required|uuid|exists:laporan,laporan_uuid',
            'teknisi_id' => 'required|exists:pengguna,pengguna_id|integer',
            'foto_url' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required|string|',
            'tindakan' => 'required|string'
        ];
    }
}
