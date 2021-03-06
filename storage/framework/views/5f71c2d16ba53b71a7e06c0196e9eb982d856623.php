<?php $__env->startSection('title'); ?> Purchase Report <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        <?php echo $__env->make('backend.report.purchase.partial.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <form action="<?php echo e(url('report/purchase/purchase-pdf')); ?>" method="get">
                                <?php echo $__env->make('backend.report.purchase.partial.hidden-filter-value-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="hidden" name="action_type" value="download">
                                <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> PDF </button>
                            </form>

                            <form action="<?php echo e(url('report/purchase/purchase-pdf')); ?>" method="get" target="_blank">
                                <?php echo $__env->make('backend.report.purchase.partial.hidden-filter-value-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="hidden" name="action_type" value="print">
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> PRINT </button>
                            </form>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <form action="<?php echo e(url('report/purchase/purchases-filter-result')); ?>" method="get">
                            <?php echo $__env->make('backend.report.purchase.purchases.filter-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form>

                        <div class="table-responsive margin-t-m5">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.invoice_id')); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                    <th><?php echo e(__('pages.branch')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('pages.supplier')); ?></th>
                                    <th><?php echo e(__('pages.purchase_date')); ?></th>
                                    <th><?php echo e(__('pages.total_amount')); ?></th>
                                    <th><?php echo e(__('pages.paid_amount')); ?></th>
                                    <th><?php echo e(__('pages.due_amount')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total_grand_total_amount = 0;
                                    $total_paid_amount = 0;
                                    $total_due_amount = 0;
                                ?>
                                <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('purchase.show', [$purchase->id])); ?>" target="_blank"><?php echo e($purchase->invoice_id); ?></a>
                                        </td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <td><?php echo e($purchase->branch->title); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($purchase->supplier->company_name); ?></td>
                                        <td><?php echo e($purchase->purchase_date->format(get_option('app_date_format'))); ?></td>
                                        <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->total_amount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->paid_amount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->due_amount, 2)); ?> </td>
                                    </tr>

                                    <?php
                                        $total_grand_total_amount += $purchase->total_amount;
                                        $total_paid_amount += $purchase->paid_amount;
                                        $total_due_amount += $purchase->due_amount;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <td colspan="5" class="text-right pr-3"><strong><?php echo e(__('pages.total')); ?></strong></td>
                                    <?php else: ?>
                                        <td colspan="4" class="text-right pr-3"><strong><?php echo e(__('pages.total')); ?></strong></td>
                                    <?php endif; ?>
                                    <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_grand_total_amount, 2)); ?></strong></td>
                                    <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_paid_amount, 2)); ?></strong></td>
                                    <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_due_amount, 2)); ?></strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/report/purchase/purchases/purchases-filter-result.blade.php ENDPATH**/ ?>