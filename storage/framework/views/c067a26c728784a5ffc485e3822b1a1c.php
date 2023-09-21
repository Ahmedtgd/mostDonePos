<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss']); ?>

        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <style>
    .btn-primary {
        background-color: #007bff; /* Blue color */
        border-color: #007bff; /* Blue color */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade of blue on hover */
        border-color: #0056b3; /* Darker shade of blue on hover */
    }

    .btn-danger {
        background-color: #dc3545; /* Red color */
        border-color: #dc3545; /* Red color */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker shade of red on hover */
        border-color: #c82333; /* Darker shade of red on hover */
    }

    .btn-success {
        background-color: #28a745; /* Green color */
        border-color: #28a745; /* Green color */
    }

    .btn-success:hover {
        background-color: #218838; /* Darker shade of green on hover */
        border-color: #218838; /* Darker shade of green on hover */
    }
</style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.myStyle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('myStyle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

                <?php echo e($slot); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

            </main>
        </div>
    </body>
</html>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/resources/views/layouts/app.blade.php ENDPATH**/ ?>