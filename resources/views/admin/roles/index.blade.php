<?php use App\Http\Controllers\admin\RoleController; ?>
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
                            <h2>Role List</h2>
                            
                        </div>
                        <div class="body">
   
    @if(Session::has('flash_message'))
    <div class="alert bg-light-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ Session::get('flash_message') }}
    </div>

    @endif
                    <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                     <tr>
                        <th>Role</th>
                         <th>Pages</th>
                        <th>Permissions</th>
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
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>{{  str_replace(array('[',']','"'),'',$role->pages->pluck('title'))}}</td>
                                           
                                            
                                            <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                            <td><a href="{{route('roles.edit',[$role->id])}}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="material-icons">edit</i></a>
                                            <form id="form_validation" action="{{route('roles.destroy',[$role->id])}}" method="POST">
                             @csrf
                               {{ method_field('DELETE') }}
                             <button class="btn btn-danger waves-effect" type="submit"><i class="material-icons">delete_forever</i></button>
                              </form></td>
                                             
                                            
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
@section('title','Add Role')

{{-- add meta in html --}}
@push('meta')
<meta name="robots" content="index,follow">
@endpush


{{-- add css for this page --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('js/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endpush


{{-- and js from child page --}}
@push('scripts')
<script src="{{ asset('js/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script>
    $(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    
});
</script>

@endpush



