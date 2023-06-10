<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
            $this->command->line('');
            return false;
        }

        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Models\Role::updateOrCreate([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role ' . strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::updateOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to ' . $permissionValue . ' for ' . $module);
                }
            }

            // Add all permissions to the role
            $role->permissions()->sync($permissions);

            if (Config::get('laratrust_seeder.create_users')) {
                $this->command->info("Creating '{$key}' user");
                // Create default user for each role
                $user = \App\Models\User::create([
                    'name' => ucwords(str_replace('_', ' ', $key)),
                    'email' => $key . '@app.com',
                    'password' => bcrypt('password')
                ]);
                $user->addRole($role);
            }
        }
        $superadministratorRole = Role::whereName('superadministrator')->first();
        $user = User::updateOrCreate([
            'first_name' => 'Filbert',
            'last_name' => 'Msaki',
            'phone' => '0762650393',
            'email' => 'filymsaki@gmail.com'
        ], [
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678')
        ]);
        $user->roles()->attach($superadministratorRole);

        $administratorRole = Role::whereName('administrator')->first();
        $administrator = User::updateOrCreate([
            'first_name' => 'Jackson',
            'last_name' => 'Swebe',
            'phone' => '0754222800',
            'email' => 'jackson.swebe@gmail.com'
        ], [
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('0754222800')
        ]);
        $administrator->roles()->attach($administratorRole);
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();

        if (Config::get('laratrust_seeder.truncate_tables')) {
            DB::table('roles')->truncate();
            DB::table('permissions')->truncate();

            if (Config::get('laratrust_seeder.create_users')) {
                $usersTable = (new \App\Models\User)->getTable();
                DB::table($usersTable)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
