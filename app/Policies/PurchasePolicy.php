<?php

namespace App\Policies;

use App\Models\User;

class PurchasePolicy
{
    public function purchase(User $user)
    {
        return $user->role === 'customer';
    }
}
