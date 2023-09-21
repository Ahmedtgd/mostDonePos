<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'inline' => false,
    'keyBindings' => null,
    'label' => null,
    'size' => 'md',
    'tag' => 'button',
    'tooltip' => null,
    'type' => 'button',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'inline' => false,
    'keyBindings' => null,
    'label' => null,
    'size' => 'md',
    'tag' => 'button',
    'tooltip' => null,
    'type' => 'button',
]); ?>
<?php foreach (array_filter(([
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'inline' => false,
    'keyBindings' => null,
    'label' => null,
    'size' => 'md',
    'tag' => 'button',
    'tooltip' => null,
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $iconSize ??= $size;

    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        'filament-icon-button relative flex items-center justify-center text-custom-500 outline-none transition disabled:pointer-events-none disabled:opacity-70',
        'rounded-full hover:bg-gray-500/5 focus:bg-custom-500/10 dark:hover:bg-gray-300/5' => ! $inline,
        match ($size) {
            'sm' => 'h-8 w-8',
            'sm md:md' => 'h-8 w-8 md:h-10 md:w-10',
            'md' => 'h-10 w-10',
            'lg' => 'h-12 w-12',
            default => $size,
        },
    ]);

    $buttonStyles = \Filament\Support\get_color_css_variables($color, shades: [500]);

    $iconSize = match ($iconSize) {
        'sm' => 'h-4 w-4',
        'sm md:md' => 'h-4 w-4 md:h-5 md:w-5',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
        default => $iconSize,
    };

    $iconClasses = 'filament-icon-button-icon';

    $indicatorClasses = 'filament-icon-button-indicator absolute -end-0.5 -top-0.5 inline-flex h-4 w-4 items-center justify-center rounded-full bg-custom-600 text-[0.5rem] font-medium text-white';

    $indicatorStyles = \Filament\Support\get_color_css_variables($indicatorColor, shades: [600]);

    $wireTarget = $attributes->whereStartsWith(['wire:target', 'wire:click'])->first();

    $hasLoadingIndicator = filled($wireTarget) || ($type === 'submit' && filled($form));

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget ?: $form, ENT_QUOTES);
    }
?>

<?php if($tag === 'button'): ?>
    <button
        <?php if($keyBindings || $tooltip): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
            x-tooltip.raw="<?php echo e($tooltip); ?>"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled,
                    'title' => $label,
                    'type' => $type,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($label): ?>
            <span class="sr-only">
                <?php echo e($label); ?>

            </span>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => $iconAlias,'group' => 'support::icon-button','size' => $iconSize,'class' => $iconClasses,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'group' => 'support::icon-button','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

        <?php if($hasLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['wire:loading.delay' => '','wire:target' => $loadingIndicatorTarget,'class' => $iconClasses . ' ' . $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.delay' => '','wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loadingIndicatorTarget),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $iconSize)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if($indicator): ?>
            <span
                class="<?php echo e($indicatorClasses); ?>"
                style="<?php echo e($indicatorStyles); ?>"
            >
                <?php echo e($indicator); ?>

            </span>
        <?php endif; ?>
    </button>
<?php elseif($tag === 'a'): ?>
    <a
        <?php if($keyBindings || $tooltip): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
            x-tooltip.raw="<?php echo e($tooltip); ?>"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'title' => $label,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($label): ?>
            <span class="sr-only">
                <?php echo e($label); ?>

            </span>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'support::icon-button','size' => $iconSize,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'support::icon-button','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

        <?php if($indicator): ?>
            <span
                class="<?php echo e($indicatorClasses); ?>"
                style="<?php echo e($indicatorStyles); ?>"
            >
                <?php echo e($indicator); ?>

            </span>
        <?php endif; ?>
    </a>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/icon-button.blade.php ENDPATH**/ ?>