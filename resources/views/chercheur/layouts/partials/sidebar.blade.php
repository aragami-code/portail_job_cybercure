
@php
$usr = Auth::guard('chercheur')->user();
@endphp


<div class="sidebar-menu">
    <div class="sidebar-header">
        <div>
        <a href="{{route('chercheur.dashboard')}}"><h4 class="text-white">CYBER-CURE</h4></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                     <center><img class="avatar user-thumb" src="{{asset('user/images/Chercheur')}}/{{Auth::guard('chercheur')->user()->photo}}" alt="avatar" style="border-radius: 50%; width: 200px; height: 200px;"></center>


                       {{--/////////////////////////////////////////////////gestion des types d'emplos////////////////////////////////////  --}}


                       <li class="{{Route::is('chercheur.dashboard') ? 'active' : ''}}">
                           <a href="{{route('chercheur.dashboard')}}" aria-expanded="true"><i class="ti-new-window"></i><span>Consulter les offres
                               </span></a>

                        </li>


                        <form id="admin-logout-form" action="{{ route('chercheur.logout.submit') }}" method="POST" style="display: none;">
                            @csrf
                        </form>



                        <li class="{{Route::is('chercheur.postemplois.emploispostule') ? 'active' : ''}}"> <a href="{{route('chercheur.postemplois.emploispostule',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-expanded="true"> <i class="fa fa-check-square"></i><span>
                        </span>Emplois postulés</a></li>

                        <li class="{{Route::is('chercheur.postemplois.emploisfav') ? 'active' : ''}}"> <a href="{{route('chercheur.postemplois.emploisfav',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-expanded="true"> <i class="ti-heart"></i><span>
                        </span>Emplois Favoris</a></li>

                        <li class="{{ Route::is('chercheur.profile.edit')? 'active' : ''}}"><a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}"> <i class="ti-user"></i><span>
                        </span>Mon profil</a></li>
                        <li class="{{  Route::is('chercheur.profile.index') ? 'active' : ''}}"><a  href="{{route('chercheur.profile.index')}}"> <i class="ti-notepad"></i><span>
                        </span>Mes informations</a></li>
                       <li> <a href="{{ route('chercheur.logout.submit') }}" aria-expanded="true" onclick="event.preventDefault();
                                document.getElementById('admin-logout-form').submit();"> <i class="ti-lock"></i><span>
                            </span>Déconnection</a></li>














                </ul>
            </nav>
        </div>
    </div>
</div>
