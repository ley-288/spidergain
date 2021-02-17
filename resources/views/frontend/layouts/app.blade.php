<!DOCTYPE html>

@langrtl

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

@else

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@endlangrtl

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>@yield('title', app_name())</title>

        <meta name="description" content="SpiderGain">

        @include('includes.partials.favicon')
       

        @yield('meta')

        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

		<script>

			WebFont.load({

				google: {

					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]

				},

				active: function() {

					sessionStorage.fonts = true;

				}

			});

		</script>

       

        @stack('before-styles')



        <!-- Check if the language is set to RTL, so apply the RTL layouts -->

        <!-- Otherwise apply the normal LTR layouts -->

         <link href="{{url('/')}}/css/v1/style.bundle.min.css" rel="stylesheet" type="text/css">
         <link href="{{url('/')}}/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />



        @stack('after-styles')

    </head>

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

        @include('includes.partials.demo')



                @yield('content')

           

        <script>

			var KTAppOptions = {

				"colors": {

					"state": {

						"brand": "#5d78ff",

						"dark": "#282a3c",

						"light": "#ffffff",

						"primary": "#5867dd",

						"success": "#34bfa3",

						"info": "#36a3f7",

						"warning": "#ffb822",

						"danger": "#fd3995"

					},

					"base": {

						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],

						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]

					}

				}

			};

		</script>

        <!-- Scripts -->

        @stack('before-scripts')

      

        <script src="{{url('/')}}/assets/vendors/general/jquery/dist/jquery.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/popper.js/dist/umd/popper.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/js-cookie/src/js.cookie.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/moment/min/moment.min.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/sticky-js/dist/sticky.min.js"></script>

        <script src="{{url('/')}}/assets/vendors/general/wnumb/wNumb.js"></script>

        <script src="{{url('/')}}/js/scripts.bundle_v.js"></script>

       

        

        @stack('after-scripts')


        @include('cookieConsent::index')
        @include('includes.partials.ga')

    </body>

</html>

