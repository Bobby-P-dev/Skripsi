<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Penugasan_Model; // <- Tambahkan ini
use Illuminate\Support\Facades\Auth;   // <- Tambahkan ini

class DokumentasiCreateRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna berwenang untuk membuat request ini.
     * Logikanya: Hanya teknisi yang ditugaskan yang boleh membuat dokumentasi.
     */
    public function authorize(): bool
    {
        // Pastikan ada pengguna yang login
        if (!Auth::check()) {
            return false;
        }

        // Ambil UUID laporan dari input form
        $laporanUuid = $this->input('laporan_uuid');

        // Cari data penugasan berdasarkan UUID laporan
        $penugasan = Penugasan_Model::where('laporan_uuid', $laporanUuid)->first();

        // Jika data penugasan tidak ditemukan, tolak akses
        if (!$penugasan) {
            return false;
        }

        // Bandingkan ID teknisi di tabel penugasan dengan ID pengguna yang sedang login
        // Ini adalah kunci otorisasi yang benar
        return (int)$penugasan->teknisi_id === (int)auth()->user()->pengguna_id;
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'teknisi_id' dihapus karena tidak dikirim dari form
            'laporan_uuid' => 'required|string|exists:laporan,laporan_uuid',
            'keterangan'   => 'required|string',
            'tindakan'     => 'required|string',
            'foto_url'     => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB dan required
        ];
    }
}
