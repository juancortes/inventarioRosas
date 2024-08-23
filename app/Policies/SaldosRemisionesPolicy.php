<?php

namespace App\Policies;

use App\Models\SaldosRemisiones;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SaldosRemisionesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SaldosRemisiones $saldosRemisiones): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SaldosRemisiones $saldosRemisiones): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SaldosRemisiones $saldosRemisiones): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SaldosRemisiones $saldosRemisiones): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SaldosRemisiones $saldosRemisiones): bool
    {
        //
    }
}
