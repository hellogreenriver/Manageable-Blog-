<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>example</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Google fonts-->
        <link href="{{ asset('https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700')}}" rel="stylesheet" />
        <link href="{{ asset('https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic') }}" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/app.js') }}" defer></script>
</head>
 
<body id="page-top">

        
      
        <!-- vue router-->
        <div id="app" >
            <my-app></my-app>
        </div>

        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
</body>
 
</html>