<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('Person In Charge'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="well full-width">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mt-n4">
                <form id="form-pic" class="needs-validation" novalidate>
                    <div class="bg-success bg-gradient">
                        <div class="text-center">
                            <br class="d-none d-sm-block">
                            <img src="<?php echo e(URL::asset('build/images/user-dummy-img.jpg')); ?>" alt="" class="avatar-md rounded-circle mx-auto d-block" />
                            <h5 class="mt-3 mb-1">Step - 4</h5>
                            <h5>Fill Body Maker Person In Charge</h5>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <ul class="list-unstyled hstack gap-2 mb-0 flex-grow-1">
                                <li><i class="bx bx-map align-middle"></i> Body Maker Management</li>
                                <li><i class="bx bx-user align-middle"></i> Person In Charge</li>
                            </ul>
                            <div class="hstack gap-2 mb-3">
                                <button id="btn-save-identity" type="submit" class="btn btn-outline-light waves-effect">Add Person In Charge <i class='bx bx-navigation align-baseline ms-1'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form</h5>
                        <p class="card-title-desc text-danger">Fill all forms with valid data.</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="pic-level" aria-label="Person In Charge" required>
                                        <option value="">Choose</option>
                                        <option value="Owner">Owner</option>
                                        <option value="Factory Manager">Factory Manager</option>
                                        <option value="Marketing Manager">Marketing Manager</option>
                                        <option value="Engineering Manager">Engineering Manager</option>
                                        <option value="Production Manager">Production Manager</option>
                                    </select>
                                    <label for="pic-level">Person In Charge</label>
                                    <div class="invalid-tooltip">
                                        Please select a valid Person In Charge.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="pic-name" placeholder="Enter Name"
                                        pattern="^[a-zA-Z\s]+$" required>
                                    <label for="pic-name">Name</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="pic-email" placeholder="Enter Email"
                                        required>
                                    <label for="pic-email">Email</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="pic-phone" placeholder="Enter Owner Phone Number"
                                        pattern="^[0-9]+$" required>
                                    <label for="pic-phone">Phone Number</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Phone Number.
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/body-maker-pic.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Secondary/PHP/Laravel/Apps/Apps-Hino/resources/views/body-maker-pic.blade.php ENDPATH**/ ?>