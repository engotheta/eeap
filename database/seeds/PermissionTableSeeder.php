<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
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
        // DB::table('permissions')->truncate();
        $permissions =  Permission::all();
        $perms = [];
        $routes = Route::getRoutes();
        $count = $routes->count();
        $recorded = 0;

        foreach ($routes as $route) {
            if (isset($route->getAction()['as'])) {
                if (
                    !$permissions->contains('name', $route->getAction()['as']) and
                    !empty($route->getAction()['as'] and strpos($route->getAction()['as'], '.') != false) and
                    $route->getAction()['prefix'] == '/cms' )
                {

                    $permissions->add(Permission::create(['name' => $route->getAction()['as']]));
                    $recorded++;
                }
            }
        };

        echo "<br> \\n Total: ".$count." Recorded: ".$recorded." <br> \\n";
    }
}
