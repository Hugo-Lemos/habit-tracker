<?php

namespace App\Policies;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HabitPolicy
{   
    use HandlesAuthorization;

    public function view(User $user, Habit $habit): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Habit $habit): bool
    {
        return $user->id === $habit->user_id;
    }

    public function delete(User $user, Habit $habit): bool
    {
        return $user->id === $habit->user_id;
    }

    public function toggle(User $user, Habit $habit): bool
    {
        return $user->id === $habit->user_id;
    }
}