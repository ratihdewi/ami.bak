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
        // return Pertanyaan::select('butirStandar', 'pertanyaan', 'indikatormutu', 'targetStandar', 'referensi', 'inisialAuditor', 'responAuditee', 'responAuditor', 'skorAuditor')->where('daftartilik_id', $this->id)->where('auditee_id', $this->auditee_id)->get();

        $pertanyaans = Pertanyaan::select(
            'butirStandar',
            'pertanyaan',
            'indikatormutu',
            'targetStandar',
            'referensi',
            'inisialAuditor',
            'responAuditee',
            'responAuditor',
            'skorAuditor'
        )
        ->where('daftartilik_id', $this->id)
        ->where('auditee_id', $this->auditee_id)
        ->orderBy('nomorButir')
        ->get();
    
        foreach ($pertanyaans as $pertanyaan) {
            $pertanyaan->pertanyaan = strip_tags($pertanyaan->pertanyaan);
            $pertanyaan->indikatormutu = strip_tags($pertanyaan->indikatormutu);
        }
    
        return $pertanyaans;
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

        $sheet->getStyle('B9:B1000')->getAlignment()->setWrapText(true);

        $sheet->getStyle('8')->getFont()->setBold(true);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);

        return $sheet;
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
                $jadwal_ = Jadwal::where('auditee_id', $this->auditee_id)->where('auditor_id', $daftartilik_->auditor_id)->get();
                
                if (count($jadwal_) != 0) {
                    foreach ($jadwal_ as $key => $jadwal) {
                        $waktu[] = $jadwal->waktu->isoFormat("HH:mm").' WIB';
                    }
                } else {
                    $waktu[] = "";
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
