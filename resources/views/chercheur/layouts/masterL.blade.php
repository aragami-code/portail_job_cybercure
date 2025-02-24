<!doctype html>
<html lang="en">

<head>
<title>@yield('title', 'Utilisateur')</title>
    @include('chercheur.layouts.partials2.cssL')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control: no-cache, no-store, must-revalidate"/>
     <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <header id="header" class="full-header">
       @include('chercheur.layouts.partials2.headerL2')
     </header>

    <!-- Breadcrumb -->
 {{--   <div class="alice-bg padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="breadcrumb-form ">
                        <form action='{{url('user/Dashboard/search ')}}' method="post">
                            <input type="text" placeholder="Entrer un mot clé" id="prolist" class="col-md-12"/>

                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
}}--}}
    <!-- Breadcrumb End -->

    <div class="alice-bg section-padding-bottom">
        <div class="container no-gliters">
            <div class="row no-gliters">
                <div class="col">
                    <div class="dashboard-container">



                        @yield('admin-content')




                        <div class="dashboard-sidebar">
                            @include('chercheur.layouts.partials2.sidebarL')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <!-- Footer
		============================================= -->
    <footer id="footer" class="dark">


       @include('chercheur.layouts.partials2.footerL')
    </footer>
    <!-- #footer end -->
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


@include('chercheur.layouts.partials2.jsL')


</body>
@yield('scripts')
</html>
