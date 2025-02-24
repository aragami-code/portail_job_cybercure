<!doctype html>
<html lang="en" class="no-js">
  <head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control: no-cache, no-store, must-revalidate"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'laravel role admin')</title>
    @include('backend.layouts.partials.cssL')

  </head>
  <body>

    <div class="alice-bg padding-top-70 padding-bottom-70">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="breadcrumb-area">
              <h1>Mode Simplifié</h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="col-md-6">

          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="alice-bg section-padding-bottom">
      <div class="container no-gliters">
        <div class="row no-gliters">
          <div class="col">
            <div class="dashboard-container">
              <div class="dashboard-content-wrapper">

                @yield('admin-content')



              <div class="dashboard-sidebar">

               @include('backend.layouts.partials.sidebarL')







              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action -->

    <!-- Call to Action End -->

    <!-- Footer -->
    <footer class="footer-bg">

@include('backend.layouts.partials.footerL')
    </footer>
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->



  </body>
</html>

