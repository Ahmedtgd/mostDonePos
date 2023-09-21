<?php
    $isListWithLineBreaks = $isListWithLineBreaks();

    $isBadge = $isBadge();

    $arrayState = $getState();
    if (is_array($arrayState)) {
        if ($listLimit = $getListLimit()) {
            $limitedArrayState = array_slice($arrayState, $listLimit);
            $arrayState = array_slice($arrayState, 0, $listLimit);
        }

        if ((! $isListWithLineBreaks) && (! $isBadge)) {
            $arrayState = implode(', ', $arrayState);
        }
    }
    $arrayState = \Illuminate\Support\Arr::wrap($arrayState);

    $canWrap = $canWrap();

    $descriptionAbove = $getDescriptionAbove();
    $descriptionBelow = $getDescriptionBelow();

    $iconPosition = $getIconPosition();
    $iconSize = $isBadge ? 'h-3 w-3' : 'h-4 w-4';

    $isClickable = $getAction() || $getUrl();
?>

<div
    <?php echo e($attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'filament-tables-text-column',
                'px-4 py-3' => ! $isInline(),
                'text-primary-600 transition hover:text-primary-500 hover:underline focus:text-primary-500 focus:underline' => $isClickable && (! $isBadge),
            ])); ?>

>
    <?php if(filled($descriptionAbove)): ?>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            <?php echo e($descriptionAbove instanceof \Illuminate\Support\HtmlString ? $descriptionAbove : str($descriptionAbove)->markdown()->sanitizeHtml()->toHtmlString()); ?>

        </div>
    <?php endif; ?>

    <<?php echo e($isListWithLineBreaks ? 'ul' : 'div'); ?>

        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'list-inside list-disc' => $isBulleted(),
            'flex flex-wrap gap-1' => $isBadge,
        ]); ?>"
    >
        <?php $__currentLoopData = $arrayState; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $formattedState = $formatState($state);

                $color = $getColor($state) ?? 'gray';
                $icon = $getIcon($state);

                $itemIsCopyable = $isCopyable($state);
                $copyableState = $getCopyableState($state) ?? $state;
                $copyMessage = $getCopyMessage($state);
                $copyMessageDuration = $getCopyMessageDuration($state);
            ?>

            <?php if(filled($formattedState)): ?>
                <<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>>
                    <div
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'inline-flex items-center space-x-1 rtl:space-x-reverse',
                            'filament-tables-text-column-badge min-h-6 justify-center whitespace-nowrap rounded-xl px-2 py-0.5' => $isBadge,
                            'whitespace-normal' => $canWrap,
                            "filament-tables-text-column-badge-color-{$color}" => $isBadge && is_string($color),
                            match ($color) {
                                'gray' => 'bg-gray-500/10 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300',
                                default => 'bg-custom-500/10 text-custom-700 dark:text-custom-500',
                            } => $isBadge,
                            match ($color) {
                                'gray' => null,
                                default => 'text-custom-600 dark:text-custom-400',
                            } => ! ($isBadge || $isClickable),
                            match ($size = ($isBadge ? 'xs' : $getSize($state))) {
                                'xs' => 'text-xs',
                                'sm', null => 'text-sm',
                                'base', 'md' => 'text-base',
                                'lg' => 'text-lg',
                                default => $size,
                            },
                            match ($weight = ($isBadge ? 'medium' : $getWeight($state))) {
                                'thin' => 'font-thin',
                                'extralight' => 'font-extralight',
                                'light' => 'font-light',
                                'medium' => 'font-medium',
                                'semibold' => 'font-semibold',
                                'bold' => 'font-bold',
                                'extrabold' => 'font-extrabold',
                                'black' => 'font-black',
                                default => $weight,
                            },
                            match ($getFontFamily($state)) {
                                'sans' => 'font-sans',
                                'serif' => 'font-serif',
                                'mono' => 'font-mono',
                                default => null,
                            },
                        ]); ?>"
                        style="<?php echo \Illuminate\Support\Arr::toCssStyles([
                            \Filament\Support\get_color_css_variables(
                                $color,
                                shades: match (true) {
                                    $isBadge => [500, 700],
                                    ! ($isBadge || $isClickable) => [400, 600],
                                    default => [],
                                },
                            ) => $color !== 'gray',
                        ]) ?>"
                    >
                        <?php if($icon && $iconPosition === 'before'): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'tables::columns.text.prefix','size' => $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'tables::columns.text.prefix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>

                        <span
                            <?php if($itemIsCopyable): ?>
                                x-on:click="
                                    window.navigator.clipboard.writeText(<?php echo \Illuminate\Support\Js::from($copyableState)->toHtml() ?>)
                                    $tooltip(<?php echo \Illuminate\Support\Js::from($copyMessage)->toHtml() ?>, { timeout: <?php echo \Illuminate\Support\Js::from($copyMessageDuration)->toHtml() ?> })
                                "
                            <?php endif; ?>
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'filament-tables-text-column-content',
                                'cursor-pointer' => $itemIsCopyable,
                            ]); ?>"
                        >
                            <?php echo e($formattedState); ?>

                        </span>

                        <?php if($icon && $iconPosition === 'after'): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => $icon,'alias' => 'tables::columns.text.suffix','size' => $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'alias' => 'tables::columns.text.suffix','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </div>
                </<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($limitedArrayStateCount = count($limitedArrayState ?? [])): ?>
            <<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>

                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'text-sm' => ! $isBadge,
                    'text-xs' => $isBadge,
                ]); ?>"
            >
                <?php echo e(trans_choice('filament-tables::table.columns.text.more_list_items', $limitedArrayStateCount)); ?>

            </<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>>
        <?php endif; ?>
    </<?php echo e($isListWithLineBreaks ? 'ul' : 'div'); ?>>

    <?php if(filled($descriptionBelow)): ?>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            <?php echo e($descriptionBelow instanceof \Illuminate\Support\HtmlString ? $descriptionBelow : str($descriptionBelow)->markdown()->sanitizeHtml()->toHtmlString()); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/columns/text-column.blade.php ENDPATH**/ ?>