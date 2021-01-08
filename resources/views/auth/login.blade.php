@extends('layouts.app')

@push('any-styles')
    <link href={{ asset('/css/login.css') }} rel="stylesheet">
@endpush

@section('content')
    <section class="header">
        <div class="container">
            <div class="header-content">
                <div class="header-content_text">
                    <h1>Календарь <br> <span class="fs-sm">учета произведений</span></h1>
                    <div class="form-title">Подтвердить членство</div>
                    <form id="sign_in" method="POST" action="{{ route('login') }}">
                        @csrf
                        <label>
                            <input type="email" name="email">
                            <span class="placeholder">Ваше email</span>
                        </label>
                        <label>
                            <input type="password" name="password">
                            <span class="placeholder">Ваш пароль</span>
                        </label>
                        @error('email')
                            <div class="error" role="alert">
                                {{ $message }}
                            </div>
                            <script>
                            var errorText = document.querySelector('form .error');
                            setTimeout(()=>{
                                errorText.classList.add('show');
                            }, 100)
                            </script>
                        @enderror
                        <div class="flex align-center justify-between">
                            <button type="submit">Войти</button>
                            @if (Route::has('password.request'))
                                <a class="cl-white fgt-pass" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="header-bg">
            <div class="header-bg__church"><img src="{{ asset('/image/bg-home.png') }}" class="header-bg__image"></div>
            <div class="header-bg__cloud"><img src="{{ asset('/image/heaven.png') }}" class="header-bg__image"></div>
        </div>
    </section>

@endsection
