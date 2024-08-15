<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class CategoryExportController extends Controller
{
    public function create()
    {
        $categories = Category::all()->sortBy('product_name');

        $product_array[] = array(
            'Código',
            'Nombre de la Categoria',
            'Cantidad de Tallos',
        );

        foreach ($categories as $product) {
            $product_array[] = array(
                'Nombre de la Categoria' => $product->name,
                'Código'                 => $product->code,
                'Cantidad de Tallos'     => $product->quantity,
            );
        }

        $this->store($product_array);
    }

    public function store($categories)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($categories);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="categories.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
