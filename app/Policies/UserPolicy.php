<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model, $permissionRequired=null)
    {
        $adminPermission = $permissionRequired[0];
        $ownPermission = $permissionRequired[1];

        if ($user->havePermission($adminPermission))
        {
            return true;
        }
        if ($user->havePermission($ownPermission))
        {
            if ($user->id === $model->id)
            {
                return true;
            }
        }
        return false;
    }

    public function destroy(User $user, User $model, $permissionRequired=null)
    {
        $adminPermission = $permissionRequired[0];
        $ownPermission = $permissionRequired[1];

        if ($user->havePermission($adminPermission))
        {
            return true;
        }
        if ($user->havePermission($ownPermission))
        {
            if ($user->id === $model->id)
            {
                return true;
            }
        }
        return false;
    }
}
