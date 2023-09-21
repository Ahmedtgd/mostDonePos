<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'wireModel' => 'tableSearch',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'wireModel' => 'tableSearch',
]); ?>
<?php foreach (array_filter(([
    'wireModel' => 'tableSearch',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div <?php echo e($attributes->class(['filament-tables-search-input'])); ?>>
    <label class="group relative flex items-center">
        <span
            class="filament-tables-search-input-icon-wrapper pointer-events-none absolute inset-y-0 start-0 flex h-9 w-9 items-center justify-center"
        >
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-magnifying-glass','alias' => 'tables::search-input.prefix','color' => 'text-gray-400','size' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-magnifying-glass','alias' => 'tables::search-input.prefix','color' => 'text-gray-400','size' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </span>

        <input
            wire:model.debounce.500ms="<?php echo e($wireModel); ?>"
            placeholder="<?php echo e(__('filament-tables::table.fields.search.placeholder')); ?>"
            type="text"
            autocomplete="off"
            class="block h-9 w-full min-w-[8rem] max-w-xs rounded-lg border-gray-300 ps-9 placeholder-gray-400 shadow-sm outline-none transition duration-75 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
        />

        <span class="sr-only">
            <?php echo e(__('filament-tables::table.fields.search.label')); ?>

        </span>
    </label>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/search-input.blade.php ENDPATH**/ ?>