<?php

namespace App\Models;
use App\Model\User;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderUser extends Pivot
{
    protected $table = 'order_user';

    protected $fillable = [
        'order_id',
        'user_id',
        'user_name',
    ];




    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('name')
                    ->using(OrderUser::class); 
    }
}
