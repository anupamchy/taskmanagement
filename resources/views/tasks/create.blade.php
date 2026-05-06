@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <!-- TASK FORM -->
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        <i class="bi bi-check2-square"></i>
                        Create Task

                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('tasks.store') }}" method="POST">

                        @csrf

                        @include('tasks.form')

                    </form>

                </div>

            </div>

            <!-- FILE UPLOAD -->
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">

                        <i class="bi bi-cloud-upload"></i>
                        Multiple File Upload

                    </h4>

                    <!-- ADD MORE -->
                    <button type="button" id="addMore" class="btn btn-light btn-sm">

                        <i class="bi bi-plus-circle"></i>
                        Add More

                    </button>

                </div>

                <div class="card-body">

                    <!-- FORM -->
                    <form id="uploadForm">

                        @csrf

                        <!-- FILE CONTAINER -->
                        <div id="fileContainer">

                            <div class="input-group mb-3 file-group">

                                <input type="file" class="form-control file-input">

                                <button type="button" class="btn btn-danger remove-input">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-upload"></i>
                            Upload Files

                        </button>

                    </form>

                    <!-- LOADER -->
                    <div id="uploadLoader" class="alert alert-info mt-3 d-none">

                        Uploading files...

                    </div>

                    <!-- PREVIEW -->
                    <div id="preview" class="row mt-4 g-4">

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    let selectedFiles = [];

// ADD MORE INPUT
document
.getElementById('addMore')
.addEventListener('click', function () {

    let html = `
        <div class="input-group mb-3 file-group">

            <input type="file"
                   class="form-control file-input">

            <button type="button"
                    class="btn btn-danger remove-input">

                <i class="bi bi-trash"></i>

            </button>

        </div>
    `;

    document
    .getElementById('fileContainer')
    .insertAdjacentHTML(
        'beforeend',
        html
    );

});

// REMOVE INPUT
document.addEventListener('click', function (e) {

    if(e.target.closest('.remove-input')){

        e.target
         .closest('.file-group')
         .remove();

    }

});

// PREVIEW BEFORE UPLOAD
document.addEventListener('change', function (e) {

    if(e.target.classList.contains('file-input')){

        let file = e.target.files[0];

        if(!file) return;

        selectedFiles.push(file);

        showPreview(file);

    }

});

// SHOW PREVIEW
function showPreview(file)
{
    let preview =
    document.getElementById('preview');

    let fileURL =
    URL.createObjectURL(file);

    let extension =
    file.name.split('.').pop().toLowerCase();

    let html = '';

    // PDF
    if(extension === 'pdf'){

        html = `
            <div class="col-md-4 preview-item">

                <div class="card shadow-sm h-100 position-relative">

                    <button type="button"
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-preview">

                        <i class="bi bi-x"></i>

                    </button>

                    <iframe
                        src="${fileURL}"
                        width="100%"
                        height="250">
                    </iframe>

                    <div class="card-body text-center">

                        <small class="fw-bold">

                            ${file.name}

                        </small>

                    </div>

                </div>

            </div>
        `;

    } else {

        // IMAGE
        html = `
            <div class="col-md-4 preview-item">

                <div class="card shadow-sm h-100 position-relative">

                    <button type="button"
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-preview">

                        <i class="bi bi-x"></i>

                    </button>

                    <img src="${fileURL}"
                         class="img-fluid rounded-top"
                         style="height:250px;
                                object-fit:cover;">

                    <div class="card-body text-center">

                        <small class="fw-bold">

                            ${file.name}

                        </small>

                    </div>

                </div>

            </div>
        `;
    }

    preview.innerHTML += html;
}

// REMOVE PREVIEW
document.addEventListener('click', function (e) {

    if(e.target.closest('.remove-preview')){

        e.target
         .closest('.preview-item')
         .remove();

    }

});

// UPLOAD FILES
document
.getElementById('uploadForm')
.addEventListener('submit', function (e) {

    e.preventDefault();

    let formData = new FormData();

    // APPEND FILES
    selectedFiles.forEach(file => {

        formData.append(
            'files[]',
            file
        );

    });

    // SHOW LOADER
    document
    .getElementById('uploadLoader')
    .classList.remove('d-none');

    // AJAX
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

        alert('Files Uploaded Successfully');

    })

    .catch(error => {

        console.log(error);

        alert('Upload Failed');

    });

});

</script>

@endsection