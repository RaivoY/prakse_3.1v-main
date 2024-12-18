<?php
namespace App\Exports;

use App\Models\FormSubmission;
use Maatwebsite\Excel\Excel;

class FormSubmissionsExport
{
    public function export()
    {
        $submissions = FormSubmission::all();
        Excel::create('Form Submissions', function($excel) use ($submissions) {
            $excel->sheet('Sheet 1', function($sheet) use ($submissions) {
                $sheet->fromArray($submissions->toArray());
            });
        })->export('csv');
    }
}
