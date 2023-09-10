@extends('layouts.master-layouts')

@section('title') 
    @lang('Hino Chassis Use') 
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .full-width {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
        .card-fade-in, .card-fade-out {
            transition: opacity 0.7s ease-in-out;
        }
    </style>
@endsection
@section('content')
<div class="well full-width">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mt-n4">
                <form id="form-chassis" class="needs-validation" novalidate>
                    <div class="bg-success bg-gradient">
                        <div class="text-center">
                            <br class="d-none d-sm-block">
                            <img src="{{URL::asset('build/images/user-dummy-img.jpg')}}" alt="" class="avatar-md rounded-circle mx-auto d-block" />
                            <h5 class="mt-3 mb-1">Step - 6</h5>
                            <h5>Fill Body Maker Hino Chassis Use</h5>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <ul class="list-unstyled hstack gap-2 mb-0 flex-grow-1">
                                <li><i class="bx bx-map align-middle"></i> Body Maker Management</li>
                                <li><i class="bx bx-user align-middle"></i> Hino Chassis Use</li>
                            </ul>
                            <div class="hstack gap-2 mb-3">
                                <button id="btn-add-chassis" type="button" class="btn btn-outline-light waves-effect">Add<i class='bx bx-plus-circle align-baseline ms-1'></i></button>
                                <button id="btn-save-chassis" type="button" hidden class="btn btn-outline-light waves-effect">Save <i class='bx bx-navigation align-baseline ms-1'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Form</h5>
                    <p class="card-title-desc text-danger">Fill all forms with valid data.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ch-types" placeholder="Enter Chassis Type"
                                        required>
                                    <label for="ch-types">Chassis Type</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Chassis Type.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ch-unit" placeholder="Enter Unit Per Month"
                                        pattern="^[0-9]+$" required>
                                    <label for="ch-unit">Unit Per Month</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Unit Per Month.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                
                </form>
            </div>
        </div>
    </div>
    <div id="card-container" class="row"> 
                 
    </div>   
</div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> 
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/body-maker-chassis.init.js') }}"></script>
@endsection
