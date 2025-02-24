@php
$usr = Auth::guard('chercheur')->user();
@endphp



<div class="user-info">
    <div class="thumb">
        <img class="avatar img-fluid" src="{{asset('user/images/Chercheur')}}/{{Auth::guard('chercheur')->user()->photo}}" alt="avatar" style="border-radius: 50%; width: 50px; height: 50px;">
    </div>
    <div class="user-body">
        <h5><a href="{{route('chercheur.dashboard')}}">CYBER-CURE</a></h5>
        <span>nom utilisateur</span>
    </div>
</div>
<div class="profile-progress">
    <div class="progress-item">
        <div class="progress-head">
            <p class="progress-on">Profile</p>
        </div>
        <div class="progress-body">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
            </div>
            <p class="progress-to">70%</p>
        </div>
    </div>
</div>
<div class="dashboard-menu">
    <ul>
       <!-- <li class="active"><i class="fas fa-home"></i><a href="dashboard.html">Dashboard</a></li>-->
        <li class="{{Route::is('chercheur.dashboard') ? 'active' : ''}}">
            <a href="{{route('chercheur.dashboard')}}" aria-expanded="true"><i data-feather="search"></i><span>Consulter les offres
                </span></a>

         </li>
         <form id="admin-logout-form" action="{{ route('chercheur.logout.submit') }}" method="POST" style="display: none;">
            @csrf
        </form>



        <li class="{{Route::is('chercheur.postemplois.emploispostule') ? 'active' : ''}}"> <a href="{{route('chercheur.postemplois.emploispostule',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-expanded="true"> <i data-feather="check-square"></i><span>
        </span>Emplois postulés</a></li>

        <li class="{{Route::is('chercheur.postemplois.emploisfav') ? 'active' : ''}}"> <a href="{{route('chercheur.postemplois.emploisfav',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-expanded="true"> <i data-feather="heart"></i><span>
        </span>Emplois Favoris</a></li>

        <li class="{{ Route::is('chercheur.profile.edit')? 'active' : ''}}"><a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}"> <i data-feather="user"></i><span>
        </span>Mon profil</a></li>
        <li class="{{  Route::is('chercheur.profile.index') ? 'active' : ''}}"><a  href="{{route('chercheur.profile.index')}}"> <i data-feather="list"></i><span>
        </span>Mes informations</a></li>



    </ul>

    <!-- Modal -->

</div>
