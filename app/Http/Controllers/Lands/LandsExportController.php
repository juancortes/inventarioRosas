<?php

namespace App\Http\Controllers\Lands;

use App\Http\Controllers\Controller;
use App\Models\Lands;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class LandsExportController extends Controller
{
    public function create()
    {
        $lands = Lands::all()->sortBy('code');

        $land_array[] = array(
            'Código',
            'Nombre',
        );

        foreach ($lands as $land) {
            $land_array[] = array(
                'Código' => $land->code,
                'Nombre' => $land->name,
            );
        }

        $this->store($land_array);
    }

    public function store($lands)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($lands);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="lands.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
