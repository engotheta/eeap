<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = Role::create(['name' => 'Administrator']);
        $default = Role::create(['name' => 'Default']);

        $admin->givePermissionTo(Permission::all());
    }


}
