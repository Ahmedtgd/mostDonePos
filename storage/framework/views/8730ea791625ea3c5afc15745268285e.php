<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'color' => 'gray',
    'detail' => null,
    'disabled' => false,
    'icon' => null,
    'iconSize' => 'md',
    'image' => null,
    'keyBindings' => null,
    'tag' => 'button',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'color' => 'gray',
    'detail' => null,
    'disabled' => false,
    'icon' => null,
    'iconSize' => 'md',
    'image' => null,
    'keyBindings' => null,
    'tag' => 'button',
]); ?>
<?php foreach (array_filter(([
    'color' => 'gray',
    'detail' => null,
    'disabled' => false,
    'icon' => null,
    'iconSize' => 'md',
    'image' => null,
    'keyBindings' => null,
    'tag' => 'button',
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
        'filament-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors outline-none disabled:pointer-events-none disabled:opacity-70',
        is_string($color) ? "filament-dropdown-list-item-color-{$color}" : null,
        match ($color) {
            'gray' => 'filament-dropdown-list-item-color-gray text-gray-700 hover:bg-gray-500/10 focus:bg-gray-500/10 dark:text-gray-200',
            default => 'filament-dropdown-list-item-color-custom text-custom-600 hover:bg-custom-500/10 focus:bg-custom-500/10 dark:text-custom-400',
        },
    ]);

    $buttonStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables($color, shades: [400, 500, 600]) => $color !== 'gray',
    ]);

    $iconSize = match ($iconSize) {
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
        default => $iconSize,
    };

    $iconClasses = 'filament-dropdown-list-item-icon shrink-0';

    $imageClasses = 'filament-dropdown-list-item-image h-5 w-5 shrink-0 rounded-full bg-gray-200 bg-cover bg-center dark:bg-gray-900';

    $labelClasses = 'filament-dropdown-list-item-label w-full truncate text-start';

    $detailClasses = 'filament-dropdown-list-item-detail ms-auto text-xs';

    $wireTarget = $attributes->whereStartsWith(['wire:target', 'wire:click'])->first();

    $hasLoadingIndicator = filled($wireTarget);

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget, ENT_QUOTES);
    }
?>

<?php if($tag === 'button'): ?>
    <button
        <?php if($keyBindings): ?>
            x-data="{}"
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled,
                    'type' => 'button',
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'support::dropdown.list.item','size' => $iconSize,'class' => $iconClasses,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'support::dropdown.list.item','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if($image): ?>
            <div
                class="<?php echo e($imageClasses); ?>"
                style="background-image: url('<?php echo e($image); ?>')"
            ></div>
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

        <span class="<?php echo e($labelClasses); ?>">
            <?php echo e($slot); ?>

        </span>

        <?php if($detail): ?>
            <span class="<?php echo e($detailClasses); ?>">
                <?php echo e($detail); ?>

            </span>
        <?php endif; ?>
    </button>
<?php elseif($tag === 'a'): ?>
    <a
        <?php if($keyBindings): ?>
            x-data="{}"
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php echo e($attributes
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'support::dropdown.list.item','size' => $iconSize,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'support::dropdown.list.item','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if($image): ?>
            <div
                class="<?php echo e($imageClasses); ?>"
                style="background-image: url('<?php echo e($image); ?>')"
            ></div>
        <?php endif; ?>

        <span class="<?php echo e($labelClasses); ?>">
            <?php echo e($slot); ?>

        </span>

        <?php if($detail): ?>
            <span class="<?php echo e($detailClasses); ?>">
                <?php echo e($detail); ?>

            </span>
        <?php endif; ?>
    </a>
<?php elseif($tag === 'form'): ?>
    <form
        <?php echo e($attributes->only(['action', 'class', 'method', 'wire:submit.prevent'])); ?>

    >
        <?php echo csrf_field(); ?>

        <button
            <?php if($keyBindings): ?>
                x-data="{}"
                x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

            <?php endif; ?>
            type="submit"
            <?php echo e($attributes
                    ->except(['action', 'class', 'method', 'wire:submit.prevent'])
                    ->class([$buttonClasses])
                    ->style([$buttonStyles])); ?>

        >
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'support::dropdown.list.item','size' => $iconSize,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'support::dropdown.list.item','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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

            <?php if($detail): ?>
                <span class="<?php echo e($detailClasses); ?>">
                    <?php echo e($detail); ?>

                </span>
            <?php endif; ?>
        </button>
    </form>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/dropdown/list/item.blade.php ENDPATH**/ ?>