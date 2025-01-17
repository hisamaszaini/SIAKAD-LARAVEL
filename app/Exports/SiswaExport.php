<?php
namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $columns;

    public function __construct($columns = [])
    {
        $this->columns = $columns;
    }

    public function collection()
    {
        return Siswa::with('kelas')->get()->map(function ($item) {
            $data = [];

            foreach ($this->columns as $column) {
                if ($column === 'kelas') {
                    $data[$column] = $item->kelas->nama ?? 'N/A';
                } elseif ($column !== 'users_id') {
                    $data[$column] = $item->{$column};
                }
            }

            return $data;
        });
    }

    public function headings(): array
    {
        return array_filter($this->columns, function ($column) {
            return $column !== 'users_id';
        });
    }
}