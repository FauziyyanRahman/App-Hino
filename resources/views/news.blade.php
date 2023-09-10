@extends('layouts.master')

@section('title')
    @lang('translation.Blog')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>.mfp-bg { z-index: 1061; } .mfp-wrap { z-index: 1062; } </style>
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1')
        Masters
    @endslot
    @slot('title')
        News Management
    @endslot
@endcomponent
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-post" role="tab">
                        Published
                    </a>
                </li>
            </ul>

            <!-- Pagination -->
            <div class="row p-4">
                <div class="col-xl-3 col-lg-3">
                    <div class="search-box me-2 mb-2 d-inline-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" id="searchTableList" placeholder="Search Title...">
                            <i class="bx bx-search-alt search-icon"></i>
                        </div>
                    </div>
                </div>
            
                <!-- Pagination (Centered) -->
                <div class="col-xl-6 col-lg-6 text-center">
                    <div id="paging" class="pagination justify-content-center pagination-rounded">
                        
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="input-group justify-content-end">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#newContactModal" 
                            class="btn btn-success btn-rounded waves-effect waves-light addNews-modal mb-2">
                            <i class="mdi mdi-plus me-1"></i> Add News
                        </button>
                    </div>
                </div>
            </div>            
            <!-- End Pagination (Moved to the top) -->

            <!-- Tab panes -->
            <div class="tab-content p-4">
                <div class="tab-pane active" id="all-post" role="tabpanel">
                    <div class="row justify-content-left">
                        <div class="col-xl-12">
                            <div class="row" id="news-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="newContactModal" tabindex="-1" aria-labelledby="newContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContactModalLabel">Add News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" class="needs-validation createNews-form" id="createNews-form" novalidate>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="subject-id">Subject ID</label>
                                <input type="text" class="form-control" id="subject-id-input" placeholder="Enter Subject ID" required>
                                <div class="invalid-feedback">Please enter a news title.</div>
                                <input type="hidden" class="form-control" id="news-id-input">
                            </div>
                        </div>
                        <div class="col-lg-6">                        
                            <div class="mb-3">
                                <label for="subject-en">Subject EN</label>
                                <input type="text" class="form-control" id="subject-en-input" placeholder="Enter Subject">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="content-id" class="form-label">Content News</label>
                                <textarea id="content-id" name="area" required></textarea>
                                <div class="invalid-feedback">Please enter a news content.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="image">Upload Images</label>
                                <input type="file" class="form-control" id="image-input" accept="image/*">
                            </div>
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <div class="spinner-border text-primary" role="status" style="display: none">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <a id="image-zoom" class="image-popup-no-margins">
                                    <img id="image-preview" src="" class="img-thumbnail img-fluid" loading="lazy">
                                </a>                                 
                            </div>                            
                        </div>
                    </div>
                    <div>
                        <button id="addContact-btn" class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
<!-- end newContactModal -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> 
    <script src="{{ URL::asset('build/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/news.init.js') }}"></script>
@endsection
