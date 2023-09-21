<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'collapsible' => true,
    'hasItemIcons' => false,
    'icon' => null,
    'items' => [],
    'label' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'collapsible' => true,
    'hasItemIcons' => false,
    'icon' => null,
    'items' => [],
    'label' => null,
]); ?>
<?php foreach (array_filter(([
    'collapsible' => true,
    'hasItemIcons' => false,
    'icon' => null,
    'items' => [],
    'label' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<li
    x-data="{ label: <?php echo \Illuminate\Support\Js::from($label)->toHtml() ?> }"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'filament-sidebar-group grid gap-y-1',
    ]); ?>"
>
    <?php if($label): ?>
        <div
            <?php if($collapsible): ?>
                x-on:click="$store.sidebar.toggleCollapsedGroup(label)"
            <?php endif; ?>
            <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
                x-show="$store.sidebar.isOpen"
                x-transition:enter="delay-100 lg:transition"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
            <?php endif; ?>
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'flex items-center gap-x-3 px-3 py-2',
                'cursor-pointer' => $collapsible,
            ]); ?>"
        >
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'panels::sidebar.group','color' => 'text-gray-600 dark:text-gray-400','size' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'panels::sidebar.group','color' => 'text-gray-600 dark:text-gray-400','size' => 'h-6 w-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>

            <span
                class="flex-1 text-sm font-medium text-gray-700 dark:text-gray-300"
            >
                <?php echo e($label); ?>

            </span>

            <?php if($collapsible): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => 'heroicon-m-chevron-down','iconAlias' => 'panels::sidebar.group.collapse','xOn:click.stop' => '$store.sidebar.toggleCollapsedGroup(label)','xBind:class' => '{ \'rotate-180\': ! $store.sidebar.groupIsCollapsed(label) }','class' => '-my-2.5 -me-2.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => 'heroicon-m-chevron-down','icon-alias' => 'panels::sidebar.group.collapse','x-on:click.stop' => '$store.sidebar.toggleCollapsedGroup(label)','x-bind:class' => '{ \'rotate-180\': ! $store.sidebar.groupIsCollapsed(label) }','class' => '-my-2.5 -me-2.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <ul
        x-show="! ($store.sidebar.groupIsCollapsed(label) && ($store.sidebar.isOpen || <?php echo \Illuminate\Support\Js::from(! filament()->isSidebarCollapsibleOnDesktop())->toHtml() ?>))"
        <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
            x-transition:enter="delay-100 lg:transition"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
        <?php endif; ?>
        x-collapse.duration.200ms
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'grid gap-y-1',
        ]); ?>"
    >
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->isVisible()): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.sidebar.item','data' => ['active' => $item->isActive(),'hasGroupedBorder' => ! $hasItemIcons,'icon' => $item->getIcon(),'first' => $loop->first,'last' => $loop->last,'activeIcon' => $item->getActiveIcon(),'url' => $item->getUrl(),'badge' => $item->getBadge(),'badgeColor' => $item->getBadgeColor(),'shouldOpenUrlInNewTab' => $item->shouldOpenUrlInNewTab()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.sidebar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->isActive()),'has-grouped-border' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $hasItemIcons),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getIcon()),'first' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop->first),'last' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop->last),'active-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getActiveIcon()),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl()),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadge()),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadgeColor()),'should-open-url-in-new-tab' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->shouldOpenUrlInNewTab())]); ?>
                    <?php echo e($item->getLabel()); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/app/sidebar/group.blade.php ENDPATH**/ ?>