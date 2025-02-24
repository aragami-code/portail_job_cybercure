@extends('site.home.fr.master2L')
@section('name')



<div class="alice-bg padding-top-60 section-padding-bottom">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="job-listing-details">
            <div class="job-title-and-info">
              <div class="title">
                <div class="thumb">
                  <img src="{{asset('site/img/logo2.png')}}" class="img-fluid" alt="">
                </div>
                <div class="title-body">
                  <h4>Titre de l'offre:{{$PostEmplois->titre_post_emploi}}
                  </h4>
                  @include('chercheur.layouts.partials.messages')

                  <div class="info">
                    <span class="company"><a href="#"><i data-feather="briefcase"></i>{{$PostEmplois->nom_region}}
                    </a></span>
                    <span class="office-location"><a href="#"><i data-feather="map-pin"></i>{{$PostEmplois->nom_ville}}</a></span>
                    <span class="job-type full-time"><a href="#"><i data-feather="clock"></i>{{$PostEmplois->type_empl}}
                    </a></span>
                    </div>
                </div>
              </div>
              <div class="buttons">

                 <a class="apply" href="#" data-toggle="modal" data-target="#apply-popup-id">Postuler</a>
              </div>
            </div>
            <div class="details-information section-padding-60">
              <div class="row">
                <div class="col-xl-7 col-lg-8">
                  <div class="description details-section">
                    <h4><i data-feather="align-left"></i>Description de l'offre</h4>
                   <p>{!!$PostEmplois->description_post_emploi!!}</p>
                  </div>


                  <div class="description details-section">
                    <h4><i data-feather="align-left"></i>Mot clé</h4>
                   <p></p>
                    @php

                        $Mat =  $PostEmplois->slug_post_emploi;

                        $pars = explode(";", $Mat);


                          if($pars == true){

                              foreach ($pars as $part) {
                             echo'<span class="btn btn-primary">';

                             echo trim($part)." ";

                             echo'</span>';

                             echo" ";


                         }



                     }

                    @endphp
                  </div>
              {{--    @foreach ($arrayOrCollection as $value )

                {{$loop->first ? " " : " , "}}
                <span class="nice">{{$value->slug_post_emploi}} </span>

                @endforeach
               implode(',',$PostEmplois->slug_post_emploi)--}}

                  <div class="responsibilities details-section">
                    <h4><i data-feather="zap"></i>Responsabilités/Taches/Missions</h4>
                    <p>

                        {!!$PostEmplois->tache_post_emploi!!}

                    </p>
                  </div>
                  <div class="edication-and-experience details-section">
                    <h4><i data-feather="book"></i>Education + Experience/profil recherché</h4>
                    <p>
                        <p> {!!$PostEmplois->profil_post_emploi!!}</p>
                    </p>
                  </div>


                  <div class="container clearfix">





                </div>

                </div>
                <div class="col-xl-4 offset-xl-1 col-lg-4">
                  <div class="information-and-share">
                    <div class="job-summary">
                      <h4>Sommaire</h4>
                      <ul>
                        <li><span>Publié le :</span>{{$PostEmplois->created_at}}</li>
                        <li><span>Status du Travail:</span> Full-time</li>
                        <li><span>Experience:</span>{{$PostEmplois->ex_prof_post_emploi}}</li>
                        <li><span>Région:</span> {{$PostEmplois->nom_ville}}</li>
                        <li><span>Salaire brut annuel compris entre:</span> {{$PostEmplois->salaire_min_post_emploi}}K €  - {{$PostEmplois->salaire_max_post_emploi}}K €
                        </li>
                        <li><span>Genre:</span>H/F</li>
                        <li style="color: red"><span>Date limite:</span> {{$PostEmplois->DL}}</li>
                      </ul>
                    </div>
                    <div class="share-job-post">
                      <span class="share"><i class="fas fa-share-alt"></i>Partager:</span>
                      <a href="https://facebook.com/sharer/sharer.php?u={{route('carriereinfo',Crypt::encrypt($PostEmplois->id))}}"><i class="fab fa-facebook-f"></i></a>
                      <a href="https://www.linkedin.com/sharing/share-offsite/?url={{route('carriereinfo',Crypt::encrypt($PostEmplois->id))}}"><i class="fab fa-linkedin-in"></i></a>
                      <!--<a href="#"><i class="fab fa-twitter"></i></a>
                      <a href="#"><i class="fab fa-linkedin-in"></i></a>
                      <a href="#"><i class="fab fa-google-plus-g"></i></a>
                      <a href="#"><i class="fab fa-pinterest-p"></i></a>
                      <a  class="add-more"><span class="ti-plus"></span></a>-->
                    </div>

                    <!--<div class="job-location">
                      <h4>Job Location</h4>
                      <div id="map-area">
                        <div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>
                         --<div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>--
                      </div>
                    </div>-->
                  </div>
                </div>











              </div><div class="job-apply-buttons">
                    <center><a href="#" class="apply"  data-toggle="modal" data-target="#apply-popup-id">Postuler</a></center>
                    <!-- <a href="#" class="email"><i data-feather="mail"></i>Email Job</a>-->
                   </div>
            </div>

          </div>
        </div>







      </div>


<center> <h2>Offres similaires</h2></center>
<div class="section-header section-header-2 section-header-with-right-content">
    <h2>Emplois récents</h2>
    <a href="{{route('rech')}}" class="header-right button"><p style="color: white;">+ Afficher plus</p></a>
</div>
@foreach ($art as $articles )


<div class="job-list half-grid">
    <div class="thumb">
      <a href="#">
       <img src="{{asset('backend/images/blog/1603139919.jpeg')}}" class="img-fluid" alt="Image">

      </a>
    </div>
    <div class="body">
      <div class="content">
        <h4><a href="job-details.html">{{$articles->titre_post_emploi}}</a></h4>
        <div class="info">


          <span class="office-location"><a href="#"><i data-feather="map-pin"></i>{{$articles->nom_ville}}</a></span>
          <span class="job-type temporary"><a href="#"><i data-feather="clock"></i>{{$articles->type_empl}} </a></span>

        </div>
        <?php
        $diff = Carbon\Carbon::setLocale('fr');
        $diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
        ?>

    </div>
    <div class="entry-content">

    </div>
      </div>
      <div class="more">
        <div class="buttons">
          <a href="{{route('carriereinfo',Crypt::encrypt($articles->id))}}"class="button">consulter</a>
          </div>
        <p class="deadline">{{$diff}}</p>
      </div>
    </div>
    @endforeach
    <center>{{$art->links()}}</center>
  </div>
    </div>
  </div>




























  <div class="apply-popup">
    <div class="modal fade" id="apply-popup-id" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i data-feather="edit"></i>Postuler</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

                <div class="form-row">


                    <div class="form-group col-md-6 col-sm-12">



                    </div>




                </div>

                <div class="form-row">


                    <div class="form-group col-md-12 col-sm-12">
                  <p> Veuillez S'il vous plait vous connecter pour postuler à cette offre</p>
                    </div>
                    <form id="login-form" name="login-form" class="mb-0" method="POST" action="{{ route('chercheur.login.submit') }}">

                        @csrf
                          <h3 class="text-center">CONNEXION</h3>

                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="login-form-username">LOGIN:</label>

                                <input type="text" id="login-form-username" name="email"  class="form-control not-dark" />
                            </div>

                            <div class="col-12 form-group">
                                <label for="login-form-password">PASSWORD:</label>
                                <input type="password" id="login-form-password" name="password"  class="form-control not-dark" />
                            </div>
                            <div class="col-12 form-group">
                                <button class="button button-3d button-primary m-0" id="login-form-submit" name="login-form-submit" value="login">Connecter</button><br>
                                <a href="{{Route('chercheur.register')}}"class="float-right">Pas de compte? Inscrivez-vous-ici</a><br>
                                <a href="{{ route('chercheur.password.request')}}" class="float-right">Mot de passe oublié?</a>
                            </div>
                        </div>
                    </form>

                </div>

          </div>
        </div>
      </div>
    </div>
  </div>





@endsection

