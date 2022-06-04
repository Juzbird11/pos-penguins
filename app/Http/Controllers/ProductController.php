<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::paginate(6);
        // return view('product.index', compact('products'));
        return view('index');
    }

    public function outOfStock()
    {
        // $products = Product::whereColumn('min_qty', '>=', 'qty')->paginate(6);
        // return view('product.out-of-stock', compact('products'));

        return view('out-of-stock');
    }

    public function inStock()
    {
        return view('in-stock');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'barcode' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'min_qty' => 'required',
            'price' => 'required',
            'baseprice' => 'required',
        ]);

        Product::create($validate);

        return back();
    }

    public function addQty(Request $request, Product $product)
    {
        $product->qty = $request->qty;
        $product->update();

        return back(); 
    }

}
