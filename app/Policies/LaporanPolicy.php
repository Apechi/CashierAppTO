<?php

namespace App\Policies;

use App\Models\Laporan;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LaporanPolicy
{

    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list laporan_transaksi');
    }

    /**
     * Determine whether the menu can view the model.
     */
    public function view(User $user, Laporan $model): bool
    {
        return $user->hasPermissionTo('view laporan_transaksi');
    }
}
