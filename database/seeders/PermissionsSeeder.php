<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        Permission::upsert($this->getPermissions(), ['id'], ['name', 'guard_name']);
        $editor_permissions = [1];

        Role::findByName('Editor')->givePermissionTo(
            Arr::pluck(
                array_filter($this->getPermissions(), fn($permission) => in_array($permission['id'], $editor_permissions)),
                'name'
            )
        );
    }

    private function getPermissions(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Create blog',
                'guard_name' => 'web',
            ]
        ];
    }
}
