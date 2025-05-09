<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanCreateRequest extends FormRequest
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
            'Pelanggan_id' => ['required', 'integer'],
            'Admin_id' => ['required', 'integer'],
            'Judul' => ['required', 'string', 'max:255'],
            'Deskripsi' => ['required', 'string'],
            'Lokasi' => ['required', 'string', 'max:255'],
            'tingkat_urgensi' => ['required', 'string', 'in:rendah,sedang,tinggi'],
            'Status' => ['required', 'string', 'in:pending,proses,selesai'],
        ];
    }
    // 'tertunda', 'ditugaskan', 'berlangsung', 'selesai'
    protected function prepareForValidation(): void
    {
        $this->merge([
            'Status' => $this->Status ?? 'pending',
        ]);
    }
}

