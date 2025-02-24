@extends('chercheur.layouts.masterL')


@section('title')
Profile | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">

@endsection



@section('admin-content')




<div class="alice-bg section-padding-bottom">
    <div class="container no-gliters">
      <div class="row no-gliters">
        <div class="col">
          <div class="dashboard-container">
            <div class="dashboard-content-wrapper">
              <div class="download-resume dashboard-section">
                </div>
              <div class="skill-and-profile dashboard-section">

              </div>
              <div class="about-details details-section dashboard-section">
                <h4><i data-feather="align-left"></i>A Propos de moi</h4>
                <p>  {{Auth::guard('chercheur')->user()->description}}</p>
                <div class="information-and-contact">
                  <div class="information">
                    <h4>Informations</h4>
                    <ul>

                        <li><span> Nom de l'utilisateur:</span>{{Auth::guard('chercheur')->user()->name}}</li>
                        <li><span>Prenom:</span> {{Auth::guard('chercheur')->user()->prenom}}</li>
                        <li><span>Nom de Famille:</span> {{Auth::guard('chercheur')->user()->nom_famille}}</li>

                        <li><span>Date de naissance:</span> {{Auth::guard('chercheur')->user()->date_naiss}}</li>
                        <li><span>Telephone:</span> {{Auth::guard('chercheur')->user()->telephone}} </li>
                        <li><span>Sex:</span> {{Auth::guard('chercheur')->user()->genre}}</li>

                        <li><span>Address:</span> {{Auth::guard('chercheur')->user()->adresse}}</li>
                        <li><span>E-mail:</span> {{Auth::guard('chercheur')->user()->email}}</li>

                      <li><span>Profession:</span>  {{Auth::guard('chercheur')->user()->metier}}</li>
                      <li><span>Années d'experience:</span> {{Auth::guard('chercheur')->user()->experience}}</li>

                    </ul>
                  </div>
                </div>

              </div>
              <div class="edication-background details-section dashboard-section">
                <h4><i data-feather="book"></i>Formations</h4>

             @foreach ($NivEtu as $post)
                <div class="education-label">

                    <span class="study-year">{{ $post->annee  }}</span><br>
                    <h5>{{ $post->titre_niveau  }} Option: {{ $post->option  }}</h5>
                    <h5>Ecole/Institut/Centre de Formation:<span>{{ $post->institution }}</span></h5><br>
                    <h5>Description:</h5>
                   <p>{{ $post->description }}</p>

                </div>



 @endforeach




              </div>



              <div class="professonal-skill dashboard-section details-section">
                <h4><i data-feather="feather"></i>Competences</h4>
                <div class="progress-group">

                    @foreach($comp as $competence)






                    <div class="progress-item">


                      <div class="progress-head">
                        <p class="progress-on">{{ $competence->competences_user }} Niveau: {{ $competence->niveau  }}</p>
                      </div>
                      <div class="progress-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="{{$competence->pourcentage}}" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                        </div>
                        </div>
                        <p class="progress-to">{{$competence->pourcentage}}%</p>
                      </div>
                      <br>

                    </div>


                    @endforeach

                </div>
              </div>
              <div class="professonal-skill dashboard-section details-section">
                <h4><i data-feather="feather"></i>Langues</h4>
                <div class="progress-group">

                    @foreach($lang as $competence)






                            <div class="progress-item">


                              <div class="progress-head">
                                <p class="progress-on"><b>Langue:</b> {{ $competence->langue }} <br> <b>Niveau:</b> {{ $competence->niveau  }}</p>
                              </div>
                              <br>

                            </div>


                            @endforeach


                </div>
              </div>






              <div class="experience dashboard-section details-section">
                <h4><i data-feather="briefcase"></i>Experience</h4>



                @foreach ($Exp as $experience)

                <div class="experience-section">
                  <span class="service-year">{{ $experience->titre_job  }}</span><br>
                  <h5>Date de prise de service: {{ $experience->date_debut   }} Date de fin: {{$experience->date_fin  }}</h5>
                  <h5>Structure:<span>{{ $experience->entreprise }}</span></h5><br>
                  <h5>Missions/Taches:</h5>
                 <p>{{ $experience->mission }}</p>


                </div>
                @endforeach









              </div>
















            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


@endsection


@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('user/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection




















