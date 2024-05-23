@extends('frontend.layouts.master')

@section('content')
    <section class="fp__breadcrumb" style="background:url(assets/img/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="fp__pro_img"> Image </td>
                                        <td class="fp__pro_name"> details </td>
                                        <td class="fp__pro_status"> price </td>
                                        <td class="fp__pro_select"> quantity </td>
                                        <td class="fp__pro_tk"> total </td>
                                        <td class="fp__pro_icon"><a class="clear_all" href="{{ route('cart.destroy') }}">clear all</a></td>
                                    </tr>
                                    @foreach (Cart::content() as $product)
                                        <tr>
                                            <td class="fp__pro_img"><img class="img-fluid w-100" alt="product"
                                                    src="{{ $product->options->product_info['image'] }}"></td>
                                            <td class="fp__pro_name">
                                                <a
                                                    href="{{ route('product.show', $product->options->product_info['slug']) }}">{{ $product->name }}</a>
                                                <span>{{ @$product->options->product_icing['name'] }}
                                                    (P{{ @$product->options->product_icing['price'] }})</span>
                                                @foreach ($product->options->product_options as $option)
                                                    <p>{{ $option['name'] }} (P{{ $option['price'] }})</p>
                                                @endforeach

                                            </td>
                                            <td class="fp__pro_status">
                                                <h6>P{{ $product->price }}</h6>
                                            </td>
                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"><i
                                                            class="fal fa-minus"></i></button>
                                                            <input placeholder="1" class="quantity" data-id="{{ $product->rowId }}" value="{{ $product->qty }}" readonly
                                                        type="text"><button class="btn btn-success increment"><i
                                                            class="fal fa-plus"></i></button></div>
                                            </td>
                                            <td class="fp__pro_tk">
                                                <h6 class="product_cart_total">P{{ productTotal($product->rowId) }}</h6>
                                            </td>
                                            <td class="fp__pro_icon"><a href="#" class="remove_cart_product" data-id="{{ $product->rowId }}"><i class="far fa-times"></i></td>
                                        </tr>
                                    @endforeach
                                    @if (Cart::content()->count() === 0)
                                        <tr>
                                            <td colspan="6" class="text-center fp_pro_name" style="width: 100%; display: inline;">Cart is empty</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span><span>$134.00</span></p>
                        <form><input type="text" placeholder="Coupon Code"><button type="submit">apply</button></form>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.increment').on('click', function(){
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");

                inputField.val(currentValue + 1);
                cartQtyUpdate(rowId, inputField.val(), function(response){
                    let productTotal = response.product_total;
                    inputField.closest("tr")
                    .find(".product_cart_total")
                    .text( (":productTotal")
                    .replace(":productTotal", productTotal));
                });
            });

            $('.decrement').on('click', function(){
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                if(inputField.val() > 1) {
                    inputField.val(currentValue - 1);

                    cartQtyUpdate(rowId, inputField.val(), function(response){
                    let productTotal = response.product_total;
                    inputField.closest("tr")
                    .find(".product_cart_total")
                    .text( (":productTotal")
                    .replace(":productTotal", productTotal));
                });
                }
            });

            function cartQtyUpdate(rowId, qty, callback){
                $.ajax({
                    method: 'POST',
                    url: '{{ route("cart.quantity-update") }}',
                    data: {
                        'rowId': rowId,
                        'qty' : qty
                    },
                    beforeSend: function(){
                        showLoader();
                    },
                    success: function(response){
                        if(callback && typeof callback === 'function'){
                            callback(response);
                        }
                    },
                    error: function(xhr, status, error){
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function(){
                        hideLoader();
                    }
                })
            }

            $('.remove_cart_product').on('click', function(e){
                e.preventDefault();
                let rowId = $(this).data('id');
                removeCartProduct(rowId);
                $(this).closest('tr').remove();
            })

            function removeCartProduct(rowId){
                $.ajax({
                    method: 'GET',
                    url: '{{ route("cart-product-remove", ":rowId") }}'.replace(":rowId", rowId),
                    beforeSend: function(){
                        showLoader();
                    },
                    success: function(response){
                        updateSidebarCart();
                    },
                    error: function(xhr, status, error){
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function(){
                        hideLoader();
                    }
                })
            }
        })
    </script>
@endpush