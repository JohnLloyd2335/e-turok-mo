<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- -->

    {{-- <link href="{{ asset('users/vendor/fontawesome-free/css/all.min.css" rel="stylesheet')}}" type="text/css "> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Custom styles for this template-->
    {{-- <link href="{{ asset('users/css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}

    <!-- -->


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
     <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-0 m-0">
            <div class="container-fluid px-5 bg bg-dark ">
                <a class="navbar-brand text-light" href="{{ route('dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown " class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> 

        <main>

            @yield('content')
        </main>
    </div>

    <script>
        /*
     *  jquery-ph-locations - v1.0.1
     *  jQuery Plugin for displaying dropdown list of Philippines' Region, Province, City and Barangay in your webpage.
     *  https://github.com/buonzz/jquery-ph-locations
     *
     *  Made by Buonzz Systems
     *  Under MIT License
     */
     ;( function( $, window, document, undefined ) {
        var filterfieldname = "";
        
        "use strict";
    
            // defaults
            var pluginName = "ph_locations",
                defaults = {
                    location_type : "provinces", // what data this control supposed to display? regions, provinces, cities or barangays?,
                    api_base_url: 'https://ph-locations-api.buonzz.com/',
                    order: "name asc",
                    filter: {}
                };
    
            // plugin constructor
            function Plugin ( element, options ) {
                this.element = element;
                this.settings = $.extend( {}, defaults, options );
                this._defaults = defaults;
                this._name = pluginName;
                this.init();
            }
    
            // Avoid Plugin.prototype conflicts
            $.extend( Plugin.prototype, {
                init: function() {
                    return this
                },
                
                fetch_list: function (filter) {
                    
                    this.settings.filter = filter;
                        
                    $.ajax({
                        type: "GET",
                        url: this.settings.api_base_url + 'v1/' +  this.settings.location_type,
                        success: this.onDataArrived.bind(this),
                        data: $.param(this.map_parameters())
                    });
                    
    
                    
                    
                    
    
                }, // fetch list
                onDataArrived(data){
                    var shtml = "";
                    $(this.element).html(this.build_options(data));
                },
    
                map_parameters(){
    
                    var mapped_parameter = {"filter": {
                        "where": {},
                        "order" : this.settings.order
                        }
                    };
    
                     for(var property in this.settings.filter)
                        mapped_parameter.filter.where[property] = this.settings.filter[property];
    
                     return mapped_parameter;
                },
    
                build_options(params){
                    var shtml = "";
                    shtml += '<option disabled selected>-SELECT-</option>';
                    for(var i=0; i<params.data.length;i++){
                        shtml += '<option value="' + params.data[i].id + '">';
                        shtml +=  params.data[i].name ;
                        shtml += '</option>';
                    }
    
                    return shtml
                }
                
            } );
    
    
            $.fn[ pluginName ] = function( options, args ) {
                return this.each( function() {
                    var $plugin = $.data( this, "plugin_" + pluginName );
                    if (!$plugin) {
                        var pluginOptions = (typeof options === 'object') ? options : {};
                        $plugin = $.data( this, "plugin_" + pluginName, new Plugin( this, pluginOptions ) );
                    }
                    
                    if (typeof options === 'string') {
                        if (typeof $plugin[options] === 'function') {
                            if (typeof args !== 'object') args = [args];
                            $plugin[options].apply($plugin, args);
                        }
                    }
                } );
            };
    
    } )( jQuery, window, document );
      </script>
      <script type="text/javascript">
                
        var my_handlers = {
    
            // fill_provinces:  function(){
    
            //     var region_code = $(this).val();
            //     $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
                
            // },
    
            fill_cities: function(){
    
                var province_code = $(this).val();
                $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
            },
    
    
            fill_barangays: function(){
    
                var city_code = $(this).val();
                $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
            }
        };
    
        $(function(){
            // $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);
    
            // $('#region').ph_locations({'location_type': 'regions'});
            $('#province').ph_locations({'location_type': 'provinces'});
            $('#city').ph_locations({'location_type': 'cities'});
            $('#barangay').ph_locations({'location_type': 'barangays'});
    
            $('#province').ph_locations('fetch_list');
        });
    </script>
    
    <script>
        $(function(){
    
    // whenever the province dropdown change, update the value of hidden field
     $('#province').on('change', function(){
    
           // we are getting the text() here, not val()
           var selected_caption = $("#province option:selected").text();
           
    
          // the hidden field will contain the name of the region, not the code
           $('input[name=province_name]').val(selected_caption);
    
     }).ph_locations('fetch_list');
    
    });
    
    $(function(){
    
    // whenever the city dropdown change, update the value of hidden field
     $('#city').on('change', function(){
    
           // we are getting the text() here, not val()
           var selected_caption = $("#city option:selected").text();
    
          // the hidden field will contain the name of the region, not the code
           $('input[name=municipality_name]').val(selected_caption);
    
     }).ph_locations('fetch_list');
    
    });
    
    $(function(){
    
    // whenever the city dropdown change, update the value of hidden field
     $('#barangay').on('change', function(){
    
           // we are getting the text() here, not val()
           var selected_caption = $("#barangay option:selected").text();
    
          // the hidden field will contain the name of the region, not the code
           $('input[name=barangay_name]').val(selected_caption);
    
     }).ph_locations('fetch_list');
    
    });
    </script>
</body>
</html>
