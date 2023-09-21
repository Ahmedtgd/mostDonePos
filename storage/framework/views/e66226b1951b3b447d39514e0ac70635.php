<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'active' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'hasGroupedBorder' => false,
    'last' => false,
    'first' => false,
    'icon' => null,
    'shouldOpenUrlInNewTab' => false,
    'url',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'active' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'hasGroupedBorder' => false,
    'last' => false,
    'first' => false,
    'icon' => null,
    'shouldOpenUrlInNewTab' => false,
    'url',
]); ?>
<?php foreach (array_filter(([
    'active' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'hasGroupedBorder' => false,
    'last' => false,
    'first' => false,
    'icon' => null,
    'shouldOpenUrlInNewTab' => false,
    'url',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<li
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'filament-sidebar-item',
        'filament-sidebar-item-active' => $active,
    ]); ?>"
>
    <a
        href="<?php echo e($url); ?>"
        <?php if($shouldOpenUrlInNewTab): ?> target="_blank" <?php endif; ?>
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches && $store.sidebar.close()"
        <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
            x-data="{ tooltip: {} }"
            x-init="
                Alpine.effect(() => {
                    if (Alpine.store('sidebar').isOpen) {
                        tooltip = false
                    } else {
                        tooltip = {
                            content: <?php echo \Illuminate\Support\Js::from($slot->toHtml())->toHtml() ?>,
                            theme: Alpine.store('theme') === 'light' ? 'dark' : 'light',
                            placement: document.dir === 'rtl' ? 'left' : 'right',
                        }
                    }
                })
            "
            x-tooltip.html="tooltip"
        <?php endif; ?>
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'relative flex items-center justify-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 outline-none transition hover:bg-gray-950/5 focus:bg-gray-950/5 dark:text-gray-300 dark:hover:bg-white/5 dark:focus:bg-white/5',
            'bg-gray-950/5 text-primary-600 dark:bg-white/5 dark:text-primary-400' => $active,
        ]); ?>"
    >
        <?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => ($active && $activeIcon) ? $activeIcon : $icon,'alias' => 'panels::sidebar.item','color' => 'text-custom-600 dark:text-custom-400','size' => 'h-6 w-6','style' => \Filament\Support\get_color_css_variables(($active ? 'primary' : 'gray'), shades: [400, 600])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($active && $activeIcon) ? $activeIcon : $icon),'alias' => 'panels::sidebar.item','color' => 'text-custom-600 dark:text-custom-400','size' => 'h-6 w-6','style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\get_color_css_variables(($active ? 'primary' : 'gray'), shades: [400, 600]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php elseif($hasGroupedBorder): ?>
            <div
                class="filament-sidebar-item-grouped-border relative flex h-6 w-6 items-center justify-center"
            >
                <?php if(! $first): ?>
                    <div
                        class="absolute -top-1/2 bottom-1/2 w-px bg-gray-300 dark:bg-gray-600"
                    ></div>
                <?php endif; ?>

                <?php if(! $last): ?>
                    <div
                        class="absolute -bottom-1/2 top-1/2 w-px bg-gray-300 dark:bg-gray-600"
                    ></div>
                <?php endif; ?>

                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'relative h-1.5 w-1.5 rounded-full',
                        'bg-gray-400' => ! $active,
                        'bg-primary-600 dark:bg-primary-400' => $active,
                    ]); ?>"
                ></div>
            </div>
        <?php endif; ?>

        <span
            <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
                x-show="$store.sidebar.isOpen"
                x-transition:enter="delay-100 lg:transition"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
            <?php endif; ?>
            class="flex-1"
        >
            <?php echo e($slot); ?>

        </span>

        <?php if(filled($badge)): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.sidebar.badge','data' => ['badge' => $badge,'badgeColor' => $badgeColor,'active' => $active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.sidebar.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($active)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>
    </a>
</li>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/app/sidebar/item.blade.php ENDPATH**/ ?>