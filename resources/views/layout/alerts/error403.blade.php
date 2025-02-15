<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('assets/css/error404.css') !!}">
    <title>{{ config('app.name') }} | Error 403</title>
    <!-- Favicon -->
    <link href="{!! asset('assets/logo.png') !!}" rel="icon">
</head>
<body>
    <div class="container">
        <button class="button" data-text="Awesome">
          <span class="actual-text"> Acceso Denegado 403</span>
          <a href="{{url('/inicio')}}" aria-hidden="true" class="hover-text">  </a>
        </button>         
  </div>
</body>
</html>
