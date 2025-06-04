<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenuggasanCreateRequest;
use App\Services\Penugasan\Admin\PenugasanAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenugasanAdminController extends Controller
{
    protected $penugasanAdminService;
    public function __construct(PenugasanAdmin $penugasanAdminService)
    {
        $this->penugasanAdminService = $penugasanAdminService;
        $this->middleware('auth');
    }

    public function index()
    {
        $penugasans = $this->penugasanAdminService->index();
        return view('admin.penugasan.index', compact('penugasans'));
    }

    public function create(string $laporan_uuid)
    {
        $data = $this->penugasanAdminService->create($laporan_uuid);

        return view('admin.penugasan.penugasan-create', [
            'user' => $data['user'],
            'laporan_uuid'  => $data['laporan'],
        ]);
    }

    public function store(PenuggasanCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $dataToStore = [
                'laporan_uuid' => $validatedData['laporan_uuid'],
                'teknisi_id' => $validatedData['teknisi_id'],
                'admin_id' => Auth::id(),
                'tenggat_waktu' => $validatedData['tenggat_waktu'],
                'catatan' => $validatedData['catatan'],
            ];
            Log::info('Data akan dikirim ke service:', $dataToStore);
            $penugasan =  $this->penugasanAdminService->store($dataToStore);

            if ($penugasan) {
                DB::commit();
                return back()->with('success', 'Penugasan berhasil dibuat.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat penugasan: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal membuat penugasan: ' . $e->getMessage()]);
        }
    }
}
