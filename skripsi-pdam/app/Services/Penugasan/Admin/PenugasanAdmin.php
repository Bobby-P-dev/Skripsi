<?php

namespace App\Services\Penugasan\Admin;

use App\Models\Penugasan_Model;

interface PenugasanAdmin
{
    public function store(array $penugasan);
    public function index();
}
