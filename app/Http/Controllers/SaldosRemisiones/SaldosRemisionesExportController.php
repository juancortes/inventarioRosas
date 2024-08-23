<?php

namespace App\Http\Controllers\SaldosRemisiones;

use App\Http\Controllers\Controller;
use App\Models\SaldosRemisiones;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class SaldosRemisionesExportController extends Controller
{
    public function create()
    {
        $saldosRemisiones = SaldosRemisiones::all()->sortBy('id');

        $saldosRemision_array[] = array(
            'produccion_freedom',
            'produccion_color',
            'devolucion_freedom',
            'devolucion_color',
            'valor_freedom',
            'valor_color',
            'valor_pagar_freedom',
            'valor_pagar_color',
        );

        foreach ($saldosRemisiones as $saldosRemision) {
            $saldosRemision_array[] = array(
                'produccion_freedom'  => $saldosRemision->produccion_freedom,
                'produccion_color'    => $saldosRemision->produccion_color,
                'devolucion_freedom'  => $saldosRemision->devolucion_freedom,
                'devolucion_color'    => $saldosRemision->devolucion_color,
                'valor_freedom'       => $saldosRemision->valor_freedom,
                'valor_color'         => $saldosRemision->valor_color,
                'valor_pagar_freedom' => $saldosRemision->valor_pagar_freedom,
                'valor_pagar_color'   => $saldosRemision->valor_pagar_color,
            );
        }

        $this->store($saldosRemision_array);
    }

    public function store($saldosRemisiones)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($saldosRemisiones);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="saldosRemisiones.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
