
@extends('chercheur.layouts.masterL')


@section('title')
Voir une Offre | tableau de bords
@endsection


@section('admin-content')
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
                <form action="{{route('chercheur.postemplois.favori')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_job" value="{{$PostEmplis->id}}">
                    <input type="hidden" name="id_user" value="{{Auth::guard('chercheur')->user()->id}}">
                    <button class="save"><i data-feather="heart"></i>Ajouter au Favoris</button>
                </form>
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

                  <div class="job-apply-buttons">
                    <a href="#" class="apply"  data-toggle="modal" data-target="#apply-popup-id">Postuler</a>
                   <!-- <a href="#" class="email"><i data-feather="mail"></i>Email Job</a>-->
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
                    </div><!--
                    <div class="share-job-post">
                      <span class="share"><i class="fas fa-share-alt"></i>Partager:</span>
                      <a href="#"><i class="fab fa-facebook-f"></i></a>
                      <a href="#"><i class="fab fa-twitter"></i></a>
                      <a href="#"><i class="fab fa-linkedin-in"></i></a>
                      <a href="#"><i class="fab fa-google-plus-g"></i></a>
                      <a href="#"><i class="fab fa-pinterest-p"></i></a>
                      <a href="#" class="add-more"><span class="ti-plus"></span></a>
                    </div>-->

                    <!--<div class="job-location">
                      <h4>Job Location</h4>
                      <div id="map-area">
                        <div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>
                         --<div class="cp-map" id="location" data-lat="40.713355" data-lng="-74.005535" data-zoom="10"></div>--
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
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
            <form action="{{route('chercheur.postemplois.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">


                    <div class="form-group col-md-6 col-sm-12">

                        <input type="hidden" class="form-control" id="post_emploi_id" name="post_emploi_id" value="{{$PostEmplis->id}}">

                    </div>


                        <input type="hidden" class="form-control" id="user_id" name="user_id"  readonly value="{{Auth::guard('chercheur')->user()->id}}">

                </div>

                <div class="form-row">


                    <div class="form-group col-md-12 col-sm-12">
                      <center> <label for="slug"> <b>votre message</b> </label></center>

                        <textarea class="form-control" id="lettre" name="lettre" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                        </textarea>
                    </div>

                </div>
                   <center> <button type="submit"  class="button primary-bg btn-block">postuler</button></center>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>





@endsection

