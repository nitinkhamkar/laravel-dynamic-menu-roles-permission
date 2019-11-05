<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- stack is use for add css and js properly -->
        @stack('meta')
     

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
   

    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ URL::asset('css/admin/app.css') }}" rel="stylesheet">

     
    @stack('styles')
<style type="text/css">
.bg-red{
        border-radius: 4px;background-color: #484242f5 !important;
}
.response-danger {
    color: #a94442; 
    background-color: #f2dede;
    border-color: #ebccd1;
}
.response-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.response {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

#notificator {
   display : none; left : 50%;
   margin-left : -100px; padding : 15px 25px;
   position : fixed; text-align : center;
  top : 20px; width : 200px; z-index : 5000; 
}
</style>

     
</head>
<body class="@yield('class')">
      <div id="notificator" class="response"></div>
   
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    
    @section('content')
    @show

    @section('modals')
    @show

    <!-- Scripts -->
    <script src="{{ URL::asset('js/admin/app.js') }}" ></script>
    @if(Session::has('flash_message'))
    <script type="text/javascript">
        
        $(document).ready(function(){

         ShowNotificator('response-success',"{{ Session::get('flash_message') }}");  
       
        });
     
    </script>
    @elseif($errors->any())
    <script type="text/javascript">
        
        $(document).ready(function(){

         ShowNotificator('response-danger'," {{ $errors->first() }}");  
       
        });
     
    </script>
    

    @endif
    <script type="text/javascript" >
        // Top Notificator
    function ShowNotificator(add_class, the_text) {
        $('div#notificator').text(the_text).addClass(add_class).slideDown('slow').delay(3000).slideUp('slow', function () {
            $(this).removeClass(add_class).empty();
        });
    }
    </script>
    
    {{-- add custum js --}}
    @stack('scripts')
</body>
</html>
