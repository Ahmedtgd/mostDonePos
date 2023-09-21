<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'livewire',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'livewire',
]); ?>
<?php foreach (array_filter(([
    'livewire',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!DOCTYPE html>
<html
    lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    dir="<?php echo e(__('filament::layout.direction') ?? 'ltr'); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'filament js-focus-visible min-h-screen antialiased',
        'dark' => filament()->hasDarkModeForced(),
    ]); ?>"
>
    <head>
        <?php echo e(filament()->renderHook('head.start')); ?>


        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <?php if($favicon = filament()->getFavicon()): ?>
            <link rel="icon" href="<?php echo e($favicon); ?>" />
        <?php endif; ?>

        <title>
            <?php echo e(filled($title = $livewire->getTitle()) ? "{$title} - " : null); ?>

            <?php echo e(filament()->getBrandName()); ?>

        </title>

        <?php echo e(filament()->renderHook('styles.start')); ?>


        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        <?php echo \Livewire\Livewire::styles(); ?>

        <?php echo \Filament\Support\Facades\FilamentAsset::renderStyles() ?>
        <?php echo e(filament()->getTheme()->getHtml()); ?>

        <?php echo e(filament()->getFontHtml()); ?>


        <style>
            :root {
                --font-family: <?php echo filament()->getFontFamily(); ?>;
                --filament-widgets-chart-font-family: var(--font-family);
                --sidebar-width: <?php echo e(filament()->getSidebarWidth()); ?>;
                --collapsed-sidebar-width: <?php echo e(filament()->getCollapsedSidebarWidth()); ?>;
            }
        </style>

        <?php echo e(filament()->renderHook('styles.end')); ?>


        <?php if(filament()->hasDarkMode() && (! filament()->hasDarkModeForced())): ?>
            <script>
                const theme = localStorage.getItem('theme') ?? 'system'

                if (
                    theme === 'dark' ||
                    (theme === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)')
                            .matches)
                ) {
                    document.documentElement.classList.add('dark')
                }
            </script>
        <?php endif; ?>

        <?php echo e(filament()->renderHook('head.end')); ?>

    </head>

    <body
        class="filament-body min-h-screen overscroll-y-none bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white"
    >
        <?php echo e(filament()->renderHook('body.start')); ?>


        <?php echo e($slot); ?>


        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filament.core.notifications')->html();
} elseif ($_instance->childHasBeenRendered('Kn8Vn6Q')) {
    $componentId = $_instance->getRenderedChildComponentId('Kn8Vn6Q');
    $componentTag = $_instance->getRenderedChildComponentTagName('Kn8Vn6Q');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Kn8Vn6Q');
} else {
    $response = \Livewire\Livewire::mount('filament.core.notifications');
    $html = $response->html();
    $_instance->logRenderedChild('Kn8Vn6Q', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <?php echo e(filament()->renderHook('scripts.start')); ?>


        <?php echo \Livewire\Livewire::scripts(); ?>

        <?php echo \Filament\Support\Facades\FilamentAsset::renderScripts(withCore: true) ?>

        <?php if(config('filament.broadcasting.echo')): ?>
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.Echo = new window.EchoFactory(<?php echo \Illuminate\Support\Js::from(config('filament.broadcasting.echo'))->toHtml() ?>)

                    window.dispatchEvent(new CustomEvent('EchoLoaded'))
                })
            </script>
        <?php endif; ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>

        <?php echo e(filament()->renderHook('scripts.end')); ?>


        <?php echo e(filament()->renderHook('body.end')); ?>

    </body>
</html>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/filament/src/../resources/views/components/layouts/base.blade.php ENDPATH**/ ?>