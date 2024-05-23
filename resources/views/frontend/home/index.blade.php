@extends('frontend.layouts.master')

@section('content')

@include('frontend.home.components.slider')

@include('frontend.home.components.whychoose', ['sectionTitles' => $sectionTitles]) {{-- Include Why Choose Us component --}}

{{-- Other components --}}
@include('frontend.home.components.menu')
@include('frontend.home.components.download')
@include('frontend.home.components.testimonial')

@endsection
