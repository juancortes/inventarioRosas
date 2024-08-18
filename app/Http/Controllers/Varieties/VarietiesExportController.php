<?php

namespace App\Http\Controllers\Varieties;

use App\Http\Controllers\Controller;
use App\Models\Varieties;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class VarietiesExportController extends Controller
{
    public function create()
    {
        $varieties = Varieties::all()->sortBy('code');

        $variety_array[] = array(
            'Código',
            'Nombre',
        );

        foreach ($varieties as $variety) {
            $variety_array[] = array(
                'Código' => $variety->code,
                'Nombre' => $variety->name,
            );
        }

        $this->store($variety_array);
    }

    public function store($varieties)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($varieties);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="varieties.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
