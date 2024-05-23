<nav class="navbar navbar-expand-lg main_menu">
    <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img class="img-fluid"
                src="{{ asset('frontend/img/logo.png') }}" alt="Bien By Tracy"></a><button data-bs-toggle="collapse"
            data-bs-target="#navbarNav" class="navbar-toggler" type="button" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation"><i class="far fa-bars"
                style="font-family:'Font Awesome 5 Brands';"></i></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('product.index') }}">Order Cakes Here</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html">contact Us</a></li>
            </ul>
            <ul class="d-flex flex-wrap menu_icon">
                <li><a class="menu_search" href="#"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form><span class="close_search"><i class="far fa-times"></i></span><input type="text"
                                placeholder="Search . . ."><button type="submit">search</button></form>
                    </div>
                </li>
                <li><a class="cart_icon"><i class="fas fa-shopping-basket"></i><span class="cart_count">{{ count(Cart::content()) }}</span></a></li>
                <li><i class="fas fa-user"></i></li>
                <li></li>
            </ul>
        </div>
    </div>
</nav>

<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (<span class="cart_count" style="font-size: 16px">{{ count(Cart::content()) }}</span>)</h5><span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cart_contents">
            @foreach (Cart::content() as $cartProduct)
                <li>
                    <div class="menu_cart_img"><img class="img-fluid w-100" src="{{ asset($cartProduct->options->product_info['image']) }}" alt="menu">
                    </div>
                    <div class="menu_cart_text">
                        <a class="title" href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!} </a>
                        <p class="size">Qty: {{ $cartProduct->qty }}</p>
                        <p class="size">{{ @$cartProduct->options->product_icing['name'] }} (P{{ @$cartProduct->options->product_icing['price'] }})</p>

                        @foreach ($cartProduct->options->product_options as $cartProductOption)
                        <span class="extra">{{ $cartProductOption['name'] }} (P{{ $cartProductOption['price'] }})</span>
                        @endforeach

                        <p class="price">P {{ $cartProduct->price }}</p>
                    </div>
                    <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i class="fal fa-times"></i></span>
                </li>
            @endforeach

        </ul>
        <p class="subtotal">sub total <span class="cart_subtotal">P{{ cartTotal() }}</span></p>
        <a class="cart_view" href="{{ route('cart.index') }}">view cart</a>
        <a class="checkout" href="check_out.html">checkout</a>
    </div>
</div>
