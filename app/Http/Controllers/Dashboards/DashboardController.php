<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Lands;
use App\Models\Tables;
use App\Models\Quotation;
use App\Models\TypeBranches;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where("user_id", auth()->id())->count();
        $fincas = Lands::count();
        $mesas = Tables::count();
        $tipoRamos = TypeBranches::count();
        $mesaxRamo = DB::table('products')
                        ->select('tables.name', DB::raw('COUNT(tables.name) AS cantidad'))
                        ->join('tables', 'tables.id', '=', 'products.table_id')
                        ->groupBy('tables.name')
                        ->get();
        $fincaxRamo = DB::table('products')
                        ->select('lands.name', DB::raw('COUNT(lands.name) AS cantidad'))
                        ->join('lands', 'lands.id', '=', 'products.lands_id')
                        ->groupBy('lands.name')
                        ->get();
        
        return view('dashboard', [
            'products'   => $products,
            'fincas'     => $fincas,
            'mesas'      => $mesas,
            'mesaxRamo'  => $mesaxRamo,
            'fincaxRamo' => $fincaxRamo,
            'tipoRamos'  => $tipoRamos
        ]);
    }
}
