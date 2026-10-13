<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | School Appointment System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark app-navbar">
    <div class="container app-navbar-inner">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <span class="brand-mark" aria-hidden="true">S</span>
            <span class="brand-copy">
                <strong>Stillwater</strong>
                <small>Student care &amp; appointments</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto app-nav-links">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}"
                       href="{{ route('students.index') }}" @if (request()->routeIs('students.*')) aria-current="page" @endif>
                        Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('counselors.*') ? 'active' : '' }}"
                       href="{{ route('counselors.index') }}" @if (request()->routeIs('counselors.*')) aria-current="page" @endif>
                        Counselors
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                       href="{{ route('appointments.index') }}" @if (request()->routeIs('appointments.*')) aria-current="page" @endif>
                        Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('counseling-records.*') ? 'active' : '' }}"
                       href="{{ route('counseling-records.index') }}" @if (request()->routeIs('counseling-records.*')) aria-current="page" @endif>
                        Counseling Records
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('referrals.*') ? 'active' : '' }}"
                       href="{{ route('referrals.index') }}" @if (request()->routeIs('referrals.*')) aria-current="page" @endif>
                        Referrals
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container app-main">
    <header class="page-intro">
        <div>
            <p class="page-eyebrow">@yield('page-kicker', 'A thoughtful space for student support')</p>
            <h1>@yield('page-heading', 'Dashboard')</h1>
            @hasSection('page-subtitle')
                <p class="page-subtitle">@yield('page-subtitle')</p>
            @endif
        </div>
        <span class="intro-ornament" aria-hidden="true"></span>
    </header>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="app-footer">
    <div class="container">
        <span>&copy; {{ date('Y') }} Stillwater</span>
        <span>Care grows with connection.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>