<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TaskStatusPolicy
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
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return Response|bool
     */
    public function view(User $user, TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return Response|bool
     */
    public function update(User $user, TaskStatus $taskStatus)
    {
        return Auth::check() ? Auth::check() : false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return Response|bool
     */
    public function delete(User $user, TaskStatus $taskStatus)
    {
        return Auth::check() ? Auth::check() : false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return Response|bool
     */
    public function restore(User $user, TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return Response|bool
     */
    public function forceDelete(User $user, TaskStatus $taskStatus)
    {
        //
    }
}
