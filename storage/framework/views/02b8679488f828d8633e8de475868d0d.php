<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['form','tag','xOn:click','wire:click','href','target','type','color','keyBindings','tooltip','disabled','icon','indicator','indicatorColor','size','labelSrOnly','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition','iconSize']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['form','tag','xOn:click','wire:click','href','target','type','color','keyBindings','tooltip','disabled','icon','indicator','indicatorColor','size','labelSrOnly','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition','iconSize']); ?>
<?php foreach (array_filter((['form','tag','xOn:click','wire:click','href','target','type','color','keyBindings','tooltip','disabled','icon','indicator','indicatorColor','size','labelSrOnly','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition','iconSize']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button','data' => ['form' => $form,'tag' => $tag,'xOn:click' => $xOnClick,'wire:click' => $wireClick,'href' => $href,'target' => $target,'type' => $type,'color' => $color,'keyBindings' => $keyBindings,'tooltip' => $tooltip,'disabled' => $disabled,'icon' => $icon,'indicator' => $indicator,'indicatorColor' => $indicatorColor,'size' => $size,'labelSrOnly' => $labelSrOnly,'class' => $class,'outlined' => $outlined,'labeledFrom' => $labeledFrom,'iconPosition' => $iconPosition,'iconSize' => $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($form),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tag),'x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($xOnClick),'wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wireClick),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($href),'target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($target),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'key-bindings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keyBindings),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'indicator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($indicator),'indicator-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($indicatorColor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'label-sr-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelSrOnly),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class),'outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($outlined),'labeledFrom' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labeledFrom),'iconPosition' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition),'iconSize' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labeledFrom),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?><?php /**PATH /home/k/Documents/spatie/mostDonePos/storage/framework/views/37e6e7489f140f00bd359327eede871c.blade.php ENDPATH**/ ?>