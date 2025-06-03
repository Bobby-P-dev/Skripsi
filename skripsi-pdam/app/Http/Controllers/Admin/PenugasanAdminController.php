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

            Log::info('PenugasanAdminController@store: Data tervalidasi dari FormRequest:', $validatedData);

            $dataToStore = array_merge($validatedData,);

            Log::info('PenugasanAdminController@store: Data yang akan dikirim ke service:', $dataToStore);

            $penugasan = $this->penugasanAdminService->store($dataToStore);

            if ($penugasan) {
                Log::info('PenugasanAdminController@store: Penugasan berhasil dibuat oleh service, ID Penugasan:', ['id' => $penugasan->id ?? null]);
            } else {
                Log::warning('PenugasanAdminController@store: Service store tidak mengembalikan objek penugasan atau mengembalikan null.');
            }

            DB::commit();

            return back()->with('success', 'Penugasan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat penugasan: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal membuat penugasan: ' . $e->getMessage()]);
        }
    }
}
