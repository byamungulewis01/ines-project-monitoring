<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index');
    }
    public function products()
    {
        //
        $collection = Product::orderByDesc('id')->get();
        return ProductResource::collection($collection);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:products,title',
            'description' => 'required',
            'short_description' => 'required|max:100',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'required',
        ]);
        try {
            Product::create($request->all());
            return to_route('products.index')->with('message', 'Product Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::findorfail($id);
        return view('products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|unique:products,title,' . $id,
            'description' => 'required',
            'short_description' => 'required|max:100',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'required',
        ]);
        try {
            Product::findorfail($id)->update($request->all());
            return to_route('products.index')->with('message', 'Product Updated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::findorfail($id)->delete();
            return back()->with('message', 'Product Deleted Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
