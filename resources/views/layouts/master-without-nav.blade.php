<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | Hino Motors - Admin Karoseri</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="Hino Motors" name="Fauziyyan Thafhan Rahman" />
        <meta content="-" name="description" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

        @include('layouts.head-css')
  </head>

    @yield('body')
    
    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>