<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index');
    }

    public function orders()
    {
        //
        $collection = Order::orderByDesc('id')->get();
        return OrderResource::collection($collection);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::where('status', 'active')->get();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'products' => 'required|array',
            'status' => 'required',
        ]);
        try {
            $index = 'ED' . date('y') . str_pad(Order::max('id') + 1, 2, '0', STR_PAD_LEFT);

            $order = Order::create([
                'index' => $index,
                'customer_id' => $request->customer_id,
                'status' => $request->status,
                'user_id' => auth()->user()->id,
            ]);
            if ($order) {
                for ($i = 0; $i < count($request->products); $i++) {
                    $product = Product::find($request->products[$i]);
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'discount' => $request->discount[$i],
                        'amount' => $request->amount[$i],
                    ]);
                }
            }
            return to_route('orders.index')->with('message', 'Order Created Succesfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
        return view('orders.show', compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        $customers = Customer::where('status', 'active')->get();
        $products = Product::all();
        return view('orders.edit', compact('order', 'customers', 'products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required',
            'products' => 'required|array',
            'status' => 'required',
        ]);
        try {
            $order->update(['customer_id' => $request->customer_id,
                'status' => $request->status]);

            $order->products()->delete();

            for ($i = 0; $i < count($request->products); $i++) {
                $product = Product::find($request->products[$i]);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'discount' => $request->discount[$i],
                    'amount' => $request->amount[$i],
                ]);
            }
            return to_route('orders.index')->with('message', 'Order Update Succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('message', 'Order Deleted Succesfully');
    }
}
