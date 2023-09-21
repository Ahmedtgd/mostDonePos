<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'after' => null,
    'heading' => null,
    'subheading' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'after' => null,
    'heading' => null,
    'subheading' => null,
]); ?>
<?php foreach (array_filter(([
    'after' => null,
    'heading' => null,
    'subheading' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.base','data' => ['livewire' => $livewire]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($livewire)]); ?>
    <div
        class="filament-card-layout flex min-h-screen items-center justify-center py-14"
    >
        <div
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'w-screen space-y-8 px-6 md:mt-0 md:px-2',
                match ($width = $livewire->getCardWidth()) {
                    'xs' => 'max-w-xs',
                    'sm' => 'max-w-sm',
                    'md' => 'max-w-md',
                    'lg' => 'max-w-lg',
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    '3xl' => 'max-w-3xl',
                    '4xl' => 'max-w-4xl',
                    '5xl' => 'max-w-5xl',
                    '6xl' => 'max-w-6xl',
                    '7xl' => 'max-w-7xl',
                    default => $width,
                },
            ]); ?>"
        >
            <div
                class="filament-card-layout-card relative space-y-4 rounded-xl bg-white/50 p-8 shadow-2xl ring-1 ring-gray-950/5 backdrop-blur-xl dark:bg-gray-900/50 dark:ring-white/20"
            >
                <?php if($livewire->hasLogo()): ?>
                    <div class="flex w-full justify-center">
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="space-y-2">
                    <?php if(filled($heading ??= $livewire->getHeading())): ?>
                        <h2
                            class="text-center text-2xl font-bold tracking-tight"
                        >
                            <?php echo e($heading); ?>

                        </h2>
                    <?php endif; ?>

                    <?php if(filled($subheading ??= $livewire->getSubHeading())): ?>
                        <h3
                            class="text-center text-sm font-medium tracking-tight text-gray-600 dark:text-gray-300"
                        >
                            <?php echo e($subheading); ?>

                        </h3>
                    <?php endif; ?>
                </div>

                <div <?php echo e($attributes); ?>>
                    <?php echo e($slot); ?>

                </div>
            </div>

            <?php echo e($after); ?>

        </div>

        <?php if(filament()->auth()->check()): ?>
            <div
                class="absolute end-0 top-0 flex w-full items-center justify-end p-2"
            >
                <?php if(filament()->hasDatabaseNotifications()): ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filament.core.database-notifications')->html();
} elseif ($_instance->childHasBeenRendered('7vgyS2d')) {
    $componentId = $_instance->getRenderedChildComponentId('7vgyS2d');
    $componentTag = $_instance->getRenderedChildComponentTagName('7vgyS2d');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('7vgyS2d');
} else {
    $response = \Livewire\Livewire::mount('filament.core.database-notifications');
    $html = $response->html();
    $_instance->logRenderedChild('7vgyS2d', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/card.blade.php ENDPATH**/ ?>