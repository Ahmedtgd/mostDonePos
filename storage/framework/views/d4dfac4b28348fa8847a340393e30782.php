<div>
    <?php if(filament()->hasRegistration()): ?>
         <?php $__env->slot('subheading', null, []); ?> 
            <?php echo e(__('filament::pages/auth/login.buttons.register.before')); ?>


            <?php echo e($this->registerAction); ?>

         <?php $__env->endSlot(); ?>
    <?php endif; ?>

    <form wire:submit.prevent="authenticate" class="grid gap-y-8">
        <?php echo e($this->form); ?>


        <?php echo e($this->authenticateAction); ?>

    </form>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/pages/auth/login.blade.php ENDPATH**/ ?>