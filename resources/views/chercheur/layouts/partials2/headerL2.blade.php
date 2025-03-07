<div id="header-wrap">
    <div class="container">
        <div class="header-row">

            <!-- Logo
        ============================================= -->
        <div id="logo">
            <a href="{{Route('accueil1')}}" class="standard-logo" data-dark-logo="{{asset('site/img/logo2.png')}}"><img src="{{asset('site/img/logo2.png')}}" alt="CYBER-CURE Logo"></a>
            <a href="{{Route('accueil1')}}" class="retina-logo" data-dark-logo="{{asset('site/img/logo2.png')}}"><img src="{{asset('site/img/logo2.png')}}" alt="CYBER-CURE Logo"></a>
        </div>
            <!-- #logo end -->

            <div class="header-misc">



            </div>

            <div id="primary-menu-trigger">
                <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
            </div>

            <!-- Primary Navigation
        ============================================= -->
            <!-- Primary Navigation
            ============================================= -->
            <nav class="primary-menu">

                <ul class="menu-container">
                    <li class="menu-item mega-menu">
                        <a class="menu-link" href="{{route('chercheur.dashboard')}}" >
                            <div style="font-size:10pt">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item mega-menu">
                        <a class="menu-link" href="{{ route('chercheur.logout.submit') }}" aria-expanded="true" onclick="event.preventDefault();
                        document.getElementById('admin-logout-form').submit();">
                            <div style="font-size:10pt">Deconnexion</div>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- #primary-menu end -->
            <!-- #primary-menu end -->


        </div>
    </div>
</div>
<div class="header-wrap-clone"></div>
