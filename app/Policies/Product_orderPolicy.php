<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Product_order;
use App\Models\User;

class Product_orderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Product_order');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product_order $product_order): bool
    {
        return $user->can('view Product_order');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Product_order');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product_order $product_order): bool
    {
        return $user->can('update Product_order');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product_order $product_order): bool
    {
        return $user->can('delete Product_order');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product_order $product_order): bool
    {
        return $user->can('restore Product_order');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product_order $product_order): bool
    {
        return $user->can('force-delete Product_order');
    }
}
