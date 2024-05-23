<button class="btn-close" aria-label="Close" data-bs-dismiss="modal" type="button"></button>

<form action="" id="modal_add_to_cart_form">
<input type="hidden" name="product_id" value="{{ $product->id }}">
<div class="fp__cart_popup_img">
    <img src="{{ asset($product->thumb_img) }}" alt="{{ $product->name }}" class="img-fluid w-100">
</div>
<div class="fp__cart_popup_text">
    <a class="title" href="{{ route('product.show', $product->slug) }}">{!! $product->name !!}</a>

    <h3 class="price">₱ {{ $product->price }} <del></del></h3>

    <input type="hidden" name="base_price" value="{{ $product->price }}">

    @if ($product->productIcing()->exists())
    <div class="details_size">
        <h5>Select Product Icing</h5>
        @foreach ($product->productIcing as $productIcing)
        <div class="form-check">
            <input class="form-check-input" data-price="{{ $productIcing->price }}" style="background-color: #8c582a;" type="radio" value="{{ $productIcing->id }}" name="product_icing" id="icing-{{ $productIcing->id }}">
            <label class="form-check-label" for="icing-{{ $productIcing->id }}">
                {{ $productIcing->name }} <span>+ ₱{{ $productIcing->price }}</span>
            </label>
        </div>
        @endforeach
    </div>
    @endif

    @if ($product->productOption()->exists())
    <div class="details_extra_item">
        <h5>Select Option <span>(optional)</span></h5>
        @foreach ($product->productOption as $productOption)
        <div class="form-check">
            <input class="form-check-input" name="product_option[]" data-price="{{ $productOption->price }}" type="checkbox" value="{{ $productOption->id }}" id="option-{{ $productOption->id }}" style="background-color: #8c582a;">
            <label class="form-check-label" for="option-{{ $productOption->id }}">
                {{ $productOption->name }} <span>+ ₱{{ $productOption->price }}</span>
            </label>
        </div>
        @endforeach
    </div>
    @endif

    <div class="details_quentity">
        <h5>Select Quantity</h5>
        <div class="quentity_btn_area d-flex flex-wrap align-items-center">
            <div class="quentity_btn">
                <button class="btn btn-danger decrement" type="button"><i class="fal fa-minus"></i></button>
                <input type="text" id="quantity" name="quantity" value="1" readonly>
                <button class="btn btn-success increment" type="button"><i class="fal fa-plus"></i></button>
            </div>
            <h3 id="total_price">₱{{ $product->price }}</h3>
        </div>
    </div>

    <ul class="d-flex flex-wrap details_button_area">
        <li><button type="submit" class="common_btn modal_cart_button">add to cart</button></li>
    </ul>
</div>

</form>

<script>
    $(document).ready(function(){
    // Call updateTotalPrice when inputs change
    $('input[name="product_icing"]').on('change', updateTotalPrice);
    $('input[name="product_option[]"]').on('change', updateTotalPrice);

    // Initialize total price on page load
    updateTotalPrice();

    $('.increment').on('click', function(e){
        e.preventDefault()

        let quantity = $('#quantity');
        let currentQuantity = parseFloat(quantity.val());
        quantity.val(currentQuantity + 1);
        updateTotalPrice()
    })


    $('.decrement').on('click', function(e){
        e.preventDefault()

        let quantity = $('#quantity');
        let currentQuantity = parseFloat(quantity.val());
        if(currentQuantity > 1){
            quantity.val(currentQuantity - 1);
            updateTotalPrice()
        }
    })

    function updateTotalPrice() {
        let basePrice = parseFloat($('input[name="base_price"]').val());
        let selectedIcingPrice = 0;
        let selectedOptionsPrice = 0;
        let quantity = parseFloat($('#quantity').val());

        let selectedIcing = $('input[name="product_icing"]:checked');
        if (selectedIcing.length > 0) {
            selectedIcingPrice = parseFloat(selectedIcing.data("price"));
        }

        let selectedOptions = $('input[name="product_option[]"]:checked');
        selectedOptions.each(function(){
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

    $("#modal_add_to_cart_form").on('submit', function(e){
        e.preventDefault();

        let selectedIcing = $("input[name='product_icing']");
        if(selectedIcing.length > 0){
            if($("input[name='product_icing']:checked").val() === undefined){
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
            beforeSend: function(){
                $('.modal_cart_button').attr('disabled', true);
                $('.modal_cart_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...')
            },
            success: function(response){
                updateSidebarCart();
                toastr.success(response.message);
            },
            error: function(xhr, status, error){
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
            complete: function(){
                $('.modal_cart_button').html('Add to Cart');
                $('.modal_cart_button').attr('disabled', false);
            }
        })
    })
});
</script>
