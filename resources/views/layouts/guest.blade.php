<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" /> <!-- Poppins font -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-image: url('{{ asset('images/Teknik.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* Overlay untuk background */
            .bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1;
            }

            /* Header text di atas background */
            .header-text {
                font-family: 'Poppins', sans-serif;
                font-size: 36px;
                font-weight: 600;
                color: white;
                text-align: center;
                margin-bottom: 20px;
                z-index: 2;
                position: absolute;
                top: 10%;
                width: 100%;
            }

            /* Form container */
            .login-form-container {
                position: relative;
                z-index: 3;
                width: 100%;
                max-width: 400px;
                background-color: white;
                padding: 1.2rem;
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                text-align: center;
                margin-top: 40px;
            }

            .logo-img {
                max-width: 120px;
                height: auto;
                display: block;
                margin: 0 auto 15px auto;
            }

            /* Styling form inputs and button */
            .login-form-container .x-text-input,
            .login-form-container .x-primary-button {
                width: 100%;
                padding: 10px; /* Mengurangi padding untuk membuat input lebih kompak */
                margin-top: 5px; /* Mengurangi jarak antar elemen form */
            }

            /* Menyusun label ke kiri */
            .login-form-container label {
                text-align: left;
                display: block;
                margin-bottom: 4px; /* Mengurangi margin antara label dan input */
                font-size: 14px;
                font-weight: 500;
            }

            .login-form-container .x-text-input {
                width: 100%;
                padding: 10px;
                margin-bottom: 6px; /* Mengurangi jarak antar input */
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            }

            /* Button styling */
            .login-form-container .x-primary-button {
                width: 100%;
                padding: 12px;
                background-color: #4CAF50;
                color: white;
                font-size: 14px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .login-form-container .x-primary-button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Overlay untuk background gelap -->
        <div class="bg-overlay"></div>

        <!-- Header Text di atas background -->
        <div class="header-text">
            SISTEM INFORMASI PRAKTIKUM INFORMATIKA <br> UNIVERSITAS BENGKULU
        </div>

        <!-- Form Login Section -->
        <div class="login-form-container">
            <!-- Logo UNIB di dalam form -->
            <a href="/">
                <img src="{{ asset('images/logo-unib.png') }}" alt="Logo UNIB" class="logo-img">
            </a>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" class="x-text-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" class="x-text-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </body>
</html>
