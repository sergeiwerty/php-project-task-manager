<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  \App\Models\Task  $task
     * @return Response|bool
     */
    public function view(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(): Response|bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(): Response|bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function delete(User $user, Task $task): bool
    {
        return Auth::check() && Auth::id() === $task->creator()->first()->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  \App\Models\Task  $task
     * @return Response|bool
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  \App\Models\Task  $task
     * @return Response|bool
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
