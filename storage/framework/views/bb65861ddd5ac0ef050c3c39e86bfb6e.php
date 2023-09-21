<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'size' => 'md',
    'src',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'size' => 'md',
    'src',
]); ?>
<?php foreach (array_filter(([
    'size' => 'md',
    'src',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div
    <?php echo e($attributes->class([
            'rounded-full bg-gray-200 bg-cover bg-center dark:bg-gray-900',
            match ($size) {
                'xs' => 'h-6 w-6',
                'sm' => 'h-8 w-8',
                'md' => 'h-10 w-10',
                'lg' => 'h-12 w-12',
                default => $size,
            },
        ])); ?>

    style="background-image: url('<?php echo e($src); ?>')"
></div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/avatar/index.blade.php ENDPATH**/ ?>