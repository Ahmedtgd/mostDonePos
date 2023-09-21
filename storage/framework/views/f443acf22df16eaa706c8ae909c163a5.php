<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'icon' => null,
    'iconPosition' => 'before',
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
    'outlined' => false,
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
    'iconPosition' => 'before',
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
    'outlined' => false,
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
    'iconPosition' => 'before',
    'iconSize' => null,
    'indicator' => null,
    'indicatorColor' => 'primary',
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
    'outlined' => false,
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
    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        ...[
            "filament-button filament-button-size-{$size} relative grid-flow-col items-center justify-center rounded-lg font-medium outline-none transition focus:ring-2 disabled:pointer-events-none disabled:opacity-70",
            is_string($color) ? "filament-button-color-{$color}" : null,
            match ($size) {
                'xs' => 'gap-1 px-2 py-1.5 text-xs',
                'sm' => 'gap-1 px-2.5 py-1.5 text-sm',
                'md' => 'gap-1.5 px-3 py-2 text-sm',
                'lg' => 'gap-1.5 px-3.5 py-2.5 text-sm',
                'xl' => 'gap-1.5 px-4 py-3 text-sm',
            },
            'hidden' => $labeledFrom,
            match ($labeledFrom) {
                'sm' => 'sm:inline-grid',
                'md' => 'md:inline-grid',
                'lg' => 'lg:inline-grid',
                'xl' => 'xl:inline-grid',
                '2xl' => '2xl:inline-grid',
                default => 'inline-grid',
            },
        ],
        ...(
            $outlined
                ? [
                    'filament-button-outlined ring-1 ',
                    match ($color) {
                        'gray' => 'ring-gray-600 text-gray-700 hover:bg-gray-500/10 focus:bg-gray-500/10 focus:ring-gray-500/50 dark:ring-gray-300/70 dark:text-gray-200',
                        default => 'ring-custom-600 text-custom-600 hover:bg-custom-500/10 focus:bg-custom-500/10 focus:ring-custom-500/50 dark:ring-custom-400 dark:text-custom-400 dark:focus:ring-custom-300/70',
                    },
                ]
                : [
                    'shadow',
                    match ($color) {
                        'gray' => 'ring-gray-950/10 ring-1 bg-white text-gray-700 hover:bg-gray-50 focus:bg-gray-50 focus:ring-2 dark:ring-white/20 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:ring-white/30 dark:focus:ring-white/30',
                        default => 'bg-custom-600 text-white hover:bg-custom-500 focus:bg-custom-500 focus:ring-custom-500/50',
                    },
                ]
        ),
    ]);

    $buttonStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables(
            $color,
            shades: $outlined ? [300, 400, 500, 600] : [500, 600],
        ) => $color !== 'gray',
    ]);

    $iconSize ??= match ($size) {
        'xs', 'sm' => 'sm',
        default => 'md',
    };

    $iconSize = match ($iconSize) {
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
        default => $iconSize,
    };

    $iconClasses = 'filament-button-icon';

    $indicatorClasses = 'filament-button-indicator absolute -end-1 -top-1 inline-flex h-4 w-4 items-center justify-center rounded-full bg-custom-600 text-[0.5rem] font-medium text-white';

    $indicatorStyles = \Filament\Support\get_color_css_variables($indicatorColor, shades: [600]);

    $labelClasses = \Illuminate\Support\Arr::toCssClasses([
        'filament-button-label',
        'sr-only' => $labelSrOnly,
    ]);

    $wireTarget = $attributes->whereStartsWith(['wire:target', 'wire:click'])->first();

    $hasFileUploadLoadingIndicator = $type === 'submit' && filled($form);
    $hasLoadingIndicator = filled($wireTarget) || $hasFileUploadLoadingIndicator;

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget ?: $form, ENT_QUOTES);
    }
?>

<?php if($labeledFrom): ?>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => $color,'disabled' => $disabled,'form' => $form,'icon' => $icon,'iconSize' => $iconSize,'indicator' => $indicator,'indicatorColor' => $indicatorColor,'keyBindings' => $keyBindings,'label' => $slot,'size' => $size,'tag' => $tag,'tooltip' => $tooltip,'type' => $type,'class' => 
            match ($labeledFrom) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
                default => 'hidden',
            }
        ,'attributes' => \Filament\Support\prepare_inherited_attributes($attributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($form),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'indicator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($indicator),'indicator-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($indicatorColor),'key-bindings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keyBindings),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slot),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tag),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            match ($labeledFrom) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
                default => 'hidden',
            }
        ),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($attributes))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php endif; ?>

<?php if($tag === 'button'): ?>
    <button
        <?php if(($keyBindings || $tooltip) && (! $hasFileUploadLoadingIndicator)): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
            x-tooltip.raw="<?php echo e($tooltip); ?>"
        <?php endif; ?>
        <?php if($hasFileUploadLoadingIndicator): ?>
            x-data="{
                form: null,
                isUploadingFile: false,
            }"
            x-init="
                form = $el.closest('form')

                form?.addEventListener('file-upload-started', () => {
                    isUploadingFile = true
                })

                form?.addEventListener('file-upload-finished', () => {
                    isUploadingFile = false
                })
            "
            x-bind:class="{ 'enabled:opacity-70 enabled:cursor-wait': isUploadingFile }"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled,
                    'type' => $type,
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
                    'x-bind:disabled' => $hasFileUploadLoadingIndicator ? 'isUploadingFile' : false,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($iconPosition === 'before'): ?>
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'group' => 'support::button.prefix','size' => $iconSize,'class' => $iconClasses,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'group' => 'support::button.prefix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
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

            <?php if($hasFileUploadLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xShow' => 'isUploadingFile','xCloak' => 'x-cloak','class' => $iconClasses . ' ' . $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isUploadingFile','x-cloak' => 'x-cloak','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $iconSize)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <span
            <?php if($hasFileUploadLoadingIndicator): ?>
                x-show="! isUploadingFile"
            <?php endif; ?>
            class="<?php echo e($labelClasses); ?>"
        >
            <?php echo e($slot); ?>

        </span>

        <?php if($hasFileUploadLoadingIndicator): ?>
            <span x-show="isUploadingFile" x-cloak>
                <?php echo e(__('filament-support::components/button.messages.uploading_file')); ?>

            </span>
        <?php endif; ?>

        <?php if($iconPosition === 'after'): ?>
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'group' => 'support::button.suffix','size' => $iconSize,'class' => $iconClasses,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'group' => 'support::button.suffix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
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

            <?php if($hasFileUploadLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xShow' => 'isUploadingFile','xCloak' => 'x-cloak','class' => $iconClasses . ' ' . $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isUploadingFile','x-cloak' => 'x-cloak','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $iconSize)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
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
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($icon && $iconPosition === 'before'): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'group' => 'support::button.prefix','size' => $iconSize,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'group' => 'support::button.prefix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <span class="<?php echo e($labelClasses); ?>">
            <?php echo e($slot); ?>

        </span>

        <?php if($icon && $iconPosition === 'after'): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'group' => 'support::button.suffix','size' => $iconSize,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'group' => 'support::button.suffix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
    </a>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/button.blade.php ENDPATH**/ ?>