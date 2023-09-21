<?php
    $datalistOptions = $getDatalistOptions();
    $id = $getId();
    $isConcealed = $isConcealed();
    $mask = $getMask();
    $statePath = $getStatePath();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field]); ?>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-forms::components.affixes','data' => ['statePath' => $statePath,'prefix' => $prefixLabel,'prefixActions' => $getPrefixActions(),'prefixIcon' => $prefixIcon,'suffix' => $suffixLabel,'suffixActions' => $getSuffixActions(),'suffixIcon' => $suffixIcon,'class' => 'filament-forms-text-input-component','attributes' => \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-forms::affixes'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['state-path' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statePath),'prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixLabel),'prefix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getPrefixActions()),'prefix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixIcon),'suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixLabel),'suffix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSuffixActions()),'suffix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixIcon),'class' => 'filament-forms-text-input-component','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($getExtraAttributeBag()))]); ?>
        <input
            x-data="{}"
            <?php if(filled($mask)): ?>
                x-mask<?php echo e($mask instanceof \Filament\Support\RawJs ? ':dynamic' : null); ?>="<?php echo e($mask); ?>"
            <?php endif; ?>
            x-bind:class="{
                'border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:focus:border-primary-500':
                    ! (<?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors),
                'border-danger-600 ring-danger-600 dark:border-danger-400 dark:ring-danger-400':
                    <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors,
            }"
            <?php echo e($getExtraInputAttributeBag()
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->merge([
                        'autocapitalize' => $getAutocapitalize(),
                        'autocomplete' => $getAutocomplete(),
                        'autofocus' => $isAutofocused(),
                        'disabled' => $isDisabled(),
                        'id' => $id,
                        'inputmode' => $getInputMode(),
                        'list' => $datalistOptions ? "{$id}-list" : null,
                        'max' => (! $isConcealed) ? $getMaxValue() : null,
                        'maxlength' => (! $isConcealed) ? $getMaxLength() : null,
                        'min' => (! $isConcealed) ? $getMinValue() : null,
                        'minlength' => (! $isConcealed) ? $getMinLength() : null,
                        'placeholder' => $getPlaceholder(),
                        'readonly' => $isReadOnly(),
                        'required' => $isRequired() && (! $isConcealed),
                        'step' => $getStep(),
                        'type' => blank($mask) ? $getType() : 'text',
                        $applyStateBindingModifiers('wire:model') => $statePath,
                    ], escape: false)
                    ->class([
                        'filament-forms-input block w-full shadow-sm outline-none transition duration-75 placeholder:text-gray-500 focus:relative focus:z-[1] focus:ring-1 focus:ring-inset disabled:opacity-70 dark:bg-gray-700 dark:text-white sm:text-sm',
                        'rounded-s-lg' => ! ($prefixLabel || $prefixIcon),
                        'rounded-e-lg' => ! ($suffixLabel || $suffixIcon),
                    ])); ?>

        />
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <?php if($datalistOptions): ?>
        <datalist id="<?php echo e($id); ?>-list">
            <?php $__currentLoopData = $datalistOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($option); ?>" />
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </datalist>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/forms/src/../resources/views/components/text-input.blade.php ENDPATH**/ ?>