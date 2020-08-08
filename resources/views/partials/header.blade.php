<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @guest
            <title>{{ config('app.name', 'Laravel') }}</title>
        @else
            <title>@section('title') | {{ config('app.name', 'Laravel') }}</title>
        @endguest
        <!-- Fonts -->
        <link href={{ asset('/css/base.css') }} rel="stylesheet">
        @stack('any-styles')
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900&display=swap&subset=cyrillic" rel="stylesheet">
    </head>
    <body>