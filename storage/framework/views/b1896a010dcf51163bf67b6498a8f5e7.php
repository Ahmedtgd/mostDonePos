<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'paginator',
    'pageOptions' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'paginator',
    'pageOptions' => [],
]); ?>
<?php foreach (array_filter(([
    'paginator',
    'pageOptions' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $isSimple = ! $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator;
    $isRtl = __('filament::layout.direction') === 'rtl';
    $previousArrowIcon = $isRtl ? 'heroicon-m-chevron-right' : 'heroicon-m-chevron-left';
    $nextArrowIcon = $isRtl ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right';
?>

<nav
    role="navigation"
    aria-label="<?php echo e(__('filament-tables::table.pagination.label')); ?>"
    <?php echo e($attributes->class(['filament-tables-pagination flex items-center justify-between'])); ?>

>
    <div class="flex flex-1 items-center justify-between lg:hidden">
        <div class="w-10">
            <?php if($paginator->hasPages() && (! $paginator->onFirstPage())): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['wire:click' => 'previousPage(\'' . $paginator->getPageName() . '\')','rel' => 'prev','icon' => $previousArrowIcon,'iconAlias' => 'tables::pagination.buttons.previous','label' => __('filament-tables::table.pagination.buttons.previous.label')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('previousPage(\'' . $paginator->getPageName() . '\')'),'rel' => 'prev','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($previousArrowIcon),'icon-alias' => 'tables::pagination.buttons.previous','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.pagination.buttons.previous.label'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if(count($pageOptions) > 1): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.records-per-page-selector','data' => ['options' => $pageOptions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.records-per-page-selector'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageOptions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <div class="w-10">
            <?php if($paginator->hasPages() && $paginator->hasMorePages()): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['wire:click' => 'nextPage(\'' . $paginator->getPageName() . '\')','rel' => 'next','icon' => $nextArrowIcon,'iconAlias' => 'tables::pagination.buttons.next','label' => __('filament-tables::table.pagination.buttons.next.label')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('nextPage(\'' . $paginator->getPageName() . '\')'),'rel' => 'next','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nextArrowIcon),'icon-alias' => 'tables::pagination.buttons.next','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.pagination.buttons.next.label'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="hidden flex-1 grid-cols-3 items-center lg:grid">
        <div class="flex items-center">
            <?php if($isSimple): ?>
                <?php if(! $paginator->onFirstPage()): ?>
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button','data' => ['wire:click' => 'previousPage(\'' . $paginator->getPageName() . '\')','icon' => $previousArrowIcon,'rel' => 'prev','size' => 'sm','color' => 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('previousPage(\'' . $paginator->getPageName() . '\')'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($previousArrowIcon),'rel' => 'prev','size' => 'sm','color' => 'gray']); ?>
                        <?php echo e(__('filament-tables::table.pagination.buttons.previous.label')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="ps-2 text-sm font-medium dark:text-white">
                    <?php echo e(trans_choice(
                            'filament-tables::table.pagination.overview',
                            $paginator->total(),
                            [
                                'first' => \Filament\Support\format_number($paginator->firstItem() ?? 0),
                                'last' => \Filament\Support\format_number($paginator->lastItem() ?? 0),
                                'total' => \Filament\Support\format_number($paginator->total()),
                            ],
                        )); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="flex items-center justify-center">
            <?php if(count($pageOptions) > 1): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.records-per-page-selector','data' => ['options' => $pageOptions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.records-per-page-selector'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageOptions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="flex items-center justify-end">
            <?php if($isSimple): ?>
                <?php if($paginator->hasMorePages()): ?>
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button','data' => ['wire:click' => 'nextPage(\'' . $paginator->getPageName() . '\')','icon' => $nextArrowIcon,'iconPosition' => 'after','rel' => 'next','size' => 'sm','color' => 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('nextPage(\'' . $paginator->getPageName() . '\')'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nextArrowIcon),'icon-position' => 'after','rel' => 'next','size' => 'sm','color' => 'gray']); ?>
                        <?php echo e(__('filament-tables::table.pagination.buttons.next.label')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if($paginator->hasPages()): ?>
                    <div class="rounded-lg border py-3 dark:border-gray-600">
                        <ol
                            class="flex items-center gap-px divide-x divide-gray-300 text-sm text-gray-500 rtl:divide-x-reverse dark:divide-gray-600 dark:text-gray-400"
                        >
                            <?php if(! $paginator->onFirstPage()): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.item','data' => ['wire:click' => 'previousPage(\'' . $paginator->getPageName() . '\')','icon' => 'heroicon-m-chevron-left','ariaLabel' => ''.e(__('filament-tables::table.pagination.buttons.previous.label')).'','rel' => 'prev']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('previousPage(\'' . $paginator->getPageName() . '\')'),'icon' => 'heroicon-m-chevron-left','aria-label' => ''.e(__('filament-tables::table.pagination.buttons.previous.label')).'','rel' => 'prev']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <?php $__currentLoopData = $paginator->render()->offsetGet('elements'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_string($element)): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.item','data' => ['label' => $element,'disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($element),'disabled' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <?php if(is_array($element)): ?>
                                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.item','data' => ['wire:click' => 'gotoPage(' . $page . ', \'' . $paginator->getPageName() . '\')','label' => $page,'ariaLabel' => trans_choice('filament-tables::table.pagination.buttons.go_to_page.label', $page, ['page' => $page]),'active' => $page === $paginator->currentPage(),'wire:key' => $this->id . '.table.pagination.' . $paginator->getPageName() . '.' . $page]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('gotoPage(' . $page . ', \'' . $paginator->getPageName() . '\')'),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page),'aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans_choice('filament-tables::table.pagination.buttons.go_to_page.label', $page, ['page' => $page])),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page === $paginator->currentPage()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '.table.pagination.' . $paginator->getPageName() . '.' . $page)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($paginator->hasMorePages()): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.item','data' => ['wire:click' => 'nextPage(\'' . $paginator->getPageName() . '\')','icon' => 'heroicon-m-chevron-right','ariaLabel' => ''.e(__('filament-tables::table.pagination.buttons.next.label')).'','rel' => 'next']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('nextPage(\'' . $paginator->getPageName() . '\')'),'icon' => 'heroicon-m-chevron-right','aria-label' => ''.e(__('filament-tables::table.pagination.buttons.next.label')).'','rel' => 'next']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endif; ?>
                        </ol>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/components/pagination/index.blade.php ENDPATH**/ ?>