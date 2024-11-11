<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;

class ProductPolicy
{
    public function create(User $user)
    {
        return $user->role === 'manager';
    }

    public function update(User $user)
    {
        return $user->role === 'manager';
    }

    public function delete(User $user)
    {
        return $user->role === 'manager';
    }
}
