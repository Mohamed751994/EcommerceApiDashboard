<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menu = Menu::get();
        $permissions = [];
        foreach ($menu as $m)
        {
            array_push($permissions, $m->route_name.'-index');
            array_push($permissions, $m->route_name.'-create');
            array_push($permissions, $m->route_name.'-show');
            array_push($permissions, $m->route_name.'-edit');
            array_push($permissions, $m->route_name.'-delete');
        }
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
