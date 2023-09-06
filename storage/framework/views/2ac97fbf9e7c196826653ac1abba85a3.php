

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Sweet Alert-->
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Dashboards <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Dashboard <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="<?php echo e(isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('build/images/user-dummy-img.jpg')); ?>" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-grow-1 align-self-center">
                                <div class="text-muted">
                                    <p class="mb-2">Hino Karoseri Dashboard</p>
                                    <h5 class="mb-1"><?php echo e(ucfirst(session('Username'))); ?></h5>
                                    <p class="mb-0"><?php echo e(strtoupper(session('Roles'))); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Weekly Visitor</p>
                                        <h5 class="mb-0"><?php echo e($response['data']['visitors']['weekly']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Monthly Visitor</p>
                                        <h5 class="mb-0"><?php echo e($response['data']['visitors']['monthly']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Total Visitor</p>
                                        <h5 class="mb-0"><?php echo e($response['data']['visitors']['total']); ?></h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-info text-white-50">
            <div class="card-body ">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-white fw-medium">Total Request Category</p>
                        <h4 class="mb-0 text-white"><?php echo e($response['data']['request'][0]['request']); ?></h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-white mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-info">
                                <i class="bx bxs-right-arrow-circle font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white-50">
            <div class="card-body ">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-white fw-medium">Approved Category</p>
                        <h4 class="mb-0 text-white"><?php echo e($response['data']['request'][0]['approve']); ?></h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-white mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-success">
                                <i class="bx bxs-up-arrow-circle font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white-50">
            <div class="card-body ">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-white fw-medium">Rejected Category</p>
                        <h4 class="mb-0 text-white"><?php echo e($response['data']['request'][0]['reject']); ?></h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-white mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-danger">
                                <i class="bx bxs-down-arrow-circle font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pending Category Request</h4>
                <div class="table-responsive">
                    <table id="yajra-table" class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">User Request</th>
                                <th class="align-middle">Req. Date</th>
                                <th class="align-middle">Req. Category</th>
                                <th class="align-middle">Karoseri Name</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>
</div>
<!-- Reject Modal -->
<div class="modal fade reject-Modal" tabindex="-1" role="dialog" aria-labelledby="reject-Modal" aria-hidden="true">
    <<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4 bg-white">
                        <div class="avatar-title rounded-circle bg-danger h1">
                            <i class="mdi mdi-exclamation"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text-danger">Reject</h4>
                            <div class="input-group bg-light rounded">
                                <input id="rejecNote" type="text" class="form-control bg-transparent border-0" placeholder="Enter Rejection Reason" aria-describedby="button-submit">
                                <button class="btn btn-primary" type="submit" id="button-submit">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Detail Modal -->
<div class="modal fade detail-Modal" tabindex="-1" role="dialog" aria-labelledby="detail-Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-detailModalLabel">Detail Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="company-name" class="col-form-label">Company Name:</label>
                        <input type="text" class="form-control" id="company-name" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="design-body" class="col-form-label">Design Body:</label>
                        <div id="design-body"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('build/js/pages/dashboard.init.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/sweet-alerts.init.js')); ?>"></script>
<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "<?php echo e(session('success')); ?>",
    });
</script>
<?php endif; ?>
<script>
    // Fetch data from your server (assuming it's available as an API)
    fetch("<?php echo e(route('yajra')); ?>")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Initialize DataTables with your table
                $('#yajra-table').DataTable({
                    data: data.data,
                    columns: [
                        {
                            // Column for the "Request" status with a badge
                            data: 'username',
                            render: function (data, type, row) {
                                return `<span class="text-primary">${data}</span>`;
                            }
                        },
                        { data: 'request_date' },
                        { data: 'kategori_name' },
                        { data: 'request_karoseri_name' },
                        {
                            // Column for the "Request" status with a badge
                            data: 'request_status',
                            render: function (data, type, row) {
                                if (data === 'Request') {
                                    return `<span class="badge badge-pill badge-soft-success font-size-11">${data}</span>`;
                                } else {
                                    return data; // Keep other statuses as is
                                }
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                let downloadLink = ''; // Initialize an empty string
                                let rowId = data.request_id;

                                if (data.ms_kategori_file) {
                                    downloadLink = `<a href="${data.ms_kategori_file}" class="btn btn-info w-xs" target="_blank"><i class="mdi mdi-download"></i></a>`;
                                }
                                
                                return `<div>
                                            <div class="btn-group btn-group-example mb-2" role="group">
                                                <button id='eye-detail' type="button" class="btn btn-success w-xs" data-bs-toggle="modal" data-bs-target=".detail-Modal" data-row-id="${rowId}|${data.request_karoseri_name}|${data.request_body}"><i class="mdi mdi-eye-outline"></i></button>
                                                ${downloadLink}    
                                        </div>
                                        </div>
                                        <div>
                                            <div class="btn-group btn-group-example mb-2" role="group">
                                                <button type="button" class="btn btn-danger w-xs thumbs-down-button" data-bs-toggle="modal" data-bs-target=".reject-Modal" data-row-id="${rowId}|${data.request_karoseri_name}|${data.kategori_name}"><i class="mdi mdi-thumb-down"></i></button>
                                                <a href="/approval?rowId=${rowId}&status=Approve&reject_note=''&karoseri=${data.request_karoseri_name} - ${data.kategori_name}" class="btn btn-primary w-xs thumbs-up-button"><i class="mdi mdi-thumb-up"></i></a>
                                            </div>
                                        </div>
                                    `;
                            },
                            orderable: false,
                        },
                    ]
                });
            } else {
                // Handle the case when the request was not successful
                console.error('Failed to retrieve data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any errors that occur during the fetch request
        });

        $(document).on('click', '.thumbs-down-button', function() {
            let rowId = $(this).data('row-id');
            $('#button-submit').attr('data-row-id', rowId);
        });

        $(document).on('click', '#eye-detail', function() {
            let rowId = $(this).data('row-id').split('|')[0];
            let karoseri = $(this).data('row-id').split('|')[1];
            let designBody = $(this).data('row-id').split('|')[2];
            $('#company-name').val(karoseri);
            //create button download if designBody is not null
            if (designBody) {
                $('#design-body').html(`<a href="${designBody}" class="btn btn-info w-xs form-control" target="_blank">Download Design Body <i class="mdi mdi-download"></i></a>`);
            } else {
                $('#design-body').html('');
            }
            console.log(designBody);

        });        

        // add validation to rejectNote input
        $(document).on('click', '#button-submit', function() {
            let rejectNote = $('#rejecNote').val();
            if (rejectNote === '') {
                $('#rejecNote').addClass('is-invalid');
                // error message inside rejectNote as placeholder
                $('#rejecNote').attr('placeholder', 'Please enter rejection reason');
            } else {
                let rowId = $(this).data('row-id').split('|')[0];
                let karoseri = $(this).data('row-id').split('|')[1];
                let kategori = $(this).data('row-id').split('|')[2];
                let url = `rowId=184&status=Reject&reject_note=${rejectNote}&karoseri=${karoseri} - ${kategori}`;

                window.location.href = `<?php echo e('approval'); ?>?${url}`;
            }
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Secondary/PHP/Laravel/Apps/Hino/resources/views/index.blade.php ENDPATH**/ ?>