<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Tested Recruits">
  <title> @yield('title') | {{ Config::get('app.name') }} </title>

  <!-- Scripts -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- bootstrap icon  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  @yield('styles')
</head>

<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('all-task') }}">{{ __('Home') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('all-task') }}">{{ __('View All Tasks') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('show-add-task') }}">{{ __('Add a Task') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<main class="py-2 container ">
  @yield('content')
</main>
</div>
<footer style="position: absolute; bottom: 0; width: 100%;">
  <p class="text-center"> &copy; @php echo date('Y')@endphp Tested Recruits | All Rights Reserved.</p>
</footer>

@yield('scripts')
<!-- JavaScript Bundle with Popper -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
</body>