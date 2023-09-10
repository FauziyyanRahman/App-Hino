@extends('layouts.master-layouts')

@section('title') 
    @lang('Identity') 
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .full-width {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
    </style>
@endsection
@section('content')
<div class="well full-width">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mt-n4">
                <form id="form-identity" class="needs-validation" novalidate>
                    <div class="bg-success bg-gradient">
                        <div class="text-center">
                            <br class="d-none d-sm-block">
                            <img src="{{URL::asset('build/images/user-dummy-img.jpg')}}" alt="" class="avatar-md rounded-circle mx-auto d-block" />
                            <h5 class="mt-3 mb-1">Step - 1</h5>
                            <h5>Fill Body Maker Identity</h5>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <ul class="list-unstyled hstack gap-2 mb-0 flex-grow-1">
                                <li><i class="bx bx-map align-middle"></i> Body Maker Management</li>
                                <li><i class="bx bx-user align-middle"></i> Identity</li>
                            </ul>
                            <div class="hstack gap-2 mb-3">
                                <button id="btn-save-identity" type="submit" class="btn btn-outline-light waves-effect">Save Identity <i class='bx bx-navigation align-baseline ms-1'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Form</h5>
                    <p class="card-title-desc text-danger">Fill all forms with valid data.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-name" placeholder="Enter Company Name"
                                                pattern="^[a-zA-Z\s]+$" required>
                                            <label for="id-company-name">Company Name</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid company name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3" id="date-est">
                                            <input type="text" class="form-control" name="id-company-est" placeholder="dd M yyyy" 
                                                data-date-format="dd M yyyy" data-date-container='#date-est'
                                                data-provide="datepicker" data-date-autoclose="true">
                                            <label for="id-company-est">Established</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-status" placeholder="Enter Company Status"
                                                pattern="^[a-zA-Z\s]+$" required>
                                            <label for="id-company-status">Company Status</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid company status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-phone" placeholder="Enter Phone Number"
                                                pattern="^[0-9]+$" required>
                                            <label for="id-company-phone">Phone</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid phone number.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-address" placeholder="Enter Address"
                                                pattern="^[a-zA-Z\s]+$" required>
                                            <label for="id-company-address">Address</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid address.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-fax" placeholder="Enter Fax">
                                            <label for="id-company-fax">Fax</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="id-company-email" placeholder="Enter Valid Email Address"
                                                required>
                                            <label for="id-company-email">Email</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid email address.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-url" placeholder="Enter Company Website">
                                            <label for="id-company-url">Website</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-owner" placeholder="Enter Owner Name"
                                                required>
                                            <label for="id-company-owner">Owner</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid owner name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-employees" placeholder="Enter Number of Employee">
                                            <label for="id-company-employees">Employees</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-warranty" placeholder="Enter Warranty to Customer">
                                            <label for="id-company-warranty">Cust. Warranty</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-business" placeholder="Enter Business Activity">
                                            <label for="id-company-business">Business Activity</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-building" placeholder="Enter Building Area / Land Area">
                                            <label for="id-company-building">Building Area</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-quality" placeholder="Enter Quality System">
                                            <label for="id-company-quality">Quality System</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-tech" placeholder="Enter Techinal Assistance">
                                            <label for="id-company-tech">Technical Assist</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-branch" placeholder="Enter Number of Branch">
                                            <label for="id-company-branch">Total Branch</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="id-company-license" placeholder="Enter Company License"
                                                required>
                                            <label for="id-company-license">Company License</label>
                                            <div class="invalid-tooltip">
                                                Please provide a valid company license.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                
                </form>
            </div>
        </div>
    </div>   
</div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> 
    <script src="{{ URL::asset('build/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/body-maker-identity.init.js') }}"></script>
@endsection
