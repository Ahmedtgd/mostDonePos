<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'footer' => null,
    'header' => null,
    'reorderable' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'footer' => null,
    'header' => null,
    'reorderable' => false,
]); ?>
<?php foreach (array_filter(([
    'footer' => null,
    'header' => null,
    'reorderable' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<table
    <?php echo e($attributes->class(['filament-tables-table w-full table-auto divide-y text-start dark:divide-gray-700'])); ?>

>
    <?php if($header): ?>
        <thead>
            <tr class="bg-gray-500/5">
                <?php echo e($header); ?>

            </tr>
        </thead>
    <?php endif; ?>

    <tbody
        <?php if($reorderable): ?>
            x-sortable
            x-on:end.stop="$wire.reorderTable($event.target.sortable.toArray())"
        <?php endif; ?>
        class="divide-y whitespace-nowrap dark:divide-gray-700"
    >
        <?php echo e($slot); ?>

    </tbody>

    <?php if($footer): ?>
        <tfoot>
            <tr class="bg-gray-50">
                <?php echo e($footer); ?>

            </tr>
        </tfoot>
    <?php endif; ?>
</table>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/table.blade.php ENDPATH**/ ?>