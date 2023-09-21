<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'breadcrumbs' => [],
    'navigation',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'breadcrumbs' => [],
    'navigation',
]); ?>
<?php foreach (array_filter(([
    'breadcrumbs' => [],
    'navigation',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<header
    <?php echo e($attributes->class(['filament-main-topbar sticky top-0 z-10 bg-white shadow-[0_1px_0_0_theme(colors.gray.950_/_5%)] dark:border-gray-700 dark:bg-gray-800 dark:shadow-[0_1px_0_0_theme(colors.white_/_20%)]'])); ?>

>
    <div
        class="flex h-16 items-center justify-between px-2 sm:px-4 md:px-6 lg:px-8"
    >
        <div class="flex flex-1 items-center">
            <?php echo e(filament()->renderHook('topbar.start')); ?>


            <button
                x-cloak
                x-data="{}"
                x-bind:aria-label="
                    $store.sidebar.isOpen
                        ? '<?php echo e(__('filament::layout.buttons.sidebar.collapse.label')); ?>'
                        : '<?php echo e(__('filament::layout.buttons.sidebar.expand.label')); ?>'
                "
                x-on:click="$store.sidebar.isOpen ? $store.sidebar.close() : $store.sidebar.open()"
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'filament-sidebar-open-button flex h-10 w-10 shrink-0 items-center justify-center rounded-full outline-none hover:bg-gray-500/5 focus:bg-primary-500/10',
                    'lg:me-4' => filament()->isSidebarFullyCollapsibleOnDesktop(),
                    'lg:hidden' => ! (filament()->isSidebarFullyCollapsibleOnDesktop()),
                ]); ?>"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-o-bars-3','alias' => 'panels::topbar.buttons.toggle-sidebar','color' => 'text-primary-500','size' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-o-bars-3','alias' => 'panels::topbar.buttons.toggle-sidebar','color' => 'text-primary-500','size' => 'h-6 w-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </button>

            <?php if(filament()->hasTopNavigation()): ?>
                <div class="me-12 hidden lg:flex">
                    <?php if($homeUrl = filament()->getHomeUrl()): ?>
                        <a href="<?php echo e($homeUrl); ?>" data-turbo="false">
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

                <?php if(filament()->hasNavigation()): ?>
                    <ul class="hidden flex-wrap items-center gap-x-1 lg:flex">
                        <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($groupLabel = $group->getLabel()): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['placement' => 'bottom-start']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placement' => 'bottom-start']); ?>
                                     <?php $__env->slot('trigger', null, []); ?> 
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.topbar.item','data' => ['active' => $group->isActive(),'icon' => $group->getIcon()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->isActive()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getIcon())]); ?>
                                            <?php echo e($groupLabel); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                     <?php $__env->endSlot(); ?>

                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php $__currentLoopData = $group->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['icon' => $item->isActive() ? ($item->getActiveIcon() ?? $item->getIcon()) : $item->getIcon(),'href' => $item->getUrl(),'target' => $item->shouldOpenUrlInNewTab() ? '_blank' : null,'tag' => 'a']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->isActive() ? ($item->getActiveIcon() ?? $item->getIcon()) : $item->getIcon()),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl()),'target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->shouldOpenUrlInNewTab() ? '_blank' : null),'tag' => 'a']); ?>
                                                <?php echo e($item->getLabel()); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $group->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.topbar.item','data' => ['active' => $item->isActive(),'icon' => $item->getIcon(),'activeIcon' => $item->getActiveIcon(),'url' => $item->getUrl(),'badge' => $item->getBadge(),'badgeColor' => $item->getBadgeColor(),'shouldOpenUrlInNewTab' => $item->shouldOpenUrlInNewTab()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->isActive()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getIcon()),'active-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getActiveIcon()),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl()),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadge()),'badgeColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadgeColor()),'shouldOpenUrlInNewTab' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->shouldOpenUrlInNewTab())]); ?>
                                        <?php echo e($item->getLabel()); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            <?php elseif(count($breadcrumbs)): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.topbar.breadcrumbs','data' => ['breadcrumbs' => $breadcrumbs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.topbar.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="flex items-center">
            <?php if(filament()->getGlobalSearchProvider() !== null): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filament.core.global-search')->html();
} elseif ($_instance->childHasBeenRendered('npGxaVU')) {
    $componentId = $_instance->getRenderedChildComponentId('npGxaVU');
    $componentTag = $_instance->getRenderedChildComponentTagName('npGxaVU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('npGxaVU');
} else {
    $response = \Livewire\Livewire::mount('filament.core.global-search');
    $html = $response->html();
    $_instance->logRenderedChild('npGxaVU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endif; ?>

            <?php if(filament()->hasDatabaseNotifications()): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filament.core.database-notifications')->html();
} elseif ($_instance->childHasBeenRendered('uqxDcnu')) {
    $componentId = $_instance->getRenderedChildComponentId('uqxDcnu');
    $componentTag = $_instance->getRenderedChildComponentTagName('uqxDcnu');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('uqxDcnu');
} else {
    $response = \Livewire\Livewire::mount('filament.core.database-notifications');
    $html = $response->html();
    $_instance->logRenderedChild('uqxDcnu', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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

            <?php echo e(filament()->renderHook('topbar.end')); ?>

        </div>
    </div>

    <?php if(filament()->hasTopNavigation() && count($breadcrumbs)): ?>
        <div
            class="hidden h-12 items-center border-t px-8 dark:border-gray-700 lg:flex"
        >
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.layouts.app.topbar.breadcrumbs','data' => ['breadcrumbs' => $breadcrumbs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::layouts.app.topbar.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>
</header>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/app/topbar/index.blade.php ENDPATH**/ ?>