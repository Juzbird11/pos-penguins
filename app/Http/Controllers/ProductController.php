<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::search(request('search'))->where('qty', '>', 0)->paginate(6);
        $sale = null;

        if(session()->has('sale')){
            $sale = Sale::find(session()->get('sale')->id);
        }

        return view('index', compact('products', 'sale'));
    }

    public function create()
    {
        return view('create');
    }

    public function outOfStock()
    {
        $products = Product::search(request('search'))->whereColumn('min_qty', '>=', 'qty')->paginate(8);
        return view('out-of-stock', compact('products'));
    }

    public function allStocks()
    {
        $products = Product::search(request('search'))->paginate(8);
        return view('all-stocks', compact('products'));
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
        return back()->with('message', 'Add successfully');
    }

    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'min_qty' => 'required',
            'price' => 'required',
            'baseprice' => 'required',
        ]);
        $product->update($validate);

        return back()->with('message', 'Edit Successfully');
    }
}
