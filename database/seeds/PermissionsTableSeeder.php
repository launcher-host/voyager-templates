<?php

use Illuminate\Database\Seeder;
use akazorg\VoyagerTemplates\Models\Template as VoyagerTemplate;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // Skip if already exists
        if (Permission::where('table_name', 'voyager_templates')->first()) {
            return;
        }

        Permission::generateFor('voyager_templates');

        $role = Role::where('name', 'admin')->first();

        if (!is_null($role)) {
            $role->permissions()->attach(
                Permission::where('table_name', 'voyager_templates')->pluck('id')->all()
            );
        }
    }
}