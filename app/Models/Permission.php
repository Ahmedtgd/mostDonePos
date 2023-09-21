<?php

namespace App\Models;
use Spatie\Permission\Models\Permission as ModelsPermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends ModelsPermission
{
    use HasFactory;
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['Admin','Writer','User','Su']); // Use the hasRole() method
    }
}
