@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    .dashboard-wrapper {
        min-height: 100vh;
    }

    .modern-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .gradient-header {
        background: linear-gradient(135deg,
                #4f46e5,
                #7c3aed);
        color: white;
        padding: 22px;
    }

    .upload-header {
        background: linear-gradient(135deg,
                #111827,
                #1f2937);
        color: white;
        padding: 22px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .custom-input {
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        padding: 12px 16px;
        transition: 0.3s ease;
    }

    .custom-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-modern {
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg,
                #4f46e5,
                #7c3aed);
        border: none;
        color: white;
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }

    .btn-dark-modern {
        background: #111827;
        color: white;
        border: none;
    }

    .btn-dark-modern:hover {
        background: #000;
        color: white;
    }

    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        transition: 0.3s;
        background: #f8fafc;
        cursor: pointer;
    }

    .upload-box:hover {
        border-color: #6366f1;
        background: #eef2ff;
    }

    .preview-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }

    .preview-card:hover {
        transform: translateY(-6px);
    }

    .preview-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: rgba(239, 68, 68, 0.9);
        color: white;
    }

    .loader-box {
        border-radius: 14px;
        font-weight: 600;
    }
</style>

<div class="container py-5 dashboard-wrapper">

    <div class="row justify-content-center">

<div class="col-lg-10">

            <!-- TASK FORM -->
<div class="modern-card mb-5">

<div class="gradient-header">

<div class="section-title">
                        <i class="bi bi-check2-square"></i>
Create New Task
                        </div>

                </div>

<div class="p-4">

<form action="{{ route('tasks.store') }}" method="POST">

                        @csrf

                        @include('tasks.form')

<div class="mt-4">
                        
                            <button class="btn btn-modern btn-primary-modern">
                                <i class="bi bi-plus-circle"></i>
                                Create Task
                            </button>
                        
                        </div>
                    </form>

                </div>

            </div>

            <!-- FILE UPLOAD -->
<div class="modern-card">

<div class="upload-header d-flex justify-content-between align-items-center">

<div class="section-title">
                        <i class="bi bi-cloud-arrow-up"></i>
                        File Upload Center
                    </div>

<button type="button" id="addMore" class="btn btn-light btn-sm rounded-pill px-4">

                        <i class="bi bi-plus-circle"></i>
                        Add More

                    </button>

                </div>

<div class="p-4">

                    <form id="uploadForm">

                        @csrf

<!-- DRAG DROP AREA -->
                        <div class="upload-box mb-4">
                        
                            <i class="bi bi-cloud-upload display-5 text-primary"></i>
                        
                            <h5 class="mt-3 fw-bold">
                                Drag & Drop Files
                            </h5>
                        
                            <p class="text-muted mb-3">
                                Upload images or PDFs
                            </p>
                        
                            <div id="fileContainer">

<div class="input-group mb-3 file-group">

<input type="file" class="form-control custom-input file-input">

<button type="button" class="btn btn-danger rounded-end remove-input">

<i class="bi bi-trash"></i>

</button>

</div>

</div>

</div>
                        
                        <button type="submit" class="btn btn-modern btn-primary-modern">

                            <i class="bi bi-upload"></i>
                            Upload Files

                        </button>

                    </form>

                    <!-- LOADER -->
<div id="uploadLoader" class="alert alert-primary loader-box mt-4 d-none">
                    
                        <div class="d-flex align-items-center gap-2">
                    
                            <div class="spinner-border spinner-border-sm"></div>
                    
                            Uploading files, please wait...

</div>

                    </div>

                    <!-- PREVIEW -->
<div id="preview" class="row g-4 mt-2">

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
.addEventListener('click', () => {

const html = `
        <div class="input-group mb-3 file-group">

            <input type="file"
class="form-control custom-input file-input">

            <button type="button"
                    class="btn btn-danger remove-input">

                <i class="bi bi-trash"></i>

            </button>

        </div>
    `;

    document
    .getElementById('fileContainer')
.insertAdjacentHTML('beforeend', html);

});

// REMOVE INPUT
document.addEventListener('click', (e) => {

    if(e.target.closest('.remove-input')){

e.target.closest('.file-group').remove();

    }

});

// FILE CHANGE
document.addEventListener('change', (e) => {

    if(e.target.classList.contains('file-input')){

const file = e.target.files[0];

        if(!file) return;

        selectedFiles.push(file);

renderPreview(file);

    }

});

// PREVIEW
function renderPreview(file)
{
const preview = document.getElementById('preview');

const fileURL = URL.createObjectURL(file);

const extension =
    file.name.split('.').pop().toLowerCase();

let content = '';

    if(extension === 'pdf'){

content = `
        <iframe src="${fileURL}" width="100%"
height="240">
            </iframe>
`;

}else{

content = `
        <img src="${fileURL}" class="preview-img">
        `;
}

preview.innerHTML += `
    <div class="col-md-4 preview-item">

<div class="preview-card position-relative">

<button type="button"
class="remove-btn remove-preview">

<i class="bi bi-x-lg"></i>

</button>

${content}

<div class="p-3">

<div class="fw-semibold text-truncate">
${file.name}
</div>

</div>

</div>

</div>
        `;
}

// REMOVE PREVIEW
document.addEventListener('click', (e) => {

    if(e.target.closest('.remove-preview')){

        e.target
         .closest('.preview-item')
         .remove();

    }

});

// SUBMIT
document
.getElementById('uploadForm')
.addEventListener('submit', (e) => {

    e.preventDefault();

    let formData = new FormData();

    selectedFiles.forEach(file => {

formData.append('files[]', file);

    });

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

.then(res => res.json())

    .then(data => {

        document
        .getElementById('uploadLoader')
        .classList.add('d-none');

Swal.fire({
        
        icon: 'success',
        title: 'Success!',
        text: 'Files uploaded successfully'
        
        });

    })

    .catch(error => {

console.error(error);
        
        document
        .getElementById('uploadLoader')
        .classList.add('d-none');
        
        Swal.fire({
        
        icon: 'error',
        title: 'Upload Failed',
        text: 'Something went wrong'

});

    });

});

</script>

@endsection