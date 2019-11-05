
@extends('layouts.app')

@section('content')


    <!-- Top Bar -->
     @include('admin.common.topbar')
    <!-- end Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('admin.common.leftsidebar')
        <!-- #END# Left Sidebar -->

        <!-- Right Sidebar -->
        @include('admin.common.rightsidebar')
        <!-- END Right Sidebar -->
        
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>BREADCRUMBS</h2>
            </div>
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                       
                        <div class="header bg-red" style="border-radius: 4px">
                            <h2>Assign Roles List</h2>
                            
                        </div>
                        <div class="body">
                            <div id="notificator" class="error"></div>
   
   {{--  @if(Session::has('flash_message'))
    <div class="alert bg-light-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ Session::get('flash_message') }}
    </div>

    @endif --}}
                    <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                     <tr>
                        <th>User ID</th>
                         <th>Name</th>
                        <th>Assigned-Role</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                                   {{--  <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> --}}
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                           
            <?php $selectedrole=str_replace(array('[',']','"'),'',$user->roles->pluck('id'));
            $property=($user->hasRole('super-admin') ? 'disabled' : ''); ?>                               
                                            
                                        <td>
                                            <select  data-userid="{{$user->id}}" class="selectpicker show-tick form-control" {{$property}}>
                                            <option value="">--select--</option>
                                            @foreach ($roles as $role)
                                            @if($role->id==1 and !$user->hasRole('super-admin'))
                                            <?php continue; ?>
                                            @endif
                                            <option value="{{$role->id}}" {{ ($role->id == $selectedrole ? 'selected="selected"' : '' )}} > {{ $role->name }}</option>
                                            @endforeach
                                            </select>

                                        </td>
                                        <td class="no-sort">
                                            <a href="{{route('users.edit',[$user->id])}}" class=" pull-left" style="margin-right: 3px;"><i class="material-icons">edit</i></a>
                                            <div class="switch">
                                            
                                            <label><input type="checkbox"  @if(!$user->trashed())checked  @endif data-userid="{{ $user->id }}" {{$property}} /><span class="lever switch-col-green"></span></label>
                                            
                                        </div></td>
                                           {{--  <td><a href="{{route('roles.edit',[$role->id])}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                            <form id="form_validation" action="{{route('roles.destroy',[$role->id])}}" method="POST">
                             @csrf
                               {{ method_field('DELETE') }}
                             <button class="btn btn-danger waves-effect" type="submit">Delete</button>
                              </form></td> --}}
                                             
                                            
                                        </tr>
                                         @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
    </section>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('class','theme-red')
{{-- add tile section  --}}
@section('title','Assign Roles List')

{{-- add meta in html --}}
@push('meta')
<meta name="robots" content="index,follow">
@endpush


{{-- add css for this page --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('js/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('js/admin/plugins/sweetalert/sweetalert.css') }}">

@endpush


{{-- and js from child page --}}
@push('scripts')
<script src="{{ asset('js/admin/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script>

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(function () {
       
    $('.js-basic-example').DataTable({
        responsive: true,
       "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [3]
           
        } ],
        "order": [[ 1, 'asc' ]],
    });

    //onchage event edit role assign
    $(".selectpicker").change(function(){
        var roleid=$(this).val(); 
        var userid=$(this).data("userid");
       // console.log(userid);
  showConfirmMessage(userid,roleid);
    });

    
}); //document ready bracket

    //asssign role to user
 function assignRole(userid,roleid)
    {
       // ajax update data from database
          $.ajax({
            url : "users/"+userid,
            type: "PUT",
            dataType: "html",
            data:{_token: CSRF_TOKEN,roleid: roleid},
            success: function(data)
            {   
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error disabling data');
            }
        });

    }

    //enable disabled user
    //onchage event edit role assign
    $(".switch").find("input[type=checkbox]").on("change",function() {
        var userstatus = $(this).prop('checked');
        var userid=$(this).data("userid");

       $.ajax({
            url : "users/"+userid,
            type: "POST",
            dataType: "html",
            data:{_token: CSRF_TOKEN,"_method": 'DELETE',userstatus:userstatus},
            success: function(data)
            {   console.log(data);
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error disabling data');
            }
        });

    });
 
    

function showConfirmMessage(userid,roleid) {
    swal({
        title: "Are you sure?",
       // text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, do it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        if(isConfirm)
       {
        assignRole(userid,roleid);
       }else
       location.reload(true);
       
    });
}


</script>

@endpush



