<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CartController extends Controller
{
    function index() : View {
        return view('frontend.pages.cart-view');
    }

    function addToCart(Request $request)
    {
        try {
            $product = Product::with(['productIcing', 'productOption'])->findOrFail($request->product_id);
            $productIcing = $product->productIcing->where('id', $request->product_icing)->first();
            $productOption = $product->productOption->whereIn('id', $request->product_option);


            $options = [
                'product_icing' => [],
                'product_options' => [],
                'product_info' => [
                    'image' => $product->thumb_img,
                    'slug' => $product->slug
                ]
            ];

            if ($productIcing !== null) {
                $options['product_icing'] = [
                    'id' => $productIcing?->id,
                    'name' => $productIcing?->name,
                    'price' => $productIcing?->price
                ];
            }

            foreach ($productOption as $option) {
                $options['product_options'][] = [
                    'id' => $option->id,
                    'name' => $option->name,
                    'price' => $option->price
                ];
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->price,
                'weight' => 0,
                'options' => $options
            ]);

            return response(['status' => 'success', 'message' => 'Product Added into the Cart'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }

    function getCartProduct() {
        return view('frontend.layouts.ajax-files.sidebar-cart-item')->render();
    }

    function cartProductRemove($rowId) {
        try {
            Cart::remove($rowId);
            return response(['status' => 'success', 'message' => 'Item has been removed'], 200);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }

    function cartQtyUpdate(Request $request) : Response {
        try{
            Cart::update($request->rowId, $request->qty);
            return response(['product_total' => productTotal($request->rowId)], 200);
        }catch(\Exception $e){
            logger($e);
            return response(['status' => 'error', 'message' => 'Something went wrong please reload the page'], 500);
        }

    }

    function cartDestroy() {
        Cart::destroy();
        return redirect()->back();
    }
}
