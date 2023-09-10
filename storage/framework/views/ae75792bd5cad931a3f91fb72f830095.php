<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('Design And Tools'); ?> 
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
                <form id="form-design" class="needs-validation" novalidate>
                    <div class="bg-success bg-gradient">
                        <div class="text-center">
                            <br class="d-none d-sm-block">
                            <img src="<?php echo e(URL::asset('build/images/user-dummy-img.jpg')); ?>" alt="" class="avatar-md rounded-circle mx-auto d-block" />
                            <h5 class="mt-3 mb-1">Step - 2</h5>
                            <h5>Fill Body Maker Design And Tools</h5>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <ul class="list-unstyled hstack gap-2 mb-0 flex-grow-1">
                                <li><i class="bx bx-map align-middle"></i> Body Maker Management</li>
                                <li><i class="bx bx-user align-middle"></i> Design And Tools</li>
                            </ul>
                            <div class="hstack gap-2 mb-3">
                                <button id="btn-save-identity" type="submit" class="btn btn-outline-light waves-effect">Save Design Tools <i class='bx bx-navigation align-baseline ms-1'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">Form</h5>
                    <p class="card-title-desc text-danger">Fill all forms with valid data.</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="des-computer" placeholder="Enter Quantity of Computer Design"
                                        pattern="^[0-9]+$" required>
                                    <label for="des-computer">Quantity of Computer Design</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Quantity of Computer Design.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="des-twod-prog" placeholder="Enter 2D Programming Design"
                                        required>
                                    <label for="des-twod-prog">2D Programming Design</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid 2D Programming Design.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="des-threed-prog" placeholder="Enter 3D Programming Design"
                                        required>
                                    <label for="des-threed-prog">3D Programming Design</label>
                                    <div class="invalid-tooltip">
                                        Please provide a valid 3D Programming Design.
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
    <script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/body-maker-design.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Secondary/PHP/Laravel/Apps/Apps-Hino/resources/views/body-maker-design.blade.php ENDPATH**/ ?>