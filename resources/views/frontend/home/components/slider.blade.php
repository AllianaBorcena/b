<section class="fp__banner">
    <div class="fp__banner_overlay">
        <div class="row banner_slider">
            @foreach($sliders as $slider)
                <div class="col-12">
                    <div class="fp__banner_slider">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 col-lg-5 col-xl-5">
                                    <div class="fp__banner_img wow fadeInLeft" data-wow-duration="1s" style="border-radius:5%;">
                                        <div class="img" style="border-radius:5%;">
                                            <img class="img-fluid w-100" alt="Slider Image" src="{{ asset($slider->image) }}" style="border-radius:5%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-6 col-xl-5">
                                    <div class="fp__banner_text wow fadeInRight" data-wow-duration="1s">
                                        <h1>{{ $slider->title }}</h1>
                                        <h3>{{ $slider->sub_title }}</h3>
                                        <p>{{ $slider->description }}</p>
                                        @if($slider->offer)
                                            <p><strong>{{ $slider->offer }}</strong></p>
                                        @endif
                                        @if($slider->short_description)
                                            <p>{{ $slider->short_description }}</p>
                                        @endif
                                        @if($slider->button_link)
                                            <ul class="d-flex flex-wrap">
                                                <li><a class="common_btn" href="{{ $slider->button_link }}">Order Now</a></li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


