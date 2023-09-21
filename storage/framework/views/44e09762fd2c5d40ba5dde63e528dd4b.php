<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'color' => 'gray',
    'icon' => null,
    'tag' => 'div',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'color' => 'gray',
    'icon' => null,
    'tag' => 'div',
]); ?>
<?php foreach (array_filter(([
    'color' => 'gray',
    'icon' => null,
    'tag' => 'div',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<?php echo e($tag); ?>

    <?php echo e($attributes
            ->class([
                'filament-dropdown-header flex w-full gap-2 p-3 text-sm',
                is_string($color) ? "filament-dropdown-header-color-{$color}" : null,
                match ($color) {
                    'gray' => 'text-gray-700 dark:text-gray-200',
                    default => 'text-custom-600 dark:text-custom-400',
                },
            ])
            ->style([
                \Filament\Support\get_color_css_variables($color, shades: [400, 600]) => $color !== 'gray',
            ])); ?>

>
    <?php if($icon): ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'support::dropdown.header','size' => 'h-5 w-5','class' => 'filament-dropdown-header-icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'support::dropdown.header','size' => 'h-5 w-5','class' => 'filament-dropdown-header-icon']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    <?php endif; ?>

    <span class="filament-dropdown-header-label">
        <?php echo e($slot); ?>

    </span>
</<?php echo e($tag); ?>>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/dropdown/header.blade.php ENDPATH**/ ?>