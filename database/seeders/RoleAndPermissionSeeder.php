<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PermissionGroup;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * create users
         */
        User::factory()->create([
            'name' => 'Luka', 
            'surname' => 'Radulovic', 
            'email' => 'mail@mail.com',
            'password' => 'password',
            'is_active' => 1,
        ]);
        User::factory(5)->create();

        /**
         * create new PermissionGroups
         */
        PermissionGroup::factory()->create(['name' => 'User']);
        PermissionGroup::factory()->create(['name' => 'Role']);
        PermissionGroup::factory()->create(['name' => 'Permission group']);
        PermissionGroup::factory()->create(['name' => 'Permission']);
        PermissionGroup::factory()->create(['name' => 'Notification']);
        PermissionGroup::factory()->create(['name' => 'Rank']);
        PermissionGroup::factory()->create(['name' => 'Ship']);

        /**
         * create new Permissions
         */
        Permission::factory()->create(['permission_group_id' => 1, 'name' => 'Create', 'guard_name' => 'user-create']);
        Permission::factory()->create(['permission_group_id' => 1, 'name' => 'Edit', 'guard_name' => 'user-edit']);
        Permission::factory()->create(['permission_group_id' => 1, 'name' => 'Delete', 'guard_name' => 'user-delete']);
        Permission::factory()->create(['permission_group_id' => 1, 'name' => 'View', 'guard_name' => 'user-view']);

        Permission::factory()->create(['permission_group_id' => 2, 'name' => 'Create', 'guard_name' => 'role-create']);
        Permission::factory()->create(['permission_group_id' => 2, 'name' => 'Edit', 'guard_name' => 'role-edit']);
        Permission::factory()->create(['permission_group_id' => 2, 'name' => 'Delete', 'guard_name' => 'role-delete']);
        Permission::factory()->create(['permission_group_id' => 2, 'name' => 'View', 'guard_name' => 'role-view']);

        Permission::factory()->create(['permission_group_id' => 3, 'name' => 'Create', 'guard_name' => 'permission-group-create']);
        Permission::factory()->create(['permission_group_id' => 3, 'name' => 'Edit', 'guard_name' => 'permission-group-edit']);
        Permission::factory()->create(['permission_group_id' => 3, 'name' => 'Delete', 'guard_name' => 'permission-group-delete']);
        Permission::factory()->create(['permission_group_id' => 3, 'name' => 'View', 'guard_name' => 'permission-group-view']);

        Permission::factory()->create(['permission_group_id' => 4, 'name' => 'Create', 'guard_name' => 'permission-create']);
        Permission::factory()->create(['permission_group_id' => 4, 'name' => 'Edit', 'guard_name' => 'permission-edit']);
        Permission::factory()->create(['permission_group_id' => 4, 'name' => 'Delete', 'guard_name' => 'permission-delete']);
        Permission::factory()->create(['permission_group_id' => 4, 'name' => 'View', 'guard_name' => 'permission-view']);

        Permission::factory()->create(['permission_group_id' => 5, 'name' => 'Create', 'guard_name' => 'notification-create']);
        Permission::factory()->create(['permission_group_id' => 5, 'name' => 'Edit', 'guard_name' => 'notification-edit']);
        Permission::factory()->create(['permission_group_id' => 5, 'name' => 'Delete', 'guard_name' => 'permission-delete']);
        Permission::factory()->create(['permission_group_id' => 5, 'name' => 'View', 'guard_name' => 'notification-view']);

        Permission::factory()->create(['permission_group_id' => 6, 'name' => 'Create', 'guard_name' => 'rank-create']);
        Permission::factory()->create(['permission_group_id' => 6, 'name' => 'Edit', 'guard_name' => 'rank-edit']);
        Permission::factory()->create(['permission_group_id' => 6, 'name' => 'Delete', 'guard_name' => 'rank-delete']);
        Permission::factory()->create(['permission_group_id' => 6, 'name' => 'View', 'guard_name' => 'rank-view']);

        Permission::factory()->create(['permission_group_id' => 7, 'name' => 'Create', 'guard_name' => 'ship-create']);
        Permission::factory()->create(['permission_group_id' => 7, 'name' => 'Edit', 'guard_name' => 'ship-edit']);
        Permission::factory()->create(['permission_group_id' => 7, 'name' => 'Delete', 'guard_name' => 'ship-delete']);
        Permission::factory()->create(['permission_group_id' => 7, 'name' => 'View', 'guard_name' => 'ship-view']);

        Role::factory()->create(['name' => 'Administrator', 'guard_name' => 'administrator']);
        Role::factory()->create(['name' => 'Crew Member', 'guard_name' => 'crew-member']);

        $super_admin_role = Role::find(1);
        $crew_member_role = Role::find(2);

        /**
         * assign super admin role to all some permissions
         */
        $super_admin_role->permissions()->sync(Permission::pluck('id')->toArray());

        $crew_member_permissions = Permission::whereIn('guard_name', [
            'user-view', 'notification-view', 'rank-view'
        ])->pluck('id')->toArray();

        $crew_member_role->permissions()->sync($crew_member_permissions);

        /**
         * assign user to all user permissions
         */
        $luka_user = User::find(1);
        $crew_member_user = User::find(2);

        $luka_user->addRole($super_admin_role->id);
        $crew_member_user->addRole($crew_member_role->id);
    }
}
