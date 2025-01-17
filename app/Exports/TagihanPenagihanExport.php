<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanPenagihanExport implements FromCollection, WithHeadings
{
    protected $tagihanId;

    public function __construct($tagihanId)
    {
        $this->tagihanId = $tagihanId;
    }

    public function collection()
    {
        $tagihan = Tagihan::with('penagihan.siswa')->find($this->tagihanId);

        $data = [];

        if ($tagihan) {
            foreach ($tagihan->penagihan as $penagihan) {
                $data[] = [
                    'no_induk' => $penagihan->siswa->no_induk,
                    'nama' => $penagihan->siswa->nama,
                    'tingkatan' => $tagihan->tingkatan,
                    'semester' => $tagihan->semester,
                    'tipe' => $tagihan->nama,
                    'bln_awal' => $tagihan->tgl_tagihan,
                    'bln_akhir' => $tagihan->tgl_tempo,
                    'tagihan' => $tagihan->nominal,
                    'status' => $penagihan->status,
                    'tgl_dibayar' => $penagihan->tgl_dibayar,
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'No Induk',
            'Nama',
            'Tingkatan',
            'Semester',
            'Tipe',
            'Bulan Awal',
            'Bulan Akhir',
            'Tagihan',
            'Status',
            'Tanggal Dibayar',
        ];
    }
}
