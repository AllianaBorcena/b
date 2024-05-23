{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('frontend.layouts.master')

@section('content')
<section class="fp__breadcrumb" style="background:url(assets/img/counter_bg.jpg);">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>reset password</h1>
            </div>
        </div>
    </div>
</section>
<section class="fp__signin" style="background:url(assets/img/login_bg.jpg);">
    <div class="fp__signin_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-9 col-lg-7 col-xl-6 col-xxl-5 m-auto">
                    <div class="fp__login_area">
                        <h2>Reset Password</h2>
                        <p>Enter email and new password</p>
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <div class="row">
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="col-xl-12">
                                    <div class="fp__login_imput"><label class="form-label">email</label><input type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Email"></div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="fp__login_imput"><label class="form-label">password</label><input type="password" name="password" placeholder="Password"></div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="fp__login_imput"><label class="form-label">confirm password</label><input type="password" name="password_confirmation" placeholder="Password"></div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="fp__login_imput"><button type="submit" class="common_btn">Reset Password</button></div>
                                </div>
                            </div>
                        </form>
                        <p class="d-flex justify-content-between create_account"><a href="{{ route('login') }}">login</a><a href="{{ route('register') }}">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
