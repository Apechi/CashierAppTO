<?php

namespace App\Policies;

use App\Models\ProdukTitipan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdukTitipanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list produk_titipans');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProdukTitipan $produkTitipan): bool
    {
        return $user->hasPermissionTo('view produk_titipans');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create produk_titipans');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProdukTitipan $produkTitipan): bool
    {
        return $user->hasPermissionTo('update produk_titipans');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProdukTitipan $produkTitipan): bool
    {
        return $user->hasPermissionTo('delete produk_titipans');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProdukTitipan $produkTitipan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProdukTitipan $produkTitipan): bool
    {
        return $user->hasPermissionTo('delete produk_titipans');
    }
}
