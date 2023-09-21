<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="container">
<div class="text-center mt-5"> 
<h1>Products</h1>
    </div>  
</br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->description); ?></td>
                        <td><?php echo e($product->price); ?></td>
                        <td><?php echo e($product->quantity); ?></td>
                        
                        <td><?php echo e($product->category_name); ?></td>
                        
                        
                        <div class="form-group">
      

     
                        <td>
                        <img src="<?php echo e(asset('storage/img/img1/' . $product->file)); ?>" width="240" height="120" style="border-radius: 10px;">
                        </td>
                        <td>
                        <img src="<?php echo e(asset('storage/img/img2/' . $product->fil)); ?>" width="240" height="120" style="border-radius: 10px;">
                        </td>

                        <td>
                            <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display: inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</br>
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-6">
                <!-- Your content goes here -->
            </div>
            <div class="col-6 text-right">
                <div class="pagination-container">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    </div>
</br>
    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success">Create Product</a>
</br>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/resources/views/products/index.blade.php ENDPATH**/ ?>