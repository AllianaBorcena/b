<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductIcing;
use App\Models\ProductOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductIcingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId) : View
    {
        $product = Product::findOrFail($productId);
        $icings=ProductIcing::where('product_id', $product->id)->get();
        $options= ProductOption::where('product_id', $product->id)->get();
        return view('admin.product.product-icing.index', compact('product', 'icings', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request -> validate ([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'integer']
        ]);

        $icing = new ProductIcing();

        $icing->product_id = $request->product_id;
        $icing->name = $request->name;
        $icing->price = $request->price;
        $icing->save();

        toastr()->success('Created Successfully');

        return redirect() ->back();

    }

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    try {
        $image = ProductIcing::findOrFail($id);
        $image->delete();

        return response()->json(['status' => 'success', 'message' => 'Deleted Successfully!']);
    } catch (\Exception $e) {
        // If an exception occurs, return an error response with exception message
        return response()->json(['status' => 'error', 'message' => 'something went wrong!']);
    }
}
}


