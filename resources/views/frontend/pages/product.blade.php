@extends('frontend.layouts.master')

@section('content')
<section class="fp__breadcrumb">
    <div class="fp__breadcrumb_overlay" style="width:1376px;">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>search result</h1>
                <ul></ul>
            </div>
        </div>
    </div>
</section>

<section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
    <div class="container">
        <form class="fp__search_menu_form" method="GET" action="{{ route('product.index') }}">
            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ @request()->search  }}"></div>
                <div class="col-md-4 col-xl-4"><select id="select_js3" name="category">
                        <option value="">All</option>
                        @foreach ($categories as $category)
                            <option @selected(@request()->category == $category->slug) value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-xl-2">
                    <button type="submit" class="btn btn-primary common_btn">Search</button>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-sm-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1s">
                <div class="fp__menu_item">
                    <div class="fp__menu_item_img">
                        <img class="img-fluid w-100" src="{{ asset($product->thumb_img) }}" alt="{{ $product->name }}">
                        <a class="category" href="#" style="color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;">{{@$product->category->name }}</a>
                    </div>
                    <div class="fp__menu_item_text">
                                <p class="rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><span>10</span></p>
                                <a class="title" href="{{ route('product.show', $product->slug) }}" style="color: rgb(0,0,0);">{{ $product->name }}</a>
                                <h5 class="price">
                                    ₱{{ $product->price }}</h5>
                                    <ul class="d-flex flex-wrap align-items-center" style="margin-left: 56px;">
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" style="background: rgb(150,103,49); display: inline-block; padding: 8px;"><i class="fas fa-shopping-basket" style="vertical-align: middle;"></i></a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" style="background: rgb(150,103,49); display: inline-block; padding: 8px;"><i class="fas fa-heart" style="vertical-align: middle;"></i></a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" style="background: rgb(150,103,49); display: inline-block; padding: 8px;"><i class="fas fa-eye" style="vertical-align: middle;"></i></a></li>
                                    </ul>
                            </div>
                </div>
            </div>
            @endforeach
        </div>

        @if (count($products) === 0)
        <h4 class="text-center mt-5">No Product Found!</h4>
        @endif
    </div>
</section>
