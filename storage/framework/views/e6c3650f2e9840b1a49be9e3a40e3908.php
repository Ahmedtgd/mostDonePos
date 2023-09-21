<?php
    $user = filament()->auth()->user();
    $items = filament()->getUserMenuItems();

    $accountItem = $items['account'] ?? null;
    $accountItemUrl = $accountItem?->getUrl();

    $logoutItem = $items['logout'] ?? null;

    $items = \Illuminate\Support\Arr::except($items, ['account', 'logout']);
?>

<?php echo e(filament()->renderHook('user-menu.start')); ?>


<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['placement' => 'bottom-end','class' => 'filament-user-menu']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placement' => 'bottom-end','class' => 'filament-user-menu']); ?>
     <?php $__env->slot('trigger', null, ['class' => 'ms-4']); ?> 
        <button
            class="block"
            aria-label="<?php echo e(__('filament::layout.buttons.user_menu.label')); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.avatar.user','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::avatar.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </button>
     <?php $__env->endSlot(); ?>

    <?php echo e(filament()->renderHook('user-menu.account.before')); ?>


    <?php if(filled($accountItemUrl)): ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['color' => $accountItem->getColor() ?? 'gray','icon' => $accountItem->getIcon() ?? 'heroicon-m-user-circle','href' => $accountItemUrl,'tag' => 'a']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($accountItem->getColor() ?? 'gray'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($accountItem->getIcon() ?? 'heroicon-m-user-circle'),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($accountItemUrl),'tag' => 'a']); ?>
                <?php echo e($accountItem->getLabel() ?? filament()->getUserName($user)); ?>

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
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.header','data' => ['color' => $accountItem?->getColor() ?? 'gray','icon' => $accountItem?->getIcon() ?? 'heroicon-m-user-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($accountItem?->getColor() ?? 'gray'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($accountItem?->getIcon() ?? 'heroicon-m-user-circle')]); ?>
            <?php echo e($accountItem?->getLabel() ?? filament()->getUserName($user)); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php echo e(filament()->renderHook('user-menu.account.after')); ?>


    <?php if(filament()->hasDarkMode() && (! filament()->hasDarkModeForced())): ?>
        <div
            x-data="{
                theme: null,

                init: function () {
                    this.theme = localStorage.getItem('theme') || 'system'

                    window
                        .matchMedia('(prefers-color-scheme: dark)')
                        .addEventListener('change', (event) => {
                            if (this.theme !== 'system') {
                                return
                            }

                            if (
                                event.matches &&
                                ! document.documentElement.classList.contains('dark')
                            ) {
                                document.documentElement.classList.add('dark')
                            } else if (
                                ! event.matches &&
                                document.documentElement.classList.contains('dark')
                            ) {
                                document.documentElement.classList.remove('dark')
                            }
                        })

                    $watch('theme', () => {
                        localStorage.setItem('theme', this.theme)

                        if (
                            this.theme === 'dark' &&
                            ! document.documentElement.classList.contains('dark')
                        ) {
                            document.documentElement.classList.add('dark')
                        } else if (
                            this.theme === 'light' &&
                            document.documentElement.classList.contains('dark')
                        ) {
                            document.documentElement.classList.remove('dark')
                        } else if (this.theme === 'system') {
                            if (
                                this.isSystemDark() &&
                                ! document.documentElement.classList.contains('dark')
                            ) {
                                document.documentElement.classList.add('dark')
                            } else if (
                                ! this.isSystemDark() &&
                                document.documentElement.classList.contains('dark')
                            ) {
                                document.documentElement.classList.remove('dark')
                            }
                        }

                        $dispatch('theme-changed', this.theme)
                    })
                },

                isSystemDark: function () {
                    return window.matchMedia('(prefers-color-scheme: dark)').matches
                },
            }"
            class="filament-theme-switcher flex items-center divide-x divide-gray-950/5 border-b border-gray-950/5 dark:divide-gray-700 dark:border-gray-700"
        >
            <button
                type="button"
                aria-label="<?php echo e(__('filament::layout.buttons.light_theme.label')); ?>"
                x-tooltip="'<?php echo e(__('filament::layout.buttons.light_theme.label')); ?>'"
                x-on:click="theme = 'light'"
                x-bind:class="theme === 'light' ? 'text-primary-500' : 'text-gray-700 dark:text-gray-200'"
                class="flex flex-1 items-center justify-center p-2 hover:bg-gray-500/10 focus:bg-gray-500/10"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-sun','alias' => 'panels::theme.light','size' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-sun','alias' => 'panels::theme.light','size' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </button>

            <button
                type="button"
                aria-label="<?php echo e(__('filament::layout.buttons.dark_theme.label')); ?>"
                x-tooltip="'<?php echo e(__('filament::layout.buttons.dark_theme.label')); ?>'"
                x-on:click="theme = 'dark'"
                x-bind:class="theme === 'dark' ? 'text-primary-500' : 'text-gray-700 dark:text-gray-200'"
                class="flex flex-1 items-center justify-center p-2 text-gray-700 hover:bg-gray-500/10 focus:bg-gray-500/10"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-moon','alias' => 'panels::theme.dark','size' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-moon','alias' => 'panels::theme.dark','size' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </button>

            <button
                type="button"
                aria-label="<?php echo e(__('filament::layout.buttons.system_theme.label')); ?>"
                x-tooltip="'<?php echo e(__('filament::layout.buttons.system_theme.label')); ?>'"
                x-on:click="theme = 'system'"
                x-bind:class="theme === 'system' ? 'text-primary-500' : 'text-gray-700 dark:text-gray-200'"
                class="flex flex-1 items-center justify-center p-2 text-gray-700 hover:bg-gray-500/10 focus:bg-gray-500/10"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-computer-desktop','alias' => 'panels::theme.system','size' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-computer-desktop','alias' => 'panels::theme.system','size' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </button>
        </div>
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['color' => $item->getColor() ?? 'gray','icon' => $item->getIcon(),'href' => $item->getUrl(),'tag' => 'a']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getColor() ?? 'gray'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getIcon()),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl()),'tag' => 'a']); ?>
                <?php echo e($item->getLabel()); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['color' => $logoutItem?->getColor() ?? 'gray','icon' => $logoutItem?->getIcon() ?? 'heroicon-m-arrow-left-on-rectangle','action' => $logoutItem?->getUrl() ?? filament()->getLogoutUrl(),'method' => 'post','tag' => 'form']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($logoutItem?->getColor() ?? 'gray'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($logoutItem?->getIcon() ?? 'heroicon-m-arrow-left-on-rectangle'),'action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($logoutItem?->getUrl() ?? filament()->getLogoutUrl()),'method' => 'post','tag' => 'form']); ?>
            <?php echo e($logoutItem?->getLabel() ?? __('filament::layout.buttons.logout.label')); ?>

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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

<?php echo e(filament()->renderHook('user-menu.end')); ?>

<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/user-menu.blade.php ENDPATH**/ ?>