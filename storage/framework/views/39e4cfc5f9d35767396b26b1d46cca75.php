<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.page','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
        'filament-resources-list-records-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-list-records-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ]))]); ?>
    <?php if(count($tabs = $this->getTabs())): ?>
        <div class="flex justify-center">
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $activeTab = strval($activeTab);
                        $tabKey = strval($tabKey);
                    ?>

                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['wire:click' => '$set(\'activeTab\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')','active' => $activeTab === $tabKey,'badge' => $tab->getBadge(),'icon' => $tab->getIcon(),'iconColor' => $tab->getIconColor(),'iconPosition' => $tab->getIconPosition()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('$set(\'activeTab\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')'),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeTab === $tabKey),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getBadge()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getIconColor()),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getIconPosition())]); ?>
                        <?php echo e($tab->getLabel() ?? $this->generateTabLabel($tabKey)); ?>

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
        </div>
    <?php endif; ?>

    <?php echo e(filament()->renderHook('resource.pages.list-records.table.start')); ?>


    <?php echo e($this->table); ?>


    <?php echo e(filament()->renderHook('resource.pages.list-records.table.end')); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/resources/pages/list-records.blade.php ENDPATH**/ ?>