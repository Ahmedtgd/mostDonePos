<?php

namespace App\Models;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends ModelsRole
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guard_name'
    
    ];
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['Admin','Writer','User','Su']); // Use the hasRole() method
    }
   
}
