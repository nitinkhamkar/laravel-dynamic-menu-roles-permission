<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

     // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'view']);

     // this can be done as separate statements
         //create admin role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        /*create user role */
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('edit');

    
    /** @var \App\User $user */
   // $user = factory(\App\User::class)->create();
  //  $user->assignRole('user');

      
    //Role::create(['name' => 'admin','guard_name'=>'web']);


    /** @var \App\User $user */
  /*  $admin = factory(\App\User::class)->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);*/
        $user=new User;
        $useradmin=$user->findOrFail(1);
        $useradmin->assignRole('admin');
    }  
    
}
