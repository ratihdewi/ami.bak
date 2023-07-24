<?php

namespace App\Exports;

use App\Models\Jadwal;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class DaftarTilikExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id, $auditee_id;

    public function __construct($id, $auditee_id)
    {
        $this->id = $id;
        $this->auditee_id = $auditee_id;
    }

    public function collection()
    {
        return Pertanyaan::select('butirStandar', 'pertanyaan', 'indikatormutu', 'targetStandar', 'referensi', 'inisialAuditor', 'responAuditee', 'responAuditor', 'skorAuditor')->where('daftartilik_id', $this->id)->where('auditee_id', $this->auditee_id)->get();
    }

    public function headings() : array
    {
        return [
            'Butir Standar', 
            'Pertanyaan', 
            'Indikator Mutu', 
            'Target Standar', 
            'Referensi', 
            'Inisial Auditor', 
            'Respon Auditee', 
            'Respon Auditor', 
            'Skor Auditor',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            8 => [
                'font' => ['bold' => true],
            ],
        ];
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $daftartilik_ = DaftarTilik::where('id', $this->id)->where('auditee_id', $this->auditee_id)->first();
                $auditee_ = Auditee::where('id', $this->auditee_id)->first();
                $auditor_ = Auditor::where('id', $daftartilik_->auditor_id)->first();
                // $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
                $jadwal_ = Jadwal::where('auditee_id', $this->auditee_id)->where('auditor_id', $daftartilik_->auditor_id)->get();
                foreach ($jadwal_ as $key => $jadwal) {
                    $waktu[] = $jadwal->waktu->isoFormat("HH:mm").' WIB';
                }

                $event->sheet->setCellValue('A2', 'Auditee: ');
                $event->sheet->setCellValue('A3', 'Auditor: ');
                $event->sheet->setCellValue('A4', 'Hari/Tanggal: ');
                $event->sheet->setCellValue('A5', 'Waktu: ');
                $event->sheet->setCellValue('A6', 'Area: ');
 
                $event->sheet->getDelegate()->setCellValue('B2', $auditee_->unit_kerja);
                $event->sheet->getDelegate()->setCellValue('B3', $auditor_->nama);
                $event->sheet->getDelegate()->setCellValue('B4', $daftartilik_->tgl_pelaksanaan->translatedFormat('l, d M Y'));
                $event->sheet->getDelegate()->setCellValue('B5', $waktu);
                $event->sheet->getDelegate()->setCellValue('B6', $daftartilik_->area);
                
            },
        ];
    }

}
