<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Lands;
use App\Models\Varieties;
use App\Models\Tables;
use App\Models\TypeBranches;
use App\Models\Grades;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\DB;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where("user_id", auth()->id())->count();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
      $categories    = Category::where("user_id", auth()->id())->get(['id', 'name']);
      $varieties     = Varieties::get(['id', 'name']);
      $units         = Unit::where("user_id", auth()->id())->get(['id', 'name']);
      $lands         = Lands::get(['id', 'name']);
      $tables        = Tables::get(['id', 'name']);
      $type_branches = TypeBranches::get(['id', 'name']);
      $grades        = Grades::get(['id', 'name']);

      if ($request->has('category')) {
          $categories = Category::where("user_id", auth()->id())->whereSlug($request->get('category'))->get();
      }

      if ($request->has('unit')) {
          $units = Unit::where("user_id", auth()->id())->whereSlug($request->get('unit'))->get();
      }

      if ($request->has('varieties')) {
          $varieties = Varieties::get();
      }

      if ($request->has('lands')) {
          $lands = Lands::get();
      }

      if ($request->has('tables')) {
          $tables = Tables::get();
      }

      if ($request->has('type_branches')) {
          $type_branches = TypeBranches::get();
      }

      if ($request->has('grades')) {
          $grades = Grades::get();
      }

      $ddate = date('Y-m-d');
      $date = new \DateTime($ddate);
      $week = $date->format("W");

      return view('products.create', [
          'categories'    => $categories,
          'units'         => $units,
          'varieties'     => $varieties,
          'lands'         => $lands,
          'tables'        => $tables,
          'type_branches' => $type_branches,
          'grades'        => $grades,
          'fecha'         => $ddate,
          'week'          => $week,
      ]);
    }

    public function store(StoreProductRequest $request)
    {
        /**
         * Handle upload image
         */
        $image = "";
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image')->store('products', 'public');
        }

        $ddate = date('Y-m-d');
        $date = new \DateTime($ddate);
        $week = $date->format("W");

        Product::create([
            "code" => IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC'
            ]),

            'product_image'  => $image,
            'category_id'    => $request->category_id,
            'consecutive'    => $request->consecutive,
            'lands_id'       => $request->lands_id,
            'varietie_id'    => $request->varietie_id,
            'type_branche_id'=> $request->type_branche_id,
            'table_id'       => $request->table_id,
            'grades_id'      => $request->grades_id,
            'quantity'       => $request->quantity,
            'date'           => date('Y-m-d'),
            'week'           => $week,
            'notes'          => $request->notes,
            "user_id"        => auth()->id(),
            "slug"           => Str::slug($request->name, '-'),
            "uuid"           => Str::uuid()
        ]);


        return to_route('products.create')->with('Exitoso', 'Ramo ha sido creado!');
    }

    public function show($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();

        $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }

    public function edit($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        return view('products.edit', [
          'categories'    => Category::where("user_id", auth()->id())->get(),
          'units'         => Unit::where("user_id", auth()->id())->get(),
          'varieties'     => Varieties::get(['id', 'name']),
          'lands'         => Lands::get(['id', 'name']),
          'product'       => $product,
          'tables'        => Tables::get(['id', 'name']),
          'grades'        => Grades::get(['id', 'name']),
          'type_branches' => TypeBranches::get(['id', 'name']),
        ]);
    }

    public function update(UpdateProductRequest $request, $uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        $product->update($request->except('product_image'));

        $image = $product->product_image;
        if ($request->hasFile('product_image')) {

            // Delete Old Photo
            if ($product->product_image) {
                unlink(public_path('storage/') . $product->product_image);
            }
            $image = $request->file('product_image')->store('products', 'public');
        }

        $product->slug            = Str::slug($request->name, '-');
        $product->category_id     = $request->category_id;
        $product->consecutive     = $request->consecutive;
        $product->lands_id        = $request->lands_id;
        $product->varietie_id     = $request->varietie_id;
        $product->type_branche_id = $request->type_branche_id;
        $product->table_id        = $request->table_id;
        $product->grades_id       = $request->grades_id;
        $product->tax_type        = $request->tax_type;
        $product->quantity        = $request->quantity;
        $product->notes           = $request->notes;
        $product->product_image   = $image;
        $product->date            = $request->date;
        $product->week            = $request->week;
        $product->save();

        return redirect()
            ->route('products.index')
            ->with('Exitoso', 'Ramo ha sido actualizado!');
    }

    public function destroy($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        /**
         * Delete photo if exists.
         */
        if ($product->product_image) {
            // check if image exists in our file system
            if (file_exists(public_path('storage/') . $product->product_image)) {
                unlink(public_path('storage/') . $product->product_image);
            }
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('Exitoso', 'Ramo ha sido borrado!');
    }

    public function getCodes()
    {
        $finca     = Lands::where('code',$_GET['finca'])->get();
        $variedad  = Varieties::where('code',$_GET['variedad'])->get();
        $mesa      = Tables::where('code',$_GET['mesa'])->get();
        $grado     = Grades::where('code',$_GET['grado'])->get();
        $tipo_ramo = TypeBranches::where('code',$_GET['tipo_ramo'])->get();

        $data = [
            "finca"     => (count($finca) > 0 ) ?     $finca[0]->id : -1,
            "variedad"  => (count($variedad) > 0 ) ?  $variedad[0]->id : -2,
            "mesa"      => (count($mesa) > 0 ) ?      $mesa[0]->id : -3,
            "grado"     => (count($grado) > 0 ) ?     $grado[0]->id : -4,
            "tipo_ramo" => (count($tipo_ramo) > 0 ) ? $tipo_ramo[0]->id : -5,
            "cantidad"  => (count($tipo_ramo) > 0 ) ? $tipo_ramo[0]->quantity : 0,
        ];
        return response()->json($data);
    }

    public function informeProduccion()
    {
        $informe = DB::table('products')
                    ->select(DB::raw("products.created_at as fecha_creacion"),
                             DB::raw("lands.name as finca"),
                             DB::raw("varieties.name as variedad"),
                             DB::raw("type_branches.name as variedad"),
                             DB::raw("tables.name as mesa"),
                             DB::raw("grades.name as grados"),
                             DB::raw("type_branches.quantity as cantidad_ramos")
                            )
                    ->join('lands','products.lands_id', '=', 'lands.id')
                    ->join('varieties','products.varietie_id', '=', 'varieties.id')
                    ->join('type_branches','products.type_branche_id', '=','type_branches.id')
                    ->join('tables','products.table_id', '=', 'tables.id')
                    ->join('grades','products.grades_id', '=', 'grades.id')
                    ->get();
        return view('products.informeProduccion', [
        ]);
    }
}
