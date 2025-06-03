<?php

namespace App\Services\Penugasan\Admin;

use App\Models\Penugasan_Model;

interface PenugasanAdmin
{
    public function create(string $laporan_uuid);
    public function store(array $penugasan);
    public function index();
}
