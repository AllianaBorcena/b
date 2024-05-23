@extends('frontend.layouts.master')

@section('content')
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Menu Details</h1>
                    <ul>
                        <li><a href="{{ url('/') }}" style="color: black;">Home</a></li>
                        <li><a href="javascript:;" style="color: black;">Menu Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="fp__menu_details mt_115 xs_mt_85 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box fp__menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_img) }}" alt="product">
                                </li>

                                @foreach ($product->productImages as $image)
                                    <li><img class="zoom ing-fluid w-100" src="{{ asset($image->image) }}" alt="product">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i>
                            </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_details_text">
                        <h2>{!! $product->name !!}</h2>
                        <p class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                            <span>(201)</span>
                        </p>
                        <h3 class="price">₱ {{ $product->price }}
                            <del></del>
                        </h3>
                        <p class="short_description">{!! $product->short_description !!}</p>

                        <form action="" id="v_add_to_cart_form">
                            @csrf
                            <input type="hidden" name="base_price" class="v_base_price"
                                value="{{ $product->price > 0 ? $product->price : $product_price }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            @if ($product->productIcing()->exists())
                                <div class="details_size">
                                    <h5>Select Icing</h5>

                                    @foreach ($product->productIcing as $productIcing)
                                        <div class="form-check">
                                            <input class="form-check-input v_product_icing" type="radio"
                                                name="product_icing" id="icing-{{ $productIcing->id }}"
                                                data-price="{{ $productIcing->price }}" value="{{ $productIcing->id }}"
                                                style="appearance: none; width: 20px; height: 20px; border: 2px solid #8c582a; border-radius: 50%; outline: none; margin-right: 5px; background-color: #8c582a;">
                                            <label class="form-check-label" for="icing-{{ $productIcing->id }}">
                                                {{ $productIcing->name }} <span> + ₱ {{ $productIcing->price }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if ($product->productOption()->exists())
                                <div class="details_extra_item">
                                    <h5>select option <span>(optional)</span></h5>
                                    @foreach ($product->productOption as $productOption)
                                        <div class="form-check">
                                            <input class="form-check-input v_product_option" name="product_option[]"
                                                type="checkbox" value="{{ $productOption->id }}" id="option-{{ $productOption->id }}"
                                                data-price="{{ $productOption->price }}"
                                                style="background-color: #8c582a;">
                                            <label class="form-check-label" for="option-{{ $productOption->id }}">
                                                {{ $productOption->name }} <span>+ ₱ {{ $productOption->price }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="details_quentity">
                                <h5>select Quantity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger v_decrement"><i class="fal fa-minus"></i></button>
                                        <input type="text" name="quantity" placeholder="1" value="1" readonly
                                            id="v_quantity">
                                        <button class="btn btn-success v_increment"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3 id="total_price">₱{{ $product->price > 0 ? $product->price : $product_price }}</h3>
                                </div>
                            </div>
                        </form>



                        <ul class="details_button_area d-flex flex-wrap">
                            <li><a class="common_btn v_submit_button" href="#">add to cart</a></li>
                            <li><a class="wishlist" href="#"><i class="far fa-heart"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"
                                    style="background-color: rgb(150,103,49); color: #000000;">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false"
                                    style="background-color: rgb(150,103,49); color: #110707;">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="menu_det_description">
                                    {!! $product->long_description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="fp__review_area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>04 reviews</h4>
                                            <div class="fp__comment pt-0 mt_20">
                                                <div class="fp__single_comment m-0 border-0">
                                                    <img src="images/comment_img_1.png" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>Michel Holder <span>29 oct 2022 </span></h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/chef_1.jpg" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>salina khan <span>29 oct 2022 </span></h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/comment_img_2.png" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>Mouna Sthesia <span>29 oct 2022 </span></h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/chef_3.jpg" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>marjan janifar <span>29 oct 2022 </span></h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                    </div>
                                                </div>
                                                <a href="#" class="load_more">load More</a>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fp__post_review">
                                                <h4>write a Review</h4>
                                                <form>
                                                    <p class="rating">
                                                        <span>select your rating : </span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <input type="text" placeholder="Name">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <input type="email" placeholder="Email">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <textarea rows="3" placeholder="Write your review"></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($relatedProducts) > 0)
                            <div class="fp__related_menu mt_90 xs_mt_60">
                                <h2>related item</h2>
                                <div class="row related_product_slider">
                                    @foreach ($relatedProducts as $relatedProduct)
                                        <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                                            <div class="fp__menu_item">
                                                <div class="fp__menu_item_img">
                                                    <img class="img-fluid w-100"
                                                        src="{{ asset($relatedProduct->thumb_img) }}"
                                                        alt="{{ $relatedProduct->name }}">
                                                    <a class="category" href="#"
                                                        style="color: rgb(0,0,0);font-weight: bold;font-family: 'Open Sans', sans-serif;">{{ @$relatedProduct->category->name }}</a>
                                                </div>
                                                <div class="fp__menu_item_text">
                                                    <p class="rating"><i class="fas fa-star"></i><i
                                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                            class="fas fa-star-half-alt"></i><i
                                                            class="far fa-star"></i><span>514</span></p>
                                                    <a class="title"
                                                        href="{{ route('product.show', $relatedProduct->slug) }}"
                                                        style="color: rgb(0,0,0);">{!! $relatedProduct->name !!}</a>
                                                    <ul class="d-flex flex-wrap" style="margin-left: 56px;">
                                                        <li><a href="javascript:;" onclick="loadProductModal('{{ $relatedProduct->id }}')" style="background: rgb(150,103,49);"><i class="fas fa-shopping-basket"></i></a></li>
                                                        <li><a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#cartModal"
                                                                style="background: rgb(150,103,49);"><i
                                                                    class="fas fa-heart"></i></a></li>
                                                        <li><a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#cartModal"
                                                                style="background: rgb(150,103,49);"><i
                                                                    class="fas fa-eye"></i></a></li>
                                                    </ul>
                                                    <h5 class="price">₱ {{ $relatedProduct->price }}</h5>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif



    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.v_product_icing').prop('checked', false);
            $('.v_product_option').prop('checked', false);
            $('#v_quantity').val(1);

            $('.v_product_icing').on('change', function() {
                v_updateTotalPrice();
            });
            $('.v_product_option').on('change', function() {
                v_updateTotalPrice();
            });

            $('.v_increment').on('click', function(e) {
                e.preventDefault()

                let quantity = $('#v_quantity');
                let currentQuantity = parseFloat(quantity.val());
                quantity.val(currentQuantity + 1);
                v_updateTotalPrice()
            })


            $('.v_decrement').on('click', function(e) {
                e.preventDefault()

                let quantity = $('#v_quantity');
                let currentQuantity = parseFloat(quantity.val());
                if (currentQuantity > 1) {
                    quantity.val(currentQuantity - 1);
                    v_updateTotalPrice()
                }
            })

            function v_updateTotalPrice() {
                let basePrice = parseFloat($('.v_base_price').val());
                let selectedIcingPrice = 0;
                let selectedOptionsPrice = 0;
                let quantity = parseFloat($('#v_quantity').val());

                let selectedIcing = $('.v_product_icing:checked');
                if (selectedIcing.length > 0) {
                    selectedIcingPrice = parseFloat(selectedIcing.data("price"));
                }

                let selectedOptions = $('.v_product_option:checked');
                selectedOptions.each(function() {
                    selectedOptionsPrice += parseFloat($(this).data("price"));
                });



                let totalPrice = (basePrice + selectedIcingPrice + selectedOptionsPrice) * quantity;
                $('#total_price').text("₱" + totalPrice.toFixed(2));

                // Debugging output
                console.log("Base Price: ", basePrice);
                console.log("Selected Icing Price: ", selectedIcingPrice);
                console.log("Selected Options Price: ", selectedOptionsPrice);
                console.log("Total Price: ", totalPrice);
            }

            $('.v_submit_button').on('click', function(e){
                e.preventDefault();
                $("#v_add_to_cart_form").submit();
            })
            $("#v_add_to_cart_form").on('submit', function(e) {
                e.preventDefault();

                let selectedIcing = $(".v_product_icing");
                if (selectedIcing.length > 0) {
                    if ($(".v_product_icing:checked").val() === undefined) {
                        toastr.error('Please select an icing');
                        console.error('Please select an icing');
                        return;
                    }
                }


                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '{{ route("add-to-cart") }}',
                    data: formData,
                    beforeSend: function() {
                        $('.v_submit_button').attr('disabled', true);
                        $('.v_submit_button').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                            )
                    },
                    success: function(response) {
                        updateSidebarCart();
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        $('.v_submit_button').html('Add to Cart');
                        $('.v_submit_button').attr('disabled', false);
                    }
                })
            })
        })
    </script>
@endpush
