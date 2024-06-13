<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user,int $id)
    {
        return $user->id === $id;
    }
    public function delete(User $user,int $id)
    {
        return $user->id===$id;
    }
    public function __construct()
    {
        //
    }
}
