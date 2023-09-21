<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'form',
    'maxHeight' => null,
    'triggerAction',
    'width' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'form',
    'maxHeight' => null,
    'triggerAction',
    'width' => null,
]); ?>
<?php foreach (array_filter(([
    'form',
    'maxHeight' => null,
    'triggerAction',
    'width' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['attributes' => $attributes->class(['filament-tables-column-toggling']),'maxHeight' => $maxHeight,'placement' => 'bottom-end','shift' => true,'width' => $width,'wire:key' => ''.e($this->id).'.table.toggle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes->class(['filament-tables-column-toggling'])),'max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxHeight),'placement' => 'bottom-end','shift' => true,'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($width),'wire:key' => ''.e($this->id).'.table.toggle']); ?>
     <?php $__env->slot('trigger', null, []); ?> 
        <?php echo e($triggerAction); ?>

     <?php $__env->endSlot(); ?>

    <div class="p-4">
        <?php echo e($form); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/toggleable/dropdown.blade.php ENDPATH**/ ?>