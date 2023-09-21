<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'alignment' => 'start',
    'ariaLabelledby' => null,
    'closeButton' => \Filament\Support\View\Components\Modal::$hasCloseButton,
    'closeByClickingAway' => \Filament\Support\View\Components\Modal::$isClosedByClickingAway,
    'closeEventName' => 'close-modal',
    'displayClasses' => 'inline-block',
    'footer' => null,
    'footerActions' => [],
    'footerActionsAlignment' => 'start',
    'header' => null,
    'heading' => null,
    'hrComponent' => 'filament::hr',
    'icon' => null,
    'iconColor' => 'primary',
    'id' => null,
    'openEventName' => 'open-modal',
    'slideOver' => false,
    'stickyFooter' => false,
    'description' => null,
    'trigger' => null,
    'visible' => true,
    'width' => 'sm',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'alignment' => 'start',
    'ariaLabelledby' => null,
    'closeButton' => \Filament\Support\View\Components\Modal::$hasCloseButton,
    'closeByClickingAway' => \Filament\Support\View\Components\Modal::$isClosedByClickingAway,
    'closeEventName' => 'close-modal',
    'displayClasses' => 'inline-block',
    'footer' => null,
    'footerActions' => [],
    'footerActionsAlignment' => 'start',
    'header' => null,
    'heading' => null,
    'hrComponent' => 'filament::hr',
    'icon' => null,
    'iconColor' => 'primary',
    'id' => null,
    'openEventName' => 'open-modal',
    'slideOver' => false,
    'stickyFooter' => false,
    'description' => null,
    'trigger' => null,
    'visible' => true,
    'width' => 'sm',
]); ?>
<?php foreach (array_filter(([
    'alignment' => 'start',
    'ariaLabelledby' => null,
    'closeButton' => \Filament\Support\View\Components\Modal::$hasCloseButton,
    'closeByClickingAway' => \Filament\Support\View\Components\Modal::$isClosedByClickingAway,
    'closeEventName' => 'close-modal',
    'displayClasses' => 'inline-block',
    'footer' => null,
    'footerActions' => [],
    'footerActionsAlignment' => 'start',
    'header' => null,
    'heading' => null,
    'hrComponent' => 'filament::hr',
    'icon' => null,
    'iconColor' => 'primary',
    'id' => null,
    'openEventName' => 'open-modal',
    'slideOver' => false,
    'stickyFooter' => false,
    'description' => null,
    'trigger' => null,
    'visible' => true,
    'width' => 'sm',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div
    x-data="{
        isOpen: false,

        livewire: null,

        close: function () {
            this.isOpen = false

            this.$refs.modalContainer.dispatchEvent(
                new CustomEvent('modal-closed', { id: '<?php echo e($id); ?>' }),
            )
        },

        open: function () {
            this.isOpen = true

            this.$refs.modalContainer.dispatchEvent(
                new CustomEvent('modal-opened', { id: '<?php echo e($id); ?>' }),
            )
        },
    }"
    x-trap.noscroll="isOpen"
    <?php if($id): ?>
        x-on:<?php echo e($closeEventName); ?>.window="if ($event.detail.id === '<?php echo e($id); ?>') close()"
        x-on:<?php echo e($openEventName); ?>.window="if ($event.detail.id === '<?php echo e($id); ?>') open()"
    <?php endif; ?>
    <?php if($ariaLabelledby): ?>
        aria-labelledby="<?php echo e($ariaLabelledby); ?>"
    <?php elseif($heading): ?>
        aria-labelledby="<?php echo e("{$id}.heading"); ?>"
    <?php endif; ?>
    role="dialog"
    aria-modal="true"
    wire:ignore.self
    class="filament-modal <?php echo e($displayClasses); ?>"
>
    <?php echo e($trigger); ?>


    <div
        x-show="isOpen"
        x-transition.duration.300ms.opacity
        x-cloak
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition',
            'flex items-center' => ! $slideOver,
        ]); ?>"
    >
        <div
            <?php if($closeByClickingAway): ?>
                <?php if(filled($id)): ?>
                    x-on:click="$dispatch('<?php echo e($closeEventName); ?>', { id: '<?php echo e($id); ?>' })"
                <?php else: ?>
                    x-on:click="close()"
                <?php endif; ?>
            <?php endif; ?>
            aria-hidden="true"
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'filament-modal-close-overlay fixed inset-0 h-full w-full bg-black/50',
                'cursor-pointer' => $closeByClickingAway,
            ]); ?>"
            style="will-change: transform"
        ></div>

        <div
            x-ref="modalContainer"
            x-cloak
            <?php echo e($attributes->class([
                    'pointer-events-none relative w-full transition',
                    'my-auto p-4' => ! $slideOver,
                ])); ?>

        >
            <div
                x-data="{ isShown: false }"
                x-init="
                    $nextTick(() => {
                        isShown = isOpen
                        $watch('isOpen', () => (isShown = isOpen))
                    })
                "
                x-show="isShown"
                x-cloak
                <?php if(filled($id)): ?>
                    x-on:keydown.window.escape="$dispatch('<?php echo e($closeEventName); ?>', { id: '<?php echo e($id); ?>' })"
                <?php else: ?>
                    x-on:keydown.window.escape="close()"
                <?php endif; ?>
                x-transition:enter="ease duration-300"
                x-transition:leave="ease duration-300"
                <?php if($slideOver): ?>
                    x-transition:enter-start="translate-x-full rtl:-translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full rtl:-translate-x-full"
                <?php elseif($width !== 'screen'): ?>
                    x-transition:enter-start="translate-y-8"
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-8"
                <?php endif; ?>
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'filament-modal-window pointer-events-auto w-full cursor-default bg-white dark:bg-gray-800',
                    'relative' => $width !== 'screen',
                    'filament-modal-slide-over-window ms-auto h-screen overflow-y-auto' => $slideOver,
                    'mx-auto rounded-xl' => ! ($slideOver || ($width === 'screen')),
                    'hidden' => ! $visible,
                    'max-w-xs' => $width === 'xs',
                    'max-w-sm' => $width === 'sm',
                    'max-w-md' => $width === 'md',
                    'max-w-lg' => $width === 'lg',
                    'max-w-xl' => $width === 'xl',
                    'max-w-2xl' => $width === '2xl',
                    'max-w-3xl' => $width === '3xl',
                    'max-w-4xl' => $width === '4xl',
                    'max-w-5xl' => $width === '5xl',
                    'max-w-6xl' => $width === '6xl',
                    'max-w-7xl' => $width === '7xl',
                    'fixed inset-0' => $width === 'screen',
                ]); ?>"
            >
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'relative flex h-full flex-col' => ($width === 'screen') || $slideOver,
                    ]); ?>"
                >
                    <?php if($heading || $header): ?>
                        <div
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'filament-modal-header flex px-6 pt-6',
                                'mb-6' => $slot->isEmpty(),
                                match ($alignment) {
                                    'left', 'start' => 'gap-x-5',
                                    'center' => 'flex-col',
                                },
                            ]); ?>"
                        >
                            <?php if($header): ?>
                                <?php echo e($header); ?>

                            <?php else: ?>
                                <?php if($icon): ?>
                                    <div
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'mb-5 flex items-center justify-center' => $alignment === 'center',
                                        ]); ?>"
                                    >
                                        <div
                                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                'rounded-full bg-custom-100 dark:bg-custom-500/20',
                                                match ($alignment) {
                                                    'left', 'start' => 'p-2',
                                                    'center' => 'p-3',
                                                },
                                            ]); ?>"
                                            style="<?php echo e(\Filament\Support\get_color_css_variables($iconColor, shades: [100, 500])); ?>"
                                        >
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => 'filament::modal','color' => 'text-custom-600 dark:text-custom-400','name' => $icon,'size' => 'h-6 w-6','style' => \Filament\Support\get_color_css_variables($iconColor, shades: [400, 600])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => 'filament::modal','color' => 'text-custom-600 dark:text-custom-400','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'size' => 'h-6 w-6','style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\get_color_css_variables($iconColor, shades: [400, 600]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'text-center' => $alignment === 'center',
                                    ]); ?>"
                                >
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.heading','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal.heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo e($heading); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                                    <?php if($description): ?>
                                        <p
                                            class="filament-modal-description mt-2 text-sm text-gray-500 dark:text-gray-400"
                                        >
                                            <?php echo e($description); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($closeButton): ?>
                        <div
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'absolute',
                                'end-6 top-6' => $slideOver,
                                'end-4 top-4' => ! $slideOver,
                            ]); ?>"
                        >
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => 'heroicon-o-x-mark','iconAlias' => 'support::modal.close-button','iconSize' => 'lg','label' => __('filament-support::components/modal.actions.close.label'),'tabindex' => '-1','xOn:click' => filled($id) ? '$dispatch(' . \Illuminate\Support\Js::from($closeEventName) . ', { id: ' . \Illuminate\Support\Js::from($id) . ' })' : 'close()','class' => 'filament-modal-close-button -m-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => 'heroicon-o-x-mark','icon-alias' => 'support::modal.close-button','icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-support::components/modal.actions.close.label')),'tabindex' => '-1','x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($id) ? '$dispatch(' . \Illuminate\Support\Js::from($closeEventName) . ', { id: ' . \Illuminate\Support\Js::from($id) . ' })' : 'close()'),'class' => 'filament-modal-close-button -m-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($slot->isNotEmpty()): ?>
                        <div
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'filament-modal-content flex flex-col gap-y-4 py-6',
                                'flex-1' => ($width === 'screen') || $slideOver,
                                'pe-6 ps-[5.25rem]' => $icon && ($alignment === 'start'),
                                'px-6' => ! ($icon && ($alignment === 'start')),
                            ]); ?>"
                        >
                            <?php echo e($slot); ?>

                        </div>
                    <?php endif; ?>

                    <div
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'filament-modal-footer w-full',
                            'pe-6 ps-[5.25rem]' => $icon && ($alignment === 'start') && ($footerActionsAlignment !== 'center') && (! $stickyFooter),
                            'px-6' => ! ($icon && ($alignment === 'start') && ($footerActionsAlignment !== 'center') && (! $stickyFooter)),
                            'sticky bottom-0 rounded-b-xl border-t border-gray-200 bg-white py-5 dark:border-gray-700 dark:bg-gray-800' => $stickyFooter,
                            'pb-6' => ! $stickyFooter,
                            'mt-6' => (! $stickyFooter) && $slot->isEmpty() && (! $slideOver),
                            'mt-auto' => $slideOver,
                        ]); ?>"
                    >
                        <?php if($footer): ?>
                            <?php echo e($footer); ?>

                        <?php elseif(count($footerActions)): ?>
                            <div
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                    'filament-modal-footer-actions gap-3',
                                    match ($footerActionsAlignment) {
                                        'center' => 'flex flex-col-reverse sm:grid sm:grid-cols-[repeat(auto-fit,minmax(0,1fr))]',
                                        'end', 'right' => 'flex flex-row-reverse flex-wrap items-center',
                                        'left', 'start' => 'flex flex-wrap items-center',
                                    },
                                ]); ?>"
                            >
                                <?php $__currentLoopData = $footerActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($action); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/support/src/../resources/views/components/modal/index.blade.php ENDPATH**/ ?>