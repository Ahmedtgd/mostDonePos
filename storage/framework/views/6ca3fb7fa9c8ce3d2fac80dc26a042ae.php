<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'isGrid' => true,
    'default' => 1,
    'direction' => 'row',
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'isGrid' => true,
    'default' => 1,
    'direction' => 'row',
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
]); ?>
<?php foreach (array_filter(([
    'isGrid' => true,
    'default' => 1,
    'direction' => 'row',
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    'twoXl' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div
    style="
        <?php if($direction === 'row'): ?>
            <?php if($default): ?> --cols-default: repeat(<?php echo e($default); ?>, minmax(0, 1fr)); <?php endif; ?>
            <?php if($sm): ?> --cols-sm: repeat(<?php echo e($sm); ?>, minmax(0, 1fr)); <?php endif; ?>
            <?php if($md): ?> --cols-md: repeat(<?php echo e($md); ?>, minmax(0, 1fr)); <?php endif; ?>
            <?php if($lg): ?> --cols-lg: repeat(<?php echo e($lg); ?>, minmax(0, 1fr)); <?php endif; ?>
            <?php if($xl): ?> --cols-xl: repeat(<?php echo e($xl); ?>, minmax(0, 1fr)); <?php endif; ?>
            <?php if($twoXl): ?> --cols-2xl: repeat(<?php echo e($twoXl); ?>, minmax(0, 1fr)); <?php endif; ?>
        <?php elseif($direction === 'column'): ?>
            <?php if($default): ?> --cols-default: <?php echo e($default); ?>; <?php endif; ?>
            <?php if($sm): ?> --cols-sm: <?php echo e($sm); ?>; <?php endif; ?>
            <?php if($md): ?> --cols-md: <?php echo e($md); ?>; <?php endif; ?>
            <?php if($lg): ?> --cols-lg: <?php echo e($lg); ?>; <?php endif; ?>
            <?php if($xl): ?> --cols-xl: <?php echo e($xl); ?>; <?php endif; ?>
            <?php if($twoXl): ?> --cols-2xl: <?php echo e($twoXl); ?>; <?php endif; ?>
        <?php endif; ?>
    "
    <?php echo e($attributes->class([
            'grid' => $isGrid && $direction === 'row',
            'grid-cols-[--cols-default]' => $default && ($direction === 'row'),
            'columns-[--cols-default]' => $default && ($direction === 'column'),
            'sm:grid-cols-[--cols-sm]' => $sm && ($direction === 'row'),
            'sm:columns-[--cols-sm]' => $sm && ($direction === 'column'),
            'md:grid-cols-[--cols-md]' => $md && ($direction === 'row'),
            'md:columns-[--cols-md]' => $md && ($direction === 'column'),
            'lg:grid-cols-[--cols-lg]' => $lg && ($direction === 'row'),
            'lg:columns-[--cols-lg]' => $lg && ($direction === 'column'),
            'xl:grid-cols-[--cols-xl]' => $xl && ($direction === 'row'),
            'xl:columns-[--cols-xl]' => $xl && ($direction === 'column'),
            '2xl:grid-cols-[--cols-2xl]' => $twoXl && ($direction === 'row'),
            '2xl:columns-[--cols-2xl]' => $twoXl && ($direction === 'column'),
        ])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/grid/index.blade.php ENDPATH**/ ?>