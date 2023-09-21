<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'recordAction' => null,
    'recordUrl' => null,
    'striped' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'recordAction' => null,
    'recordUrl' => null,
    'striped' => false,
]); ?>
<?php foreach (array_filter(([
    'recordAction' => null,
    'recordUrl' => null,
    'striped' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<tr
    <?php echo e($attributes->class([
            'filament-tables-row transition',
            'hover:bg-gray-50 dark:hover:bg-gray-500/10' => $recordUrl || $recordAction,
            'even:bg-gray-100 dark:even:bg-gray-900' => $striped,
        ])); ?>

>
    <?php echo e($slot); ?>

</tr>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/row.blade.php ENDPATH**/ ?>