<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sale_query = Sale::date(request('date'));

        $total = $sale_query->sum('total');
        $sales = $sale_query->paginate(10);

        $weeklySales = Sale::thisWeek()->get()->groupBy(function($sale) {
            return Carbon::parse($sale->updated_at)->format('Y-m-d');
        })->map(function ($row) {
            return $row->sum('total');
        });

        $weeklySaleTotal = $weeklySales->sum();
        $dates = [];
        $weeklyDailySales = [];

        foreach($weeklySales as $key => $value) {
            $dates[] = $key;
            $weeklyDailySales[] = $value; 
        }

        $date = Carbon::parse(request('date'));

        return view('sale', compact('sales', 'total', 'date', 'dates', 'weeklyDailySales'));
    }

    public function store(Request $request)
    {
        $invoiceNo = now()->format('hisdmY');

        $sale = Sale::create([
            'invoice_no' => $invoiceNo,
            'customer' => $request->customer,
            'total' => 0,
        ]);

        $request->session()->put('sale', $sale);

        return back();
    }

    public function addProduct(Request $request, Sale $sale, Product $product)
    {
        if($sale->products->contains($product->id)) {
            return back()->with('message', 'Cannot Add');
        }
        
        if($request->qty > $product->qty) {
            return back()->with('message', 'Cannot Add');
        };
        
        $product->qty -= $request->qty;
        $product->update();
        
        $sale->products()->attach($product->id, ['qty' => $request->qty, 'price' => $product->price]);

        return back();
    }

    public function addServiceFee(Request $request, Sale $sale)
    {
        $validate = $request->validate([
            'description' => 'required',
            'fees' => 'required',
        ]);

        $sale->serviceFees()->create($validate);

        return back()->with('message', 'Add Successfully');
    }

    public function removeProduct(Sale $sale, Product $product)
    {
        $product->qty += $sale->products->find($product->id)->pivot->qty;
        $product->update();

        $sale->products()->detach($product->id);
        return back();
    }

    public function confirm(Request $request, Sale $sale)
    {
        $sale->total = $request->total;
        $sale->update();
        
        $request->session()->forget('sale');

        return redirect("/sale/print/{$sale->id}");
    }
    
    public function print(Sale $sale)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper([0, 0, 504, 612]);
        $pdf->loadView('print', ['sale' => $sale]);
        return $pdf->stream();
    }
}
