<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>TaskFlow | Task Manager</title>

<!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
:root{

--primary:
#4f46e5;

--secondary:
#7c3aed;

--dark:
#111827;

--light-bg:
#f4f7fb;

--border:
#e5e7eb;
        }

*{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

body{
        
        font-family: 'Inter', sans-serif;
        
        background:
        linear-gradient(
        180deg,
        #f8faff 0%,
        #f4f7fb 100%
        );
        
        color: #111827;
        
        min-height: 100vh;
        }

a{
        text-decoration: none;
        }

/* =========================
        NAVBAR
        ========================== */
        
        .modern-navbar{
        
        background:
        rgba(17,24,39,0.85);
        
        backdrop-filter:
        blur(12px);
        
        padding: 18px 0;
        
        border-bottom:
        1px solid rgba(255,255,255,0.08);
        
        position: sticky;
        
        top: 0;
        
        z-index: 999;
        
        }
        
        .brand-logo{
        
        display: flex;
        
        align-items: center;
        
        gap: 12px;
        
        font-size: 1.4rem;
        
        font-weight: 800;
        
        color: white !important;
        
        }
        
        .brand-icon{
        
        width: 45px;
        
        height: 45px;
        
        border-radius: 14px;
        
        display: flex;
        
        align-items: center;
        
        justify-content: center;
        
        background:
        linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
        );
        
        font-size: 20px;
        
        box-shadow:
        0 10px 25px rgba(79,70,229,0.35);
        
        }
        
        .nav-link{
        
        color: rgba(255,255,255,0.85) !important;
        
        font-weight: 500;
        
        padding: 10px 16px !important;
            border-radius: 12px;
transition: 0.3s ease;
        }

.nav-link:hover{
        
        background:
        rgba(255,255,255,0.08);
        
        color: white !important;
        }

/* =========================
        BUTTONS
        ========================== */

.btn-modern{

border: none;

border-radius: 14px;

padding: 11px 20px;

font-weight: 600;

transition: all 0.3s ease;

}

.btn-gradient{

background:
            linear-gradient(
            135deg,
            var(--primary),
            var(--secondary)
            );

color: white;

box-shadow:
            0 10px 25px rgba(79,70,229,0.25);

}

.btn-gradient:hover{

transform:
            translateY(-2px);

color: white;

box-shadow:
            0 15px 30px rgba(79,70,229,0.35);

}

/* =========================
        PAGE WRAPPER
        ========================== */

.page-wrapper{

padding-top: 40px;

padding-bottom: 60px;

min-height: calc(100vh - 160px);

}

/* =========================
        ALERTS
        ========================== */

.modern-alert{

border: none;

border-radius: 18px;

padding: 18px 22px;

font-weight: 500;

box-shadow:
            0 10px 25px rgba(0,0,0,0.05);

}

.alert-success{

background:
            rgba(34,197,94,0.12);

color: #15803d;

}

.alert-danger{

background:
            rgba(239,68,68,0.12);

color: #dc2626;

}

/* =========================
        DROPDOWN
        ========================== */

.dropdown-menu{

border: none;

border-radius: 18px;

padding: 10px;

box-shadow:
            0 15px 40px rgba(0,0,0,0.12);

}

.dropdown-item{

border-radius: 12px;

padding: 10px 14px;

font-weight: 500;

transition: 0.3s ease;

}

.dropdown-item:hover{

background: #f4f7fb;

}

/* =========================
        FOOTER
        ========================== */

.modern-footer{

background: #111827;

padding: 25px 0;

margin-top: 50px;

color: rgba(255,255,255,0.8);

border-top:
            1px solid rgba(255,255,255,0.05);

}

.footer-brand{

font-weight: 700;

color: white;

}

/* =========================
        SCROLLBAR
        ========================== */

::-webkit-scrollbar{
        width: 8px;
        }

::-webkit-scrollbar-thumb{

background:
            linear-gradient(
            var(--primary),
            var(--secondary)
            );

border-radius: 20px;

}

/* =========================
        RESPONSIVE
        ========================== */

@media(max-width: 768px){

.brand-logo{
            font-size: 1.1rem;
            }

.page-wrapper{
            padding-top: 25px;
            }

}

</style>

</head>

<body>

<!-- =========================
                NAVBAR
        ========================== -->

<nav class="navbar navbar-expand-lg modern-navbar">

        <div class="container">

<!-- LOGO -->
            <a href="{{ route('tasks.index') }}" class="navbar-brand brand-logo">

<div class="brand-icon">

<i class="bi bi-check2-square"></i>

</div>

TaskFlow

</a>

<!-- MOBILE TOGGLE -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

<i class="bi bi-list text-white fs-2"></i>

</button>

<!-- NAVIGATION -->
            <div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

<!-- TASKS -->
                    <li class="nav-item">

<a href="{{ route('tasks.index') }}" class="nav-link">

<i class="bi bi-list-task"></i>

Tasks

</a>

</li>

<!-- ADD TASK -->
                    <li class="nav-item">

<a href="{{ route('tasks.create') }}" class="btn btn-modern btn-gradient">

<i class="bi bi-plus-circle"></i>

Add Task

</a>

</li>

<!-- USER -->
                    <li class="nav-item dropdown">

<a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">

<i class="bi bi-person-circle fs-5"></i>
                            
                            {{ auth()->user()->name }}

</a>

<ul class="dropdown-menu dropdown-menu-end">

<li>

<div class="px-3 py-2">

<small class="text-muted">
                                        Logged in as
                                    </small>

<div class="fw-bold">
                                    
                                        {{ auth()->user()->name }}
                                    
                                    </div>
                                    
                                    </div>
                                    
                                    </li>
                                    
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    
                                    <li>
                                    
                                        <form method="POST" action="{{ route('logout') }}">
                                    
                                            @csrf
                                    
                                            <button class="dropdown-item text-danger">
                                    
                                                <i class="bi bi-box-arrow-right"></i>
                                    
                                                Logout
                                    
                                            </button>
                                    
                                        </form>
                                    
                                    </li>
                                    
                                    </ul>
                                    
                                    </li>
                                    
                                    </ul>
                                    
                                    </div>
</div>

</nav>
    
    <!-- =========================
                PAGE CONTENT
        ========================== -->
    
    <main class="page-wrapper">
    
        <div class="container">
    
            <!-- SUCCESS ALERT -->
            @if(session('success'))
    
            <div class="alert alert-success modern-alert alert-dismissible fade show mb-4">
    
                <div class="d-flex align-items-center gap-2">
    
                    <i class="bi bi-check-circle-fill"></i>
    
                    {{ session('success') }}
</div>

<button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
</div>
@endif

<!-- ERROR ALERT -->
@if($errors->any())

<div class="alert alert-danger modern-alert mb-4">

    <div class="fw-bold mb-2">

        <i class="bi bi-exclamation-triangle-fill"></i>

        Please fix the following errors:

</div>

<ul class="mb-0 ps-3">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif
            
            <!-- CONTENT -->
            @yield('content')
</div>

</main>
    
    <!-- =========================
                FOOTER
        ========================== -->
    
    <footer class="modern-footer">
    
        <div class="container">
    
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
    
                <div>
    
                    <div class="footer-brand">
    
                        TaskFlow
</div>

<small>
                        Smart task management system
                    </small>

</div>

<small>

© {{ date('Y') }}

All Rights Reserved

</small>

</div>

</div>

</footer>

<!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>