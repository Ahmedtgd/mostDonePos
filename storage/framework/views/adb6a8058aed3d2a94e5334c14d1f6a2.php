<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'indicators' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'indicators' => [],
]); ?>
<?php foreach (array_filter(([
    'indicators' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if(count($indicators)): ?>
    <div
        <?php echo e($attributes->class(['filament-tables-filter-indicators flex gap-x-4 bg-gray-500/5 px-4 py-1 text-sm'])); ?>

    >
        <div class="flex flex-1 flex-wrap items-center gap-x-2 gap-y-1">
            <span class="font-medium dark:text-gray-200">
                <?php echo e(__('filament-tables::table.filters.indicator')); ?>

            </span>

            <?php $__currentLoopData = $indicators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wireClickHandler => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span
                    class="filament-tables-filter-indicator min-h-6 inline-flex items-center justify-center whitespace-normal rounded-xl bg-gray-500/10 px-2 py-0.5 text-xs font-medium tracking-tight text-gray-700 dark:bg-gray-500/20 dark:text-gray-300"
                >
                    <?php echo e($label); ?>


                    <button
                        wire:click="<?php echo e($wireClickHandler); ?>"
                        wire:loading.attr="disabled"
                        wire:target="removeTableFilter"
                        type="button"
                        class="-my-1 -me-2 ms-1 rounded-full p-1 hover:bg-gray-500/10"
                    >
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-x-mark','alias' => 'tables::filters.buttons.remove','size' => 'h-3 w-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-x-mark','alias' => 'tables::filters.buttons.remove','size' => 'h-3 w-3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                        <span class="sr-only">
                            <?php echo e(__('filament-tables::table.filters.buttons.remove.label')); ?>

                        </span>
                    </button>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="shrink-0">
            <button
                wire:click="removeTableFilters"
                type="button"
                class="-mb-1.5 -me-2 -mt-0.5 rounded-full p-1.5 text-gray-600 hover:bg-gray-500/10 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-500/20 dark:hover:text-gray-300"
            >
                <div class="flex h-5 w-5 items-center justify-center">
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-x-mark','alias' => 'tables::filters.buttons.remove-all','size' => 'h-5 w-5','xTooltip.raw' => __('filament-tables::table.filters.buttons.remove_all.tooltip'),'wire:loading.remove.delay' => '','wire:target' => 'removeTableFilters,removeTableFilter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-x-mark','alias' => 'tables::filters.buttons.remove-all','size' => 'h-5 w-5','x-tooltip.raw' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.filters.buttons.remove_all.tooltip')),'wire:loading.remove.delay' => '','wire:target' => 'removeTableFilters,removeTableFilter']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['wire:loading.delay' => '','wire:target' => 'removeTableFilters,removeTableFilter','class' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.delay' => '','wire:target' => 'removeTableFilters,removeTableFilter','class' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </div>

                <span class="sr-only">
                    <?php echo e(__('filament-tables::table.filters.buttons.remove_all.label')); ?>

                </span>
            </button>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/filters/indicators.blade.php ENDPATH**/ ?>