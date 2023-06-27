<!-- Modal Cash on Transfer-->
<div class="modal fade" id="cod" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><?php echo e(__('Pay Cash On Delivery')); ?></h6>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('front.checkout.submit')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="payment_method" value="Cash On Delivery" id="">
                <input type="hidden" name="state_id" value="<?php echo e(auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''); ?>"
                       class="state_id_setup">
                <div class="card-body">
                    <p><?php echo e(PriceHelper::GatewayText('cod')); ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span><?php echo e(__('Cancel')); ?></span></button>
                    <button class="btn btn-primary btn-sm" type="submit"><span><?php echo e(__('Cash On Delivery')); ?></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Airtel -->

<?php $__currentLoopData = \App\Models\PaymentSetting::where('status',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="<?php echo e($payment_gateway->unique_keyword); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                        $name=$payment_gateway->name;
                    ?>
                    <h6 class="modal-title">Pay via <?php echo e($name); ?></h6>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="card-wrapper"></div>
                        <form class="interactive-credit-card row" action="<?php echo e(route('front.checkout.submit')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group col-sm-12">
                                <input class="form-control" type="text" name="phone" placeholder="<?php echo e(__('Phone Number e.g 07xxxxxxxx')); ?>"
                                       required >
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span><?php echo e(__('Cancel')); ?></span></button>
                    <button class="btn btn-primary btn-sm" type="submit"><span><?php echo e(__('Chekout With Stripe')); ?></span></button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp7.1.3\htdocs\shopping-new\core\resources\views/includes/checkout_modal.blade.php ENDPATH**/ ?>