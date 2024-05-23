<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId): View
{
    $images = ProductGallery::where('product_id',$productId)->get();
    // Retrieve the product data
    $product = Product::findOrFail($productId); // Assuming you have a Product model

    // Retrieve the gallery images associated with the product
    $images = ProductGallery::where('product_id', $productId)->get();

    return view('admin.product.gallery.index', compact('product', 'images'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'product_id' => ['required', 'integer']
        ]);

        $imagePath = $this-> uploadImage($request, 'image');

        $gallery = new ProductGallery();
        $gallery->product_id = $request->product_id;
        $gallery->image = $imagePath;
        $gallery->save();

        toastr()->success('Created Successfully!');

        return redirect()->back();

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $image = ProductGallery::findOrFail($id);
            $this->removeImage($image->image);
            $image->delete();

        return response()->json(['status' => 'success', 'message' => 'Deleted Successfully!']);
    } catch (\Exception $e) {
        // If an exception occurs (e.g., user not found), return an error response
        return response()->json(['status' => 'error', 'message' => 'something went wrong!']);
    }
}
}

