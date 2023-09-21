<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'active' => false,
    'disabled' => false,
    'icon' => false,
    'label' => null,
    'separator' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'active' => false,
    'disabled' => false,
    'icon' => false,
    'label' => null,
    'separator' => false,
]); ?>
<?php foreach (array_filter(([
    'active' => false,
    'disabled' => false,
    'icon' => false,
    'label' => null,
    'separator' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<li>
    <button
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled || $separator,
                    'type' => 'button',
                ], escape: false)
                ->class([
                    'filament-tables-pagination-item relative -my-3 flex h-8 min-w-[2rem] items-center justify-center rounded-md px-1.5 font-medium outline-none disabled:pointer-events-none disabled:opacity-70',
                    'hover:bg-gray-500/5 focus:bg-primary-500/10 focus:ring-2 focus:ring-primary-500 dark:hover:bg-gray-400/5' => (! $active) && (! $disabled) && (! $separator),
                    'focus:text-primary-600' => (! $active) && (! $disabled) && (! $icon) && (! $separator),
                    'transition' => ((! $active) && (! $disabled) && (! $separator)) || $active,
                    'text-primary-600' => ((! $active) && (! $disabled) && $icon && (! $separator)) || $active,
                    'filament-tables-pagination-item-active bg-primary-500/10 ring-2 ring-primary-500 focus:underline' => $active,
                    'filament-tables-pagination-item-disabled' => $disabled,
                    'filament-tables-pagination-item-separator cursor-default' => $separator,
                ])); ?>

    >
        <?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'tables::pagination.item','size' => 'h-5 w-5','class' => 'rtl:-scale-x-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'tables::pagination.item','size' => 'h-5 w-5','class' => 'rtl:-scale-x-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <span><?php echo e($label ?? ($separator ? '...' : '')); ?></span>
    </button>
</li>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/pagination/item.blade.php ENDPATH**/ ?>