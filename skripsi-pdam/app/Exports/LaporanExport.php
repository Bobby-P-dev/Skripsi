<?php

namespace App\Exports;

use App\Models\Laporan_Model;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

// USE STATEMENTS YANG DIPERLUKAN
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class LaporanExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $tanggalMulai;
    protected $tanggalSelesai;

    public function __construct($tanggalMulai, $tanggalSelesai)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;

        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
    }

    public function query()
    {
        return Laporan_Model::query()
            ->with(['pelanggan', 'admin'])
            ->filterBerdasarkanTanggal($this->tanggalMulai, $this->tanggalSelesai)
            ->latest();
    }

    public function headings(): array
    {
        return [
            'ID Laporan',
            'Judul',
            'Pelanggan',
            'Admin Penanggung Jawab',
            'Lokasi',
            'Status',
            'Tingkat Urgensi',
            'Tanggal Dibuat',
        ];
    }

    public function map($laporan): array
    {
        return [
            $laporan->laporan_uuid,
            $laporan->judul,
            $laporan->pelanggan->nama ?? 'N/A',
            $laporan->admin->nama ?? 'N/A',
            $laporan->lokasi,
            $laporan->status,
            $laporan->tingkat_urgensi,
            $laporan->created_at->format('d-m-Y H:i'),
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // --- LOGIKA UNTUK HEADER DAN JUDUL ---
                $sheet = $event->sheet;
                $sheet->insertNewRowBefore(1, 3);
                $sheet->mergeCells('A1:H1');
                $sheet->setCellValue('A1', 'DATA LAPORAN');
                $periode = "Periode: " . ($this->tanggalMulai ? \Carbon\Carbon::parse($this->tanggalMulai)->format('d M Y') : 'Semua') . " - " . ($this->tanggalSelesai ? \Carbon\Carbon::parse($this->tanggalSelesai)->format('d M Y') : 'Semua');
                $sheet->mergeCells('A2:H2');
                $sheet->setCellValue('A2', $periode);
                $sheet->styleCells('A1', [
                    'font' => ['size' => 16, 'bold' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $sheet->styleCells('A2', [
                    'font' => ['size' => 12, 'italic' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                // --- LOGIKA UNTUK SUMMARY ROW (TOTAL DATA) ---
                $lastRow = $sheet->getDelegate()->getHighestRow();
                $summaryRow = $lastRow + 2;
                $totalDataRows = $lastRow - 4;
                $sheet->mergeCells("A{$summaryRow}:G{$summaryRow}");
                $sheet->setCellValue("A{$summaryRow}", 'Total Laporan');
                $sheet->setCellValue("H{$summaryRow}", $totalDataRows);
                $sheet->styleCells("A{$summaryRow}:H{$summaryRow}", [
                    'font' => ['bold' => true],
                    'borders' => [
                        'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ]
                ]);
            },
        ];
    }
}
