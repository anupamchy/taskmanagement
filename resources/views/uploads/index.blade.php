@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">

                        <i class="bi bi-cloud-upload"></i>
                        Multiple File Upload

                    </h4>

                    <button type="button" id="addMore" class="btn btn-light btn-sm">

                        <i class="bi bi-plus-circle"></i>
                        Add More

                    </button>

                </div>

                <div class="card-body">

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

                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-upload"></i>
                            Upload Files

                        </button>

                    </form>

                    <!-- LOADER -->
                    <div id="uploadLoader" class="alert alert-info mt-3 d-none">

                        Uploading...

                    </div>

                    <!-- PREVIEW -->
                    <div id="preview" class="row mt-4 g-4">

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('uploads.script')

@endsection