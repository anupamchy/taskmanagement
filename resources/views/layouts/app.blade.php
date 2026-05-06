<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar {
            padding: 15px 0;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .table thead {
            background: #212529;
            color: #fff;
        }

        .upload-box {
            border: 2px dashed #ced4da;
            border-radius: 12px;
            padding: 30px;
            background: #fff;
            text-align: center;
            transition: 0.3s;
        }

        .upload-box:hover {
            border-color: #0d6efd;
            background: #f8fbff;
        }

        .preview-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

        <div class="container">

            <!-- LOGO -->
            <a href="{{ route('tasks.index') }}" class="navbar-brand fw-bold fs-4">

                <i class="bi bi-check2-square"></i>
                Task Manager

            </a>

            <!-- MOBILE BUTTON -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- NAVIGATION -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <!-- TASK LIST -->
                    <li class="nav-item me-2">

                        <a href="{{ route('tasks.index') }}" class="nav-link">

                            <i class="bi bi-list-task"></i>
                            Tasks

                        </a>

                    </li>

                    <!-- CREATE TASK -->
                    <li class="nav-item me-3">

                        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">

                            <i class="bi bi-plus-circle"></i>
                            Add Task

                        </a>

                    </li>

                    <!-- USER DROPDOWN -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">



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

    <!-- MAIN CONTENT -->
    <div class="container py-4">

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>

        </div>

        @endif

        <!-- ERROR MESSAGE -->
        @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <!-- PAGE CONTENT -->
        @yield('content')

    </div>

    {{--
    <!-- FILE UPLOAD SECTION -->
    <div class="container mb-5">

        <div class="card shadow-sm">

            <div class="card-body">

                <h4 class="mb-4">

                    <i class="bi bi-cloud-upload"></i>
                    Multiple File Upload

                </h4>

                <!-- UPLOAD AREA -->
                <div class="upload-box">

                    <input type="file" id="files" multiple class="form-control">

                    <small class="text-muted d-block mt-2">

                        Upload JPG, PNG, PDF files

                    </small>

                </div>

                <!-- LOADER -->
                <div id="uploadLoader" class="mt-3 text-primary d-none">

                    Uploading files...

                </div>

                <!-- PREVIEW -->
                <div id="preview" class="row mt-4 g-4">

                </div>

            </div>

        </div>

    </div> --}}

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-5">

        <div class="container">

            <small>

                © {{ date('Y') }}
                Task Manager Application

            </small>

        </div>

    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX FILE UPLOAD -->
    <script>
        document
        .getElementById('files')
        .addEventListener('change', function () {

            let files = this.files;

            let formData = new FormData();

            for (let file of files) {

                formData.append('files[]', file);

            }

            document
            .getElementById('uploadLoader')
            .classList.remove('d-none');

            fetch("{{ route('upload.files') }}", {

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },

                body: formData

            })

            .then(response => response.json())

            .then(data => {

                document
                .getElementById('uploadLoader')
                .classList.add('d-none');

                let preview =
                document.getElementById('preview');

                preview.innerHTML = '';

                data.forEach(file => {

                    let html = '';

                    // PDF
                    if (file.path.includes('.pdf')) {

                        html = `
                            <div class="col-md-3">

                                <div class="card shadow-sm">

                                    <iframe
                                        src="${file.path}"
                                        width="100%"
                                        height="220">
                                    </iframe>

                                    <div class="card-body text-center">

                                        <small>
                                            ${file.name}
                                        </small>

                                    </div>

                                </div>

                            </div>
                        `;

                    } else {

                        // IMAGE
                        html = `
                            <div class="col-md-3">

                                <div class="card shadow-sm">

                                    <img src="${file.path}"
                                         class="preview-image">

                                    <div class="card-body text-center">

                                        <small>
                                            ${file.name}
                                        </small>

                                    </div>

                                </div>

                            </div>
                        `;

                    }

                    preview.innerHTML += html;

                });

            })

            .catch(error => {

                console.error(error);

                alert('File upload failed');

            });

        });

    </script>

</body>

</html>