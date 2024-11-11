<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;

class CompanyPolicy
{
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Company $company)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Company $company)
    {
        return $user->role === 'admin';
    }
}
