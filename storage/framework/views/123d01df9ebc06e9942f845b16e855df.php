<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'activelySorted' => false,
    'name',
    'sortable' => false,
    'sortDirection',
    'alignment' => null,
    'wrap' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'activelySorted' => false,
    'name',
    'sortable' => false,
    'sortDirection',
    'alignment' => null,
    'wrap' => false,
]); ?>
<?php foreach (array_filter(([
    'activelySorted' => false,
    'name',
    'sortable' => false,
    'sortDirection',
    'alignment' => null,
    'wrap' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<th <?php echo e($attributes->class(['filament-tables-header-cell p-0'])); ?>>
    <button
        <?php if($sortable): ?>
            wire:click="sortTable('<?php echo e($name); ?>')"
        <?php endif; ?>
        type="button"
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'flex w-full items-center gap-x-1 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300',
            'cursor-default' => ! $sortable,
            'whitespace-nowrap' => ! $wrap,
            'whitespace-normal' => $wrap,
            match ($alignment) {
                'center' => 'justify-center',
                'end' => 'justify-end',
                'left' => 'justify-start rtl:flex-row-reverse',
                'right' => 'justify-end rtl:flex-row-reverse',
                'start' => 'justify-start',
                default => null,
            },
        ]); ?>"
    >
        <?php if($sortable): ?>
            <span class="sr-only">
                <?php echo e(__('filament-tables::table.sorting.fields.column.label')); ?>

            </span>
        <?php endif; ?>

        <span>
            <?php echo e($slot); ?>

        </span>

        <?php if($sortable): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down','alias' => $activelySorted && $sortDirection === 'asc' ? 'filament-tables::header-cell.sort-asc' : 'filament-tables::header-cell.sort-desc','color' => 'dark:text-gray-300','size' => 'h-5 w-5','class' => 
                    [
                        'filament-tables-header-cell-sort-icon',
                        'opacity-25' => ! $activelySorted,
                    ]
                ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down'),'alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activelySorted && $sortDirection === 'asc' ? 'filament-tables::header-cell.sort-asc' : 'filament-tables::header-cell.sort-desc'),'color' => 'dark:text-gray-300','size' => 'h-5 w-5','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    [
                        'filament-tables-header-cell-sort-icon',
                        'opacity-25' => ! $activelySorted,
                    ]
                )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

            <span class="sr-only">
                <?php echo e($sortDirection === 'asc' ? __('filament-tables::table.sorting.fields.direction.options.desc') : __('filament-tables::table.sorting.fields.direction.options.asc')); ?>

            </span>
        <?php endif; ?>
    </button>
</th>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/header-cell.blade.php ENDPATH**/ ?>