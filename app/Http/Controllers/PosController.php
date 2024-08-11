<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'unit'])->get();

        $customers = Customer::all()->sortBy('name');

        $carts = Cart::content();

        return view('pos.index', [
            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    public function addCartItem (Request $request)
    {
        $request->all();
        //dd($request);

        $rules = [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'selling_price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        Cart::add(
            $validatedData['id'],
            $validatedData['name'],
            1,
            $validatedData['selling_price'],
            1,
            (array)$options = null
        );

        return redirect()
            ->back()
            ->with('Exitoso', 'El Ramo ha sido añadido al carrito!');
    }

    public function updateCartItem(Request $request, $rowId)
    {
        $rules = [
            'qty' => 'required|numeric',
            'product_id' => 'numeric'
        ];
        
        $validatedData = $request->validate($rules);
        if ($validatedData['qty'] > Product::where('id', intval($validatedData['product_id']))->value('quantity')) {
            return redirect()
            ->back()
            ->with('error', 'La cantidad solicitada no está disponible en stock.');
        }
        

        Cart::update($rowId, $validatedData['qty']);

        return redirect()
            ->back()
            ->with('Exitoso', 'El Ramo ha sido actualizado al carrito!');
    }

    public function deleteCartItem(String $rowId)
    {
        Cart::remove($rowId);

        return redirect()
            ->back()
            ->with('Exitoso', 'El Ramo ha sido eliminado al carrito!');
    }
}
