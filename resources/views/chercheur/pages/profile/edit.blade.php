@extends('chercheur.layouts.masterL')


@section('title')
Actualiser mes informations | tableau de bords
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
                <div>
                    <form action="{{route('chercheur.profile.upinfocv',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" method="POST" enctype="multipart/form-data">

                        @csrf


                                    <input type="hidden" class="form-control" id="resume_cv2" name="resume_cv2" value="{{Auth::guard('chercheur')->user()->resume_cv}}">
                                    <input type="file"  id="resume_cv" name="resume_cv" value="{{Auth::guard('chercheur')->user()->resume_cv}}">

                                     <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour mon cv</button></center>

                    </form>


                </div>

                <a href="{{asset("user/images/Cv")}}/{{Auth::guard('chercheur')->user()->resume_cv}}" target="_blank" class="update-file">voir Mon CV</a>

              </div>

            <div class="about-details details-section dashboard-section">
                <h4><i data-feather="align-left"></i>A Propos de moi</h4>
                <p>  {{Auth::guard('chercheur')->user()->description}}</p>


            </div>





            <div class="personal-information dashboard-section last-child details-section">
                <h4><i data-feather="user-plus"></i>Details personnels</h4>
                <ul>
                    <li><span>Nom Complet:</span> {{Auth::guard('chercheur')->user()->nom_famille}} {{Auth::guard('chercheur')->user()->prenom}}</li>
                    <li><span>Date de naissance:</span> {{Auth::guard('chercheur')->user()->date_naiss}}</li>
                    <li><span>Telephone:</span> {{Auth::guard('chercheur')->user()->telephone}} </li>

                </ul>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary edit-resume" data-toggle="modal" data-target="#modal">
                    <i data-feather="edit-2"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-body">
                            <div class="title">
                                <h4><i data-feather="user-plus"></i>Informations personnelles</h4>
                            </div>
                            <div class="content">


                <form method="POST" action="{{route('chercheur.profile.upinfo',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}"  enctype="multipart/form-data" >
                    @csrf

                   <div class="form-row">
                       <input type="hidden" class="form-control" id="name" name="username"  placeholder="Enter le nom d'un utilisateur" readonly value="{{Auth::guard('chercheur')->user()->username}}">
                       <input type="hidden" class="form-control" id="email" name="email"  placeholder="Enter un email" readonly value="{{Auth::guard('chercheur')->user()->email}}">
                       <input type="hidden" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe" readonly value="{{Auth::guard('chercheur')->user()->password}}">

                       <div class="form-group col-md-4 col-sm-12">
                           <label for="slug"><b>Prenom</b></label>
                           <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="prenom" required="on" value="{{Auth::guard('chercheur')->user()->prenom}}">
                       </div>

                       <div class="form-group col-md-4 col-sm-12">
                           <label for="name"><b>Nom de Famille</b></label>
                           <input type="text" class="form-control" id="nom_famille" name="nom_famille"  placeholder="votre Nom" required="on" value="{{Auth::guard('chercheur')->user()->nom_famille}}">
                       </div>

                       <div class="form-group col-md-4 col-sm-6">
                           <label for="name"><b>Sexe</b></label>
                           <select name="genre" id="genre" class="form-control" value="{{Auth::guard('chercheur')->user()->genre}}">
                               <option value ="masculin">Masculin</option>
                               <option value ="feminin">Feminin</option>
                           </select>
                       </div>



                   </div>

                   <div class="form-row">
                       <div class="form-group col-md-3 col-sm-12">
                           <label for="date_naiss"><b>Date de naissance</b></label>
                           <input type="date" class="form-control" id="date_naiss" name="date_naiss"  placeholder="date de naissance" required="on" value="{{Auth::guard('chercheur')->user()->date_naiss}}">
                       </div>


                       <div class="form-group col-md-3 col-sm-12">
                           <label for="telephone"><b>Numero de telephone</b></label>
                           <input type="text" class="form-control" id="telephone" name="telephone"  placeholder="veuillez entrer votre numero de telephone suivi de l'indicatif de votre pays ex: +33" required="on" value="{{Auth::guard('chercheur')->user()->telephone}}">
                       </div>

                       <div class="form-group col-md-3 col-sm-12">
                               <label for="name"><b>Diplôme</b></label>
                               <select name="niveau_ecole" id="niveau_ecole" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                   @foreach ($diplome as $dip)
                                       <option value="{{$dip->id}}">{{$dip->formation_empl}}</option>
                                   @endforeach
                               </select>
                       </div>
                       <div class="form-group col-md-3 col-sm-12">
                           <label for="name"><b>Profession</b></label>
                           <input type="text" class="form-control" id="metier" name="metier"  placeholder="veuillez entrer votre profession" required="on" value="{{Auth::guard('chercheur')->user()->metier}}">
                       </div>
                   </div>
                   <div class="form-row">

                       <div class="form-group col-md-3 col-sm-12">
                           <label for="name"><b>Emploi sollicité</b></label>
                           <select name="type_emploi_sollicite" id="type_emploi_sollicite" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                   @foreach ($typem as $dip)
                                       <option value="{{$dip->id}}">{{$dip->type_empl}}</option>
                                   @endforeach
                           </select>
                       </div>
                       <div class="form-group col-md-3 col-sm-12">
                           <label for="name"><b>Contrat Recherché</b></label>
                               <select name="type_contrat_sollicite" id="type_contrat_sollicite" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                   @foreach ($typecontr as $dip)
                                       <option value="{{$dip->id}}">{{$dip->contrat_empl}}</option>
                                   @endforeach
                               </select>
                       </div>

                       <div class="form-group col-md-3 col-sm-6">
                           <label for="name"><b>Experiences</b></label>
                           <select name="experience" id="experience" class="form-control" value="{{Auth::guard('chercheur')->user()->experience}}">
                               <option value="{{Auth::guard('chercheur')->user()->experience}}">{{Auth::guard('chercheur')->user()->experience}}</option>
                               <option value ="1 an">1 an</option>
                               <option value ="2 ans">2 ans</option>
                               <option value ="3 ans">3 ans</option>
                               <option value ="4 ans">4 ans</option>
                               <option value ="5 ans">5 ans</option>
                               <option value ="6 ans">6 ans</option>
                               <option value ="7 ans">7 ans</option>
                               <option value ="8 ans">8 ans</option>
                               <option value ="9 ans">9 ans</option>
                               <option value ="plus de 10 ans">10 ans</option>
                           </select>
                       </div>


                       <div class="form-group col-md-3 col-sm-6">
                           <label for="name"><b>Rayon sollicité</b></label>
                           <select name="distance_minimum" id="distance_minimum" class="form-control" value="{{Auth::guard('chercheur')->user()->distance_minimum}}">
                               <option value="{{Auth::guard('chercheur')->user()->distance_minimum}}">{{Auth::guard('chercheur')->user()->distance_minimum}}</option>
                               <option value ="Peu importe">Peu importe</option>
                                   <option value ="0 km">0 km</option>
                                   <option value ="5 km">5 km</option>
                                   <option value ="10 km">10 km</option>
                                   <option value ="15 km">15 km</option>
                                   <option value ="20 km">20 km</option>
                                   <option value ="25 km">25 km</option>
                                   <option value ="30 km">30 km</option>
                                   <option value ="35 km">35 km</option>
                                   <option value ="40 km">40 km</option>
                                   <option value ="45 km">45 km</option>
                                   <option value ="50 km">50 km</option>
                                   <option value ="+ de 50 km">+ de 50 km</option>

                           </select>

                       </div>
                   </div>




                   <div class="form-row">











                       <div class="form-group col-md-3 col-sm-12">
                           <label for="name"><b>Votre région</b></label>
                           <input type="hidden" name="region2" value="{{Auth::guard('chercheur')->user()->region}}">
                           <select name="region" id="region" class="form-control" required='on'>
                               <option value="0"> selectionner votre region</option>
                               @foreach ($Region as $region)

                           <option value ="{{$region->id}}">{{$region->nom_region}}</option>

                               @endforeach
                           </select>

                       </div>



                       <div class="form-group col-md-3 col-sm-12">
                           <label for="name"><b> département</b></label>
                           <input type="hidden" name="ville2" value="{{Auth::guard('chercheur')->user()->ville}}">
                           <select name="ville" id="ville" class="form-control" required='on'>
                               <option value="0"> selectionner votre departement</option>

                           </select>

                       </div>

                       <div class="form-group col-md-6 col-sm-12">
                           <label for="slug"><b>Addresse</b></label>

                           <input type="text" class="form-control"  id=adresse name="adresse" class="form-group col-md-12 col-sm-12"  placeholder="veuillez entrer votre addresse" required="on" value="{{Auth::guard('chercheur')->user()->adresse}}">

                       </div>




                       <div class="form-group col-md-12 col-sm-12">
                           <label for="slug"><b>A propos de vous</b></label>

                           <textarea class="form-control" id=descrpition name="description" class="form-group col-md-12 col-sm-12" style="width: 100%; height: 200px; font-size: 14px;  border: 1px solid #dddddd;">
                               {{Auth::guard('chercheur')->user()->description}}
                           </textarea>
                       </div>

                       <center> <input type="submit" class="btn btn-primary mt-4 pr-4 pl-4" name="Mettre à jour mes informations"></center>
                   </div>
               </form>







                            </div>
                        </div>
                        </div>
                    </div>
                </div>







            </div>
            </div>
            <div class="dashboard-sidebar">

              <div class="profile-progress">

              </div>
              <div class="dashboard-menu">
                <ul>
                    <li class="active"><i data-feather="user"></i><a aria-selected="true">Generale</a>
                    </li>
                    <li><i data-feather="book"></i> <a href="{{route('chercheur.niveau.index')}}">Formations</a>
                    </li>

                    <li><i data-feather="feather"></i> <a href="{{route('chercheur.sommaire.index')}}">Competences</a>
                    </li>
                    <li><i data-feather="plus-square"></i>  <a href="{{route('chercheur.langue.index')}}">Langues parlées</a>
                    </li>
                    <li><i data-feather="briefcase"></i> <a href="{{route('chercheur.experience.index')}}">Experiences</a>
                    </li>
                    <li><i data-feather="edit"></i>  <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}">Profil</a>
                    </li>
                    </ul>

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


<script type="text/javascript">


    jQuery('select[name="region"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: "{{ url('findRegion')}}"+'/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="ville"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="ville"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="ville"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="ville"]').empty();

        }





    });









</script>





@endsection


