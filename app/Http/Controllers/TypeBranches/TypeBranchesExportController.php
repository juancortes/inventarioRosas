<?php

namespace App\Http\Controllers\TypeBranches;

use App\Http\Controllers\Controller;
use App\Models\TypeBranches;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class TypeBranchesExportController extends Controller
{
    public function create()
    {
        $typeBranches = TypeBranches::all()->sortBy('code');

        $typeBranche_array[] = array(
            'Código',
            'Nombre',
            'Cantidad',
        );

        foreach ($typeBranches as $typeBranche) {
            $typeBranche_array[] = array(
                'Código'   => $typeBranche->code,
                'Nombre'   => $typeBranche->name,
                'Cantidad' => $typeBranche->quantity,
            );
        }

        $this->store($typeBranche_array);
    }

    public function store($typeBranches)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($typeBranches);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="typeBranches.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
