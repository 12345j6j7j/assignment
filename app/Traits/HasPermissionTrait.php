<?php

namespace App\Traits;


use App\Permission;
use DB;

trait HasPermissionTrait
{

    /**
     * method used to attach permission to the model
     *
     * @param int $permission_id
     */
    public function addPermission($permission_id)
    {
        $this->permissions()->attach($permission_id);
    }

    /**
     * method used to detach permission to the model
     *
     * @param int $permission_id
     */
    public function removePermission($permission_id)
    {
        $this->permissions()->detach($permission_id);
    }

    /**
     * method used to sync permission to the model
     *
     * @param int $permission_id
     */
    public function syncPermission($permission_id)
    {
        $this->permissions()->sync($permission_id);
    }

    /**
     * method used to return all permissions for the model
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions()->visible()->get();
    }

    /**
     * method used ti check if user has any permission
     *
     * @param $permissions
     * @return bool
     */
    public function hasAnyPermission($permissions): bool
    {
        return $this->hasPermissionTo($permissions);
    }

    /**
     * Determine if the model may perform the given permission.
     *
     * @param $guard_name
     * @return bool
     */
    public function hasPermissionTo($guard_name): bool
    {
        if (is_string($guard_name)) {
            $permission = app(Permission::class)->where('guard_name', $guard_name)->first();
        }

        if (is_int($guard_name)) {
            $permission = app(Permission::class)->find($guard_name);
        }

        return !empty($permission) ? $this->hasDirectPermission($permission) : false;
    }

    /**
     * Determine if the model has the given permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasDirectPermission($permission): bool
    {
        if (is_string($permission)) {
            $permission = app(Permission::class)->where('guard_name', $permission)->first();
            if (!$permission) {
                return false;
            }
        }

        if (is_int($permission)) {
            $permission = app(Permission::class)->find($permission);
            if (!$permission) {
                return false;
            }
        }

        return DB::table('permission_role')
            ->join('role_user', 'permission_role.role_id', '=', 'role_user.role_id')
            ->where('role_user.user_id', $this->id)->where('permission_role.permission_id', $permission->id)->exists();

//        return $this->permission->contains('id', $permission->id);
    }

    /**
     * method used to convert pipe in array
     *
     * @param string $pipeString
     * @return array|string
     */
    protected function convertPipeToArray(string $pipeString)
    {
        $pipeString = trim($pipeString);

        if (strlen($pipeString) <= 2) {
            return $pipeString;
        }

        $quoteCharacter = substr($pipeString, 0, 1);
        $endCharacter = substr($quoteCharacter, -1, 1);

        if ($quoteCharacter !== $endCharacter) {
            return explode('|', $pipeString);
        }

        if (!in_array($quoteCharacter, ["'", '"'])) {
            return explode('|', $pipeString);
        }

        return explode('|', trim($pipeString, $quoteCharacter));
    }
}