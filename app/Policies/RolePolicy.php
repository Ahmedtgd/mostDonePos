<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    /*
    public function viewAny(Role $role)   // is used to completely hide resources from the navigation menu, and prevents the user from accessing any pages.
    {
        return $role->hasRole(['admin','writer','user','su']);
        //return $role->hasAnyRole('writer');

    }
    */
   
    
    public function create(Role $role)     
    {
        return $role->hasRole(['admin','writer','user','su']);
       //return $role->hasAnyRole('admin');
    }
    public function update (Role $role)   
    {
        return $role->hasRole(['admin','writer','user','su']);
       //return $role->hasAnyRole(['admin','writer']);

    }
    public function view(Role $role)  
    {
        return $role->hasRole(['admin','writer','user','su']);
       //return $role->hasAnyRole('admin');

    }
    public function delete(Role $role)        
    {
        return $role->hasRole(['admin','writer','user','su']);
       //return $role->hasAnyRole('admin');

    }
}
