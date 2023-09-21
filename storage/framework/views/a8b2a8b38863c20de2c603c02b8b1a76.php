<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'alias' => null,
    'class' => [],
    'color' => null,
    'group' => null,
    'name' => null,
    'size',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'alias' => null,
    'class' => [],
    'color' => null,
    'group' => null,
    'name' => null,
    'size',
]); ?>
<?php foreach (array_filter(([
    'alias' => null,
    'class' => [],
    'color' => null,
    'group' => null,
    'name' => null,
    'size',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $icon = $alias ? \Filament\Support\Facades\FilamentIcon::resolve($alias) : null;
    $group = $group ? \Filament\Support\Facades\FilamentIcon::resolve($group) : null;

    if ($icon?->name) {
        $name = $icon->name;
    }

    $class = [
        ...($group?->class ?? []),
        ...($icon?->class ?? []),
        ...Arr::wrap($class),
    ];

    $color = $icon?->color ?? $group?->color ?? $color;

    if ($color !== null) {
        $class[] = $color;
    }

    $class[] = $icon?->size ?? $group?->size ?? $size;
?>

<?php if($name): ?>
    <?php echo e(svg($name, \Illuminate\Support\Arr::toCssClasses($class), array_filter($attributes->getAttributes()))); ?>
<?php else: ?>
    <div <?php echo e($attributes->class($class)); ?>>
        <?php echo e($slot); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/icon.blade.php ENDPATH**/ ?>