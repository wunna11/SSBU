<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Course $course): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->hasPermissionTo('create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Course $course): bool
    {
        return $user->hasPermissionTo('edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Course $course): bool
    {
        return $user->hasPermissionTo('delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Course $course): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Course $course): bool
    {
        //
    }
}
