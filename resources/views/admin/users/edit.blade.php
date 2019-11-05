
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
                            <h2>Edit Role: {{ucfirst($role->name)}}</h2>
                            
                        </div>
                        <div class="body">
     @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                       {{ $errors->first() }}
        </div>
    @endif
   
                          <form id="form_role" action="{{ route('roles.update', $role->id) }}" method="POST">
                             @csrf
                             <!-- Rendered blade HTML form use this hidden. Dont forget to put the form method to POST -->

                            <input name="_method" type="hidden" value="PUT">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $role->name)}}" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                               {{--  <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="surname" required>
                                        <label class="form-label">Surname</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap">
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap">
                                    <label for="female" class="m-l-20">Female</label>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" required>
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> --}}
                                 <h2 class="card-inside-title">Pages</h2>
                                <div class="form-group">

                                    <div class="form-line">
                                    @foreach ($pages as $page)
                                    <input type="checkbox" id="{{$page->title}}" name="pages[]" value="{{$page->id}}" {{ ((is_array(old('pages', $roleHaspages)) and in_array($page->id, old('pages[]',$roleHaspages))) ? 'checked' : '') }}>
                                    <label for="{{$page->title}}">{{ucfirst($page->title)}}</label>
                                    &nbsp;&nbsp;
                                    @endforeach
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Permissions</h2>
                                <div class="form-group">
                                     @foreach ($permissions as $permission)
                                    
                                    <input type="checkbox" id="{{$permission->name}}" name="permissions[]" value="{{$permission->id}}" {{ ((is_array(old('permissions', $rolHaspermissions)) and in_array($permission->id, old('permissions[]',$rolHaspermissions))) ? 'checked' : '') }}>
                                    <label for="{{$permission->name}}">{{ucfirst($permission->name)}}</label>
                                    &nbsp;&nbsp;
                                    @endforeach
                                </div>
                                <button class="btn  bg-green waves-effect" type="submit">UPDATE</button>
                                <a class="btn btn-primary waves-effect" href="{{url()->previous()}}">BACK</a>
                                 
                            </form>
                           
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
<link rel="stylesheet" href="#">
@endpush


{{-- and js from child page --}}
@push('scripts')
<script src="{{ asset('admin/js/ddsadmin.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#form_role').validate({
            rules: {
                // password: {
                //     required: true,
                //     minlength: 8,
                // },
            'pages[]': { required: true, minlength: 1 },
            'permissions[]': { required: true, minlength: 1 }
            },
            highlight: function (input) {
                console.log(input);
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
    });


</script>
@endpush



