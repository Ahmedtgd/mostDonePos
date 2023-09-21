<div>
    <div
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex gap-3',
            match (static::$horizontalAlignment) {
                'left' => 'items-start',
                'center' => 'items-center',
                'right' => 'items-end',
            },
            match (static::$verticalAlignment) {
                'top' => 'flex-col-reverse justify-end',
                'bottom' => 'flex-col justify-end',
                'center' => 'flex-col justify-center'
            },
        ]); ?>"
        role="status"
    >
        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($notification); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($broadcastChannel = $this->getBroadcastChannel()): ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-notifications::components.echo','data' => ['channel' => $broadcastChannel]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-notifications::echo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['channel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($broadcastChannel)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/notifications/src/../resources/views/notifications.blade.php ENDPATH**/ ?>