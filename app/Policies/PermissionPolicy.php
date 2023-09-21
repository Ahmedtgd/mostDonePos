<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    /*
    public function viewAny(User $user)   // is used to completely hide resources from the navigation menu, and prevents the user from accessing any pages.
    {
        return $user->hasRole(['admin','writer','user','su']);
        //return $user->hasAnyRole('writer');

    }
  
   */
    
    public function create(Permission $permission)     
    {
        return $permission->hasRole(['admin','writer','user','su']);
       //return $permission->hasAnyRole('admin');
    }
    public function update (Permission $permission)   
    {
        return $permission->hasRole(['admin','writer','user','su']);
       //return $permission->hasAnyRole(['admin','writer']);

    }
    public function view(Permission $permission)  
    {
        return $permission->hasRole(['admin','writer','user','su']);
       //return $permission->hasAnyRole('admin');

    }
    public function delete(Permission $permission)       
    {
        return $permission->hasRole(['admin','writer']);
       //return $permission->hasAnyRole('admin');

    }
}
