<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'breadcrumbs' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'breadcrumbs' => [],
]); ?>
<?php foreach (array_filter(([
    'breadcrumbs' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div <?php echo e($attributes->class(['filament-breadcrumbs hidden flex-1 lg:block'])); ?>>
    <ul class="flex items-center gap-3 text-sm font-medium dark:text-white">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a
                    href="<?php echo e(is_int($url) ? '#' : $url); ?>"
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'text-gray-500 dark:text-gray-400' => $loop->last && (! $loop->first),
                        'dark:text-gray-300' => (! $loop->last) || $loop->first,
                    ]); ?>"
                >
                    <?php echo e($label); ?>

                </a>
            </li>

            <?php if(! $loop->last): ?>
                <li
                    class="h-4 -skew-x-12 border-e border-gray-300 dark:border-gray-500"
                ></li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/app/topbar/breadcrumbs.blade.php ENDPATH**/ ?>