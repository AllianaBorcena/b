<section class="fp__menu mt_95 xs_mt_65">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 text-center m-auto">
                    <div class="fp__section_heading mb_45">
                        <h4 style="color: rgb(140,88,42);">food Menu</h4>
                        <h2>Our Popular Delicious Cakes</h2><span><img class="img-fluid w-100" src="assets/img/heading_shapes.png" alt="shapes"></span>
                        <p>Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.</p>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-12">
                    <div class="d-flex justify-content-center flex-wrap menu_filter">
                        <button class="active button-click" data-filter="*" style="background: #ffffff; border-color: rgb(140,88,42); color: rgb(140,88,42);">All</button>
                        @foreach ($categories as $category)
                        <button class="{{ $loop->index === 0 ? 'active button-click' : '' }}" data-filter=".{{ $category->slug }}" style="background: #ffffff; border-color: rgb(140,88,42); color: rgb(140,88,42);">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row grid">
                @foreach ($categories as $category)
                    @php
                        $products = \App\Models\Product::where(['show_at_home' => 1, 'status' => 1, 'category_id' => $category->id])
                            ->orderBy('id', 'DESC')
                            ->take(8)
                            ->get();

                    @endphp


                    @foreach ($products as $product)
                    <div class="col-sm-6 col-lg-4 col-xl-3 {{ $category->slug }} wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img"><img class="img-fluid w-100" src="{{ asset($product->thumb_img) }}" alt="{{ $product -> name}}">
                            <a class="category" href="#" style="color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;">{{@$product->category->name }}</a></div>
                            <div class="fp__menu_item_text">
                                <p class="rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><span>10</span></p>
                                <a class="title" href="{{ route('product.show', $product->slug) }}" style="color: rgb(0,0,0);">{{ $product->name }}</a>
                                <h5 class="price">
                                    ₱{{ $product->price }}</h5>
                                <ul class="d-flex flex-wrap" style="margin-left: 56px;">
                                    <li><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')" style="background: rgb(150,103,49);"><i class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" style="background: rgb(150,103,49);"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" style="background: rgb(150,103,49);"><i class="fas fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach

                @endforeach


        </div>
    </div>
</section>


