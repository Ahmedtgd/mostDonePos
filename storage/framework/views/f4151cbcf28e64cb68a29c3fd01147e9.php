<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'prefix' => null,
    'prefixActions' => [],
    'prefixIcon' => null,
    'statePath' => null,
    'suffix' => null,
    'suffixActions' => [],
    'suffixIcon' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'prefix' => null,
    'prefixActions' => [],
    'prefixIcon' => null,
    'statePath' => null,
    'suffix' => null,
    'suffixActions' => [],
    'suffixIcon' => null,
]); ?>
<?php foreach (array_filter(([
    'prefix' => null,
    'prefixActions' => [],
    'prefixIcon' => null,
    'statePath' => null,
    'suffix' => null,
    'suffixActions' => [],
    'suffixIcon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $baseAffixClasses = 'flex items-center self-stretch whitespace-nowrap border border-gray-300 px-2 shadow-sm group-focus-within:text-primary-500 dark:border-gray-600 dark:bg-gray-700';

    $prefixActions = array_filter(
        $prefixActions,
        fn (\Filament\Forms\Components\Actions\Action $prefixAction): bool => $prefixAction->isVisible(),
    );

    $suffixActions = array_filter(
        $suffixActions,
        fn (\Filament\Forms\Components\Actions\Action $suffixAction): bool => $suffixAction->isVisible(),
    );
?>

<div
    <?php echo e($attributes->class(['filament-forms-affix-container group flex rtl:space-x-reverse'])); ?>

>
    <?php if(count($prefixActions)): ?>
        <div class="flex items-center gap-1 self-stretch pe-2">
            <?php $__currentLoopData = $prefixActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prefixAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($prefixAction); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($prefixIcon): ?>
        <span
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                $baseAffixClasses,
                '-me-px rounded-s-lg',
            ]); ?>"
            <?php if(filled($statePath)): ?>
                x-bind:class="{
                    'text-gray-400': ! (<?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors),
                    'text-danger-400': <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors,
                }"
            <?php endif; ?>
        >
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => 'forms::components.affixes.prefix','name' => $prefixIcon,'size' => 'h-5 w-5','class' => 'filament-input-affix-icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => 'forms::components.affixes.prefix','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixIcon),'size' => 'h-5 w-5','class' => 'filament-input-affix-icon']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </span>
    <?php endif; ?>

    <?php if(filled($prefix)): ?>
        <span
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'filament-input-affix-label -me-px text-sm',
                $baseAffixClasses,
                'rounded-s-lg' => ! $prefixIcon,
            ]); ?>"
            <?php if(filled($statePath)): ?>
                x-bind:class="{
                    'text-gray-400': ! (<?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors),
                    'text-danger-400': <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors,
                }"
            <?php endif; ?>
        >
            <?php echo e($prefix); ?>

        </span>
    <?php endif; ?>

    <div class="min-w-0 flex-1">
        <?php echo e($slot); ?>

    </div>

    <?php if(filled($suffix)): ?>
        <span
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'filament-input-affix-label -ms-px text-sm',
                $baseAffixClasses,
                'rounded-e-lg' => ! $suffixIcon,
            ]); ?>"
            <?php if(filled($statePath)): ?>
                x-bind:class="{
                    'text-gray-400': ! (<?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors),
                    'text-danger-400': <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors,
                }"
            <?php endif; ?>
        >
            <?php echo e($suffix); ?>

        </span>
    <?php endif; ?>

    <?php if($suffixIcon): ?>
        <span
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                $baseAffixClasses,
                '-ms-px rounded-e-lg',
            ]); ?>"
            <?php if(filled($statePath)): ?>
                x-bind:class="{
                    'text-gray-400': ! (<?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors),
                    'text-danger-400': <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?> in $wire.__instance.serverMemo.errors,
                }"
            <?php endif; ?>
        >
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => 'forms::components.affixes.suffix','name' => $suffixIcon,'size' => 'h-5 w-5','class' => 'filament-input-affix-icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => 'forms::components.affixes.suffix','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixIcon),'size' => 'h-5 w-5','class' => 'filament-input-affix-icon']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </span>
    <?php endif; ?>

    <?php if(count($suffixActions)): ?>
        <div class="flex items-center gap-1 self-stretch ps-2">
            <?php $__currentLoopData = $suffixActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suffixAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($suffixAction); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/forms/src/../resources/views/components/affixes.blade.php ENDPATH**/ ?>