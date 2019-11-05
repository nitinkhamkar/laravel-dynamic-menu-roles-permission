<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $users=User::withTrashed()->get();
       // $roles = Role::where('name', '!=', 'super-admin')->get();
        $roles = Role::all();
         
         return view('admin.users.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id==1)
         abort('401');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $roleid = $request['roleid'];
       if($id==1)
       abort('401');
       if ($user = User::find($id)) {
        $user->syncRoles($roleid);
       }
       // return redirect()->route('users.index')
       //      ->with('flash_message',
       //       'User as '. $user->roles->pluck('name').' Assigned!'); 
       session()->flash('flash_message', 'User as '. $user->roles->pluck('name').' Assigned!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {      

        if($id==1)
            abort('401');

       $userstatus = $request['userstatus'];
        $user = User::withTrashed()->find($id); // Can chain this line with the next one
          // dd($user);
            if($userstatus=='true')
            { 
           
            $user->restore();
            $status='Enabled';
            }
            else{
                 $user->delete();
                 $status='Disabled';
            }
           

        session()->flash('flash_message', 'User has '. $status.'!');
           
        //$id->softDeletes();
    }
}
