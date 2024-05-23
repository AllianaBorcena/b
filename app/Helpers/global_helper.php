<?php


/**Slug */

use Gloudemans\Shoppingcart\Facades\Cart;

if(!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($model, $name): string
    {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Model $model not found.");
        }

        $slug = \Str::slug($name);
        $count = 2;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = \Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

if(!function_exists('cartTotal')){
    function cartTotal()
    {
        $total = 0;

        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $icingPrice = $item->options?->product_icing['price'] ?? 0;
            $optionsPrice = 0;
            foreach($item->options->product_options as $option){
                $optionsPrice += $option['price'];
            }

            $total += ($productPrice + $icingPrice + $optionsPrice) * $item->qty;
        }

        return $total;
    }
}

if(!function_exists('productTotal')){
    function productTotal($rowId)
    {
        $total = 0;
            $product = Cart::get($rowId);

            $productPrice = $product->price;
            $icingPrice = $product->options?->product_icing['price'] ?? 0;
            $optionsPrice = 0;
            foreach($product->options->product_options as $option){
                $optionsPrice += $option['price'];
            }

            $total += ($productPrice + $icingPrice + $optionsPrice) * $product->qty;

        return $total;
    }
}
