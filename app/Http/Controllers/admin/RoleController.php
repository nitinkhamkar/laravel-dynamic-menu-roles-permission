<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Model\Page;
use App\Model\Role_has_page;
use DB;



use Session;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       $roles = Role::all();//Get all roles
       $pages=Page::all();
       // $role = Role::findOrfail(1);
       // $role->pages()->attach(2);

       // dd($role);
       // dd($users);
       
      
        return view('admin.roles.index',compact('roles','pages'));
    }

//     public static function getRolePages($role_id) {
//           $pages = DB::table('roles as r')
//             ->join('role_has_pages as rp', 'r.id', '=', 'rp.role_id')
//             ->join('pages as p', 'p.id', '=', 'rp.page_id')
//             ->select('p.*')
//              ->where('r.id', '=', $role_id)
//             ->get();
//             return $pages;
// }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::all();//Get all permissions
        $pages=Page::all();
        

        return view('admin.roles.create',compact('permissions','pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    //Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|unique:roles|max:15',
            'pages' =>'required',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();
        //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }
        //Looping thru selected Pages
          $pages = $request['pages'];
        foreach ($pages as $page) {
            $role->pages()->attach($page);
        }

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $role = Role::findOrFail($id);

        $permissions = Permission::all();

        $pages=Page::all();

        $rolHaspermissions=$role->getAllPermissions()->pluck('id')->toArray();

        $roleHaspages=$role->pages->pluck('id')->toArray();
       
      


        return view('admin.roles.edit', compact('role','pages', 'permissions','rolHaspermissions','roleHaspages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $role = Role::findOrFail($id);//Get role with the given id
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:15|unique:roles,name,'.$id,
            'pages' =>'required',
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions','pages']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }
        //pages save and updated
        $pages = $request['pages'];

        $role->pages()->sync($pages);
      

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role '. $role->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $role = Role::findOrFail($id);
        //delete page reloted to role
        $role->pages()->detach();
       
        $role->delete();

        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

       

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role deleted!');

    }
}