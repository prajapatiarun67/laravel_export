<?php

namespace App\Exports\student;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStudents implements FromCollection, WithMapping, WithHeadings
{
    protected $data;
    protected $sr_no = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($row): array
    {
        return [
            ++$this->sr_no,
            $row->name, 
            $row->email, 
            $row->location, 
            $row->pincode, 
            date('d-M, Y h:i', strtotime($row->created_at)),
            date('d-M, Y h:i', strtotime($row->updated_at)) 
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name', 
            'Email', 
            'Location', 
            'Pincode', 
            'Created At',
            'Last Modified At'
        ];
    }
}
