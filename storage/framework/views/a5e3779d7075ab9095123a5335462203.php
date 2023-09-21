<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'navigation',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'navigation',
]); ?>
<?php foreach (array_filter(([
    'navigation',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<aside
    x-data="{}"
    <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
        x-cloak
        x-bind:class="
            $store.sidebar.isOpen
                ? 'filament-sidebar-open translate-x-0 max-w-[20em] lg:max-w-[--sidebar-width]'
                : '-translate-x-full lg:translate-x-0 lg:max-w-[--collapsed-sidebar-width] rtl:lg:-translate-x-0 rtl:translate-x-full'
        "
    <?php else: ?>
        <?php if(filament()->hasTopNavigation() || filament()->isSidebarFullyCollapsibleOnDesktop()): ?>
            x-cloak
        <?php else: ?>
            x-cloak="-lg"
        <?php endif; ?>
        x-bind:class="
            $store.sidebar.isOpen
                ? 'filament-sidebar-open translate-x-0'
                : '-translate-x-full rtl:translate-x-full'
        "
    <?php endif; ?>
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'filament-sidebar fixed inset-y-0 start-0 z-20 flex h-screen w-[--sidebar-width] flex-col bg-white transition-all dark:bg-gray-800 lg:z-0 lg:bg-transparent dark:lg:bg-transparent',
        'lg:translate-x-0 rtl:lg:-translate-x-0' => ! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation()),
        'lg:-translate-x-full rtl:lg:translate-x-full' => filament()->hasTopNavigation(),
    ]); ?>"
>
    <header
        class="filament-sidebar-header relative flex h-[4rem] shrink-0 items-center justify-center bg-white shadow-[0_1px_0_0_theme(colors.gray.950_/_5%)] dark:bg-gray-800 dark:shadow-[0_1px_0_0_theme(colors.white_/_20%)]"
    >
        <div
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'flex w-full items-center justify-center px-6',
                'lg:px-4' => filament()->isSidebarCollapsibleOnDesktop() && (! filament()->isSidebarFullyCollapsibleOnDesktop()),
            ]); ?>"
            x-show="$store.sidebar.isOpen || <?php echo \Illuminate\Support\Js::from(! filament()->isSidebarCollapsibleOnDesktop())->toHtml() ?> || <?php echo \Illuminate\Support\Js::from(filament()->isSidebarFullyCollapsibleOnDesktop())->toHtml() ?>"
            x-transition:enter="delay-100 lg:transition"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
        >
            <?php if(filament()->isSidebarCollapsibleOnDesktop() && (! filament()->isSidebarFullyCollapsibleOnDesktop())): ?>
                <button
                    type="button"
                    class="filament-sidebar-collapse-button hidden h-10 w-10 shrink-0 items-center justify-center rounded-full text-primary-500 outline-none hover:bg-gray-500/5 focus:bg-primary-500/10 lg:flex"
                    x-bind:aria-label="
                        $store.sidebar.isOpen
                            ? '<?php echo e(__('filament::layout.buttons.sidebar.collapse.label')); ?>'
                            : '<?php echo e(__('filament::layout.buttons.sidebar.expand.label')); ?>'
                    "
                    x-on:click.stop="$store.sidebar.isOpen ? $store.sidebar.close() : $store.sidebar.open()"
                    x-transition:enter="delay-100 lg:transition"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                >
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => 'panels::sidebar.buttons.collapse','color' => 'text-primary-500','size' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => 'panels::sidebar.buttons.collapse','color' => 'text-primary-500','size' => 'h-6 w-6']); ?>
                        <svg
                            class="h-full w-full"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20.25 7.5L16 12L20.25 16.5M3.75 12H12M3.75 17.25H16M3.75 6.75H16"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </button>
            <?php endif; ?>

            <div
                data-turbo="false"
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'relative flex w-full items-center',
                    'lg:ms-3' => filament()->isSidebarCollapsibleOnDesktop() && (! filament()->isSidebarFullyCollapsibleOnDesktop()),
                ]); ?>"
            >
                <?php if($homeUrl = filament()->getHomeUrl()): ?>
                    <a href="<?php echo e($homeUrl); ?>" class="inline-block">
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
                    </a>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>

        <?php if(filament()->isSidebarCollapsibleOnDesktop()): ?>
            <button
                type="button"
                class="filament-sidebar-close-button flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-primary-500 outline-none hover:bg-gray-500/5 focus:bg-primary-500/10"
                x-bind:aria-label="
                    $store.sidebar.isOpen
                        ? '<?php echo e(__('filament::layout.buttons.sidebar.collapse.label')); ?>'
                        : '<?php echo e(__('filament::layout.buttons.sidebar.expand.label')); ?>'
                "
                x-on:click.stop="$store.sidebar.isOpen ? $store.sidebar.close() : $store.sidebar.open()"
                x-show="! $store.sidebar.isOpen && <?php echo \Illuminate\Support\Js::from(! filament()->isSidebarFullyCollapsibleOnDesktop())->toHtml() ?>"
                x-transition:enter="delay-100 lg:transition"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-o-bars-3','alias' => 'panels::sidebar.buttons.toggle','size' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-o-bars-3','alias' => 'panels::sidebar.buttons.toggle','size' => 'h-6 w-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </button>
        <?php endif; ?>
    </header>

    <nav
        class="filament-sidebar-nav flex-1 overflow-y-auto overflow-x-hidden py-6 shadow-lg lg:shadow-none"
    >
        <?php echo e(filament()->renderHook('sidebar.start')); ?>


        <?php if(filament()->hasTenancy()): ?>
            <div class="mb-6 space-y-6 px-6">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tenant-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::tenant-menu'); ?>
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

                <div class="-me-6 border-t dark:border-gray-700"></div>
            </div>
        <?php endif; ?>

        <?php
            $collapsedNavigationGroupLabels = collect($navigation)
                ->filter(fn (\Filament\Navigation\NavigationGroup $group): bool => $group->isCollapsed())
                ->map(fn (\Filament\Navigation\NavigationGroup $group): string => $group->getLabel())
                ->values();
        ?>

        <script>
            if (
                JSON.parse(localStorage.getItem('collapsedGroups')) === null ||
                JSON.parse(localStorage.getItem('collapsedGroups')) === 'null'
            ) {
                localStorage.setItem(
                    'collapsedGroups',
                    JSON.stringify(<?php echo \Illuminate\Support\Js::from($collapsedNavigationGroupLabels)->toHtml() ?>),
                )
            }
        </script>

        <?php if(filament()->hasNavigation()): ?>
            <ul class="-mx-3 grid gap-y-3 px-6">
                <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.sidebar.group','data' => ['label' => $group->getLabel(),'icon' => $group->getIcon(),'collapsible' => $group->isCollapsible(),'items' => $group->getItems(),'hasItemIcons' => $group->hasItemIcons()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.sidebar.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getLabel()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getIcon()),'collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->isCollapsible()),'items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getItems()),'has-item-icons' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->hasItemIcons())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

        <?php echo e(filament()->renderHook('sidebar.end')); ?>

    </nav>

    <?php echo e(filament()->renderHook('sidebar.footer')); ?>

</aside>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/app/sidebar/index.blade.php ENDPATH**/ ?>