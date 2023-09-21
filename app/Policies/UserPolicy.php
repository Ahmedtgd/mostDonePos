<?php
namespace App\Policies;

// app/Policies/UserPolicy.php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  
    use HandlesAuthorization;

   /* 
    public function viewAny(User $user)   // is used to completely hide resources from the navigation menu, and prevents the user from accessing any pages.
    {
        return !$user->hasRole(['admin','writer','user','su']);
        

    }

    /// having issue with admin user
    
   */
    
    public function create(User $user)     
    {
    
      // return $user->hasRole(['writer','user','su']) ;

         if ($user->hasPermissionTo('create User')){
            return true;
        }
        return false;
    }
       
    
    public function update (User $user)   
    {
        //return $user->hasRole(['admin','writer']);
         if ($user->hasPermissionTo('update User')){
            return true;
        }
        return false;
    }
       

   
    public function view(User $user)  
    {
       // return $user->hasRole(['admin','writer','user','su']);
      // return $user->hasRole(['admin','writer']);
         if ($user->hasPermissionTo('view User')){
            return true;
        }
        return false;
    }


 
    public function delete(User $user)        
    {
       // return $user->hasRole(['writer','user']);
       //return $user->hasAnyRole('admin');
        if ($user->hasPermissionTo('delete User')){
            return true;
        }
        return false;
    }
   
   }









