<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Tested Recruits">
  <title> @yield('title') | {{ Config::get('app.name') }} </title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
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
          <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.index') }}">{{ __('View all Projects') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<main class="py-2 container">
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif

  @yield('content')
</main>
</div>
<footer style="position: absolute; bottom: 0; width: 100%;">
  <p class="text-center"> &copy; @php echo date('Y')@endphp {{ __('Tested Recruits | All Rights Reserved.') }}</p>
</footer>

@yield('scripts')
</body>