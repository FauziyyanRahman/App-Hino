@extends('layouts.master')

@section('title')
    @lang('Body Maker')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('build/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1')
        Masters
    @endslot
    @slot('title')
        Body Maker Management
    @endslot
@endcomponent
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-2">Body Maker Profile Step</h6>
                <div class="hori-timeline">
                    <div class="owl-carousel owl-theme navs-carousel events" id="timeline-carousel">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 mt-lg-2">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title mb-3">Approval Activity</h6>
                <ul class="verti-timeline list-unstyled">
                </ul>
                <div class="text-center mt-4"><a href="javascript: void(0);" class="btn btn-info waves-effect waves-light btn-sm">View Tables<i class="mdi mdi-arrow-right ms-1"></i></a></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 mt-lg-2">
        <div class="card h-100 bg-success text-white-50">
            <div class="card-body">
                <div class="text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <h4 class="mt-4 fw-semibold text-white">Body Maker Application</h4>
                            <p class="mt-3 text-white">Your ultimate tool for simplifying the truck body manufacturing process</p>

                            <div class="mt-4">
                                <button id="btn-body-maker-register" type="button" class="btn btn-outline-light waves-effect waves-light">
                                    Register here
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5 mb-2">
                        <div class="col-sm-6 col-8">
                            <div>
                                <img src="{{ URL::asset('build/images/verification-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 mt-lg-2">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title mb-4">Quick PIC Website Application</h6>
                <form id="pic-web" class="needs-validation" novalidate>
                    <div class="input-group mb-3 position-relative">
                        <label class="visually-hidden" for="pic-company">Company</label>
                        <select class="form-select" name="pic-company" required>
                            <option value="">Choose Company</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select company.
                        </div>
                    </div>
                    <div class="input-group mb-3 position-relative">
                        <label class="visually-hidden" for="pic-username">Username</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bx bx-user"></i></div>
                            <input type="text" class="form-control" name="pic-username" placeholder="Username" 
                                pattern="^[a-zA-Z0-9]+$" required>
                            <div class="invalid-tooltip">
                                Please provide a valid username.
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 position-relative">
                        <label class="visually-hidden" for="pic-position">Position</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bx bx-briefcase"></i></div>
                            <input type="text" class="form-control" name="pic-position" placeholder="Position" 
                                pattern="^[a-zA-Z\s]+$" required>
                            <div class="invalid-tooltip">
                                Please provide a valid position.
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 position-relative">
                        <label class="visually-hidden" for="pic-email">Email</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bx bx-envelope"></i></div>
                            <input type="email" class="form-control" name="pic-email" placeholder="Email" required>
                            <div class="invalid-tooltip">
                                Please provide a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 position-relative">
                        <label class="visually-hidden" for="pic-phone">Phone</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bx bx-mobile"></i></div>
                            <input type="text" class="form-control" name="pic-phone" placeholder="Phone" 
                            pattern="^[0-9]+$" required>
                            <div class="invalid-tooltip">
                                Please provide a valid phone.
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-danger mb-4">All field are required.</p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning w-md">Add</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> 
    <script src="{{ URL::asset('build/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/body-maker.init.js') }}"></script>
@endsection