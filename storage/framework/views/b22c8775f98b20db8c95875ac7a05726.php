<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('build/images/hino-logo.png')); ?>" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo e(URL::asset('build/images/hino-logo.png')); ?>" alt="" height="30">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('build/images/hino-logo.png')); ?>" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo e(URL::asset('build/images/hino-logo.png')); ?>" alt="" height=30">
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo e(isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('build/images/user-dummy-img.jpg')); ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo e(ucfirst(session('Username'))); ?></span>
                </button>
            </div>
        </div>
    </div>
</header><?php /**PATH /Volumes/Secondary/PHP/Laravel/Apps/Apps-Hino/resources/views/layouts/horizontal.blade.php ENDPATH**/ ?>