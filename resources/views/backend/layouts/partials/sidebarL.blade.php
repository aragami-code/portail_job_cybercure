@php
$usr = Auth::guard('admin')->user();
@endphp


<div class="company-info">
    <div class="thumb">
        <img class="avatar user-thumb" src="{{asset("backend/images/parametres/$parametre->logo")}}" class="img-fluid" alt="avatar" width="60%">


    </div>
    <div class="company-body">
      <h5>{{$parametre->nom_site}}</h5>
      <span>@username</span>
    </div>
  </div>

  <div class="dashboard-menu">
    @if ($usr->can('Post_Emploi.create') || $usr->can('Post_Emploi.view')  || $usr->can('Post_Emploi.edit') || $usr->can('Post_Emploi.delete') || $usr->can('Emploi_Postuler.view'))

    <ul {{ Route::is('admin.postemplois.create') || Route::is('admin.postemplois.indexL') ||  Route::is('admin.postemplois.edit') || Route::is('admin.postemplois.show')|| Route::is('admin.emploispostuler.index') || Route::is('admin.chercheurprofile.edit') ||  Route::is('admin.postemplois.matcher') || Route::is('admin.emploispostuler.show')? 'in' : ''}}>
      <li class="active"><i class="fas fa-home"></i><a href="">Mode Simplifié</a></li>
      <li class="fas fa-dashcube"><i class="fas fa-home"></i><a href="{{ route('admin.dashboard')}}">Mode Administrateur</a></li>
      @if ($usr->can('Post_Emploi.create'))
      <li><i class="fas fa-plus-square{{ Route::is('admin.postemplois.create') ? 'active' : ''  }}"></i><a href="{{route('admin.postemplois.create')}}">Creer une Offre</a></li>
      @endif
      <li><i class="fas fa-user"></i><a href="employer-dashboard-edit-profile.html">Editer les Informations du site</a></li>


      @if ($usr->can('Post_Emploi.view'))
      <li><i class="fas fa-briefcase {{ Route::is('admin.postemplois.indexL') || Route::is('admin.postemplois.edit') ? 'active' : ''}}"></i><a href="{{route('admin.postemplois.indexL')}}">Gerer les Offres</a></li>
      @endif

      @if ($usr->can('Emploi_Postuler.view'))

      <li><i class="fas fa-users {{ Route::is('admin.emploispostuler.index') || Route::is('admin.chercheurprofile.edit')|| Route::is('admin.emploispostuler.create')|| Route::is('admin.emploispostuler.edit') || Route::is('admin.emploispostuler.show') ? 'active' : ''  }}"></i><a href="employer-dashboard-manage-candidate.html">Candidats Ayant postulés</a></li>
        @endif

        {{--@if ($usr->can('Post_Emploi.create'))
            <li class="{{ Route::is('admin.postemplois.matcher') ? 'active' : ''  }}"><a href="{{route('admin.postemplois.matcher')}}">Rechercher profil</a></li>
            @endif
      <li><i class="fas fa-heart"></i><a href="#">shortlist</a></li>--}}
      <li><i class="fas fa-power-off"></i><a href="{{ route('admin.logout.submit') }}"onclick="event.preventDefault();document.getElementById('admin-logout-form').submit();">Déconnection</a>
        <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
        @csrf
        </form>
    </li>

    </ul>


    @endif


    <!-- Modal -->

  </div>
