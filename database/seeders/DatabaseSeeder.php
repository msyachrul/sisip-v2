<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->truncate();

        $this->call([
            PermissionsTableSeeder::class,
        ]);

        $role = $this->createSuperAdminRole();
        $role->permissions()->sync($this->getPermissionIDs());

        $user = $this->createSuperAdminUser();
        $user->roles()->sync($role->id);

        Schema::enableForeignKeyConstraints();
    }

    protected function truncate()
    {
        RoleUser::truncate();
        PermissionRole::truncate();
        User::truncate();
        Role::truncate();
        Permission::truncate();
    }

    protected function createSuperAdminUser()
    {
        return User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => '123123',
        ]);
    }

    protected function createSuperAdminRole()
    {
        return Role::create([
            'name' => 'Super Admin',
            'slug' => 'Super Admin',
        ]);
    }

    protected function getPermissionIDs()
    {
        return Permission::all()
            ->pluck('id')
            ->all();
    }
}
