<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'default' => 1,
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
    'defaultStart' => null,
    'smStart' => null,
    'mdStart' => null,
    'lgStart' => null,
    'xlStart' => null,
    'twoXlStart' => null,
    'hidden' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'default' => 1,
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
    'defaultStart' => null,
    'smStart' => null,
    'mdStart' => null,
    'lgStart' => null,
    'xlStart' => null,
    'twoXlStart' => null,
    'hidden' => false,
]); ?>
<?php foreach (array_filter(([
    'default' => 1,
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
    'defaultStart' => null,
    'smStart' => null,
    'mdStart' => null,
    'lgStart' => null,
    'xlStart' => null,
    'twoXlStart' => null,
    'hidden' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $getSpanValue = function ($span) {
        if ($span === 'full') {
            return '1 / -1';
        }

        return "span {$span} / span {$span}";
    }
?>

<div
    style="
        <?php if($default): ?> --col-span-default: <?php echo e($getSpanValue($default)); ?>; <?php endif; ?>
        <?php if($sm): ?> --col-span-sm: <?php echo e($getSpanValue($sm)); ?>; <?php endif; ?>
        <?php if($md): ?> --col-span-md: <?php echo e($getSpanValue($md)); ?>; <?php endif; ?>
        <?php if($lg): ?> --col-span-lg: <?php echo e($getSpanValue($lg)); ?>; <?php endif; ?>
        <?php if($xl): ?> --col-span-xl: <?php echo e($getSpanValue($xl)); ?>; <?php endif; ?>
        <?php if($twoXl): ?> --col-span-2xl: <?php echo e($getSpanValue($twoXl)); ?>; <?php endif; ?>
        <?php if($defaultStart): ?> --col-start-default: <?php echo e($defaultStart); ?>; <?php endif; ?>
        <?php if($smStart): ?> --col-start-sm: <?php echo e($smStart); ?>; <?php endif; ?>
        <?php if($mdStart): ?> --col-start-md: <?php echo e($mdStart); ?>; <?php endif; ?>
        <?php if($lgStart): ?> --col-start-lg: <?php echo e($lgStart); ?>; <?php endif; ?>
        <?php if($xlStart): ?> --col-start-xl: <?php echo e($xlStart); ?>; <?php endif; ?>
        <?php if($twoXlStart): ?> --col-start-2xl: <?php echo e($twoXlStart); ?>; <?php endif; ?>
    "
    <?php echo e($attributes->class([
        'hidden' => $hidden || $default === 'hidden',
        'col-[--col-span-default]' => $default && (! $hidden),
        'sm:col-[--col-span-sm]' => $sm && (! $hidden),
        'md:col-[--col-span-md]' => $md && (! $hidden),
        'lg:col-[--col-span-lg]' => $lg && (! $hidden),
        'xl:col-[--col-span-xl]' => $xl && (! $hidden),
        '2xl:col-[--col-span-2xl]' => $twoXl && (! $hidden),
        'col-start-[--col-start-default]' => $defaultStart && (! $hidden),
        'sm:col-start-[--col-start-sm]' => $smStart && (! $hidden),
        'md:col-start-[--col-start-md]' => $mdStart && (! $hidden),
        'lg:col-start-[--col-start-lg]' => $lgStart && (! $hidden),
        'xl:col-start-[--col-start-xl]' => $xlStart && (! $hidden),
        '2xl:col-start-[--col-start-2xl]' => $twoXlStart && (! $hidden),
    ])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/grid/column.blade.php ENDPATH**/ ?>