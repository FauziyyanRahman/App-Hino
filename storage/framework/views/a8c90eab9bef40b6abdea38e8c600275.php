<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('Variant Product'); ?> 
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
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="well full-width">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mt-n4">
                <form id="form-variant" class="needs-validation" novalidate>
                    <div class="bg-success bg-gradient">
                        <div class="text-center">
                            <br class="d-none d-sm-block">
                            <img src="<?php echo e(URL::asset('build/images/user-dummy-img.jpg')); ?>" alt="" class="avatar-md rounded-circle mx-auto d-block" />
                            <h5 class="mt-3 mb-1">Step - 7</h5>
                            <h5>Fill Body Maker Variant Product Body Builder</h5>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <ul class="list-unstyled hstack gap-2 mb-0 flex-grow-1">
                                <li><i class="bx bx-map align-middle"></i> Body Maker Management</li>
                                <li><i class="bx bx-user align-middle"></i> Variant Product Body Builder</li>
                            </ul>
                            <div class="hstack gap-2 mb-3">
                                <button id="btn-add-variant" type="button" class="btn btn-outline-light waves-effect">Add<i class='bx bx-plus-circle align-baseline ms-1'></i></button>
                                <button id="btn-save-variant" type="button" hidden class="btn btn-outline-light waves-effect">Save <i class='bx bx-navigation align-baseline ms-1'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Form</h5>
                    <p class="card-title-desc text-danger">Fill all forms with valid data.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="pr-all-type" placeholder="Enter All Type"
                                        required>
                                    <label for="des-twod-prog">All Type</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid All Type.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="pr-unit" placeholder="Enter Unit Per Month"
                                        pattern="^[0-9]+$" required>
                                    <label for="eq-welding">Unit Per Month</label>
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
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> 
    <script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/body-maker-variant.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Secondary/PHP/Laravel/Apps/Apps-Hino/resources/views/body-maker-variant.blade.php ENDPATH**/ ?>