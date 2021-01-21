<?php
/**
 * Created by PhpStorm.
 * User: Nebojsa Markovic
 * Date: 26.7.2018.
 * Time: 09:26
 */

namespace App\Traits;

use App\Role;

trait HasRoleTrait
{
    /**
     * method used to attach role to the model
     *
     * @param int $role_id
     */
    public function addRole($role_id)
    {
        if (empty($this->roles()->find($role_id))) {
            $this->roles()->attach($role_id);
        }
    }

    /**
     * method used to detach role to the model
     *
     * @param int $role_id
     */
    public function removeRole($role_id)
    {
        if (empty($this->roles()->find($role_id))) {
            $this->roles()->detach($role_id);
        }
    }

    /**
     * method used to sync roles to the model
     *
     * @param int $role_id
     */
    public function syncRole($role_id)
    {
        if (empty($this->roles()->find($role_id))) {
            $this->roles()->sync($role_id);
        }
    }

    /**
     * method used to return all roles for the model
     *
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles()->visible()->get();
    }

    /**
     * method used ti check if user has any roles
     *
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles): bool
    {
        return $this->hasRole($roles);
    }

    /**
     * Determine if the model has the given roles
     *
     * @param $roles
     * @return bool
     */
    public function hasRole($roles): bool
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = $this->convertPipeToArray($roles);
        }

        if (is_string($roles)) {
            return $this->roles->contains('guard_name', $roles);
        }

        if ($roles instanceof Role) {
            return $this->roles->contains('id', $roles->id);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }

            return false;
        }

        return $roles->intersect($this->roles)->isNotEmpty();
    }
}