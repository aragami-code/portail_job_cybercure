@extends('backend.layouts.master')


@section('title')
Voir CV| tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">CV</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.emploispostuler.index')}}">personnes ayant postulé</a></li>
                     <li><span>Voir Cv {{--$PostEmplois->titre_post_emploi--}}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('backend.layouts.partials.logout')


        </div>
    </div>
</div>
<!-- page title area end -->


<div class="main-content-inner">
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4 clearfix">

                <center> <a href="{{route('admin.emploispostuler.index')}}" class="btn btn-primary"> <i class="ti-share-alt"></i> Retour à la page precedente</a>
                </center>

            </div>
            <div class="col-sm-4 clearfix">


            </div>
        </div>
    </div>
    <div class="row">
        <!-- data table start -->

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Information</h4>

                    @include('backend.layouts.partials.messages')
                    <div class="form-row">

                        <div class="form-row col-md-4 col-sm-4">

                            <h4>Information Generale {{$user->resume_cv}}</h4>
                            <br>

                            <div>
                                <img src="{{asset("user/images/Chercheur/$user->photo")}}" width="30%">
                                <a href="{{asset("user/images/Cv")}}/{{$user->resume_cv}}" target="_blank"><img src="" width="10%">Voir Cv</a>

                            </div>


                            <br>


                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name"><b> Nom de l'utilisateur:</b></label>{{$user->name}}
                                <br>
                                <label for="email"><b> Email:</b></label> {{$user->email}}
                                <br>
                                <label for="name"><b>Nom de Famille:</b></label>{{$user->nom_famille}}
                                <br>
                                <label for="slug"><b>Prenom:</b></label>{{$user->prenom}}
                                <br>
                                <label for="date_naiss"><b>Date de naissance:</b></label> {{$user->date_naiss}}
                                <br>
                                <label for="telephone"><b>Mobile :</b></label>{{$user->telephone}}
                                <br>
                                <label for="name"><b>Diplome :</b></label>{{$user->niveau_ecole}}
                                <br>
                                 <label for="name"><b>Profession:</b></label> {{$user->metier}}
                                <br>
                                <label for="name"><b>genre :</b></label> {{$user->genre}}
                                <br>
                                <label for="name"><b>Statut :</b></label>{{$user->statut_marital}}
                               <br>
                                <label for="name"><b>Experiences:</b></label>{{$user->experience}}
                                <br>

                                 <label for="name"><b>Region d'origine :</b></label> {{--$user->nom_region--}}
                                <br>
                                <label for="name"><b>Departement :</b></label> {{--$user->nom_ville--}}
                                <br>
                                <label for="name"><b>Code Postale:</b></label>{{$user->post_code}}
                                <br>
                                <label for="name"><b>addresse :</b></label>{{$user->adresse}}
                                <br>
                                <label for="slug">a propos de moi</label>

                                <textarea class="form-control" id=descrpition name="description" class="form-group col-md-6 col-sm-12" style="width: 50%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{$user->description}}
                                </textarea>
                            </div>





                        </div>
                        <div class="form-row col-md-4 col-sm-4">
                            <h4>Diplome/Certifications</h4>
                            @foreach ($diplome as $diplom)
                            <div class="form-group col-md-12 col-sm-12">

                                     <label for="name"><b>Diplome Obtenu:</b></label>{{$diplom->titre_niveau}}
                                    <br>
                                    <label for="email"><b>Specialité:</b></label> {{$diplom->option}}
                                    <br>
                                    <label for="name"><b>Etablissement:</b></label>{{$diplom->institution}}
                                    <br>
                                    <label for="slug"><b>annee d'obtention:</b></label>{{$diplom->annee}}
                            </div>

                            @endforeach
                        </div>
                        <div class="form-row col-md-4 col-sm-4">
                            <h4>Competences</h4>

                            <div class="form-group col-md-12 col-sm-12">

                            @foreach ($Compe as $competences)
                                <div class="form-group col-md-12 col-sm-12">
                                    <br>

                                     <label for="name"><b>maitrise:</b></label>{{$competences->competences_user}}
                                    <br>
                                    <label for="email"><b>niveaux:</b></label> {{$competences->niveau}}
                                    <br>
                                </div>
                            @endforeach


                            </div>

                             <h4>Langues maitrisées</h4>

                            
                            <h4>Experience Professionnel</h4>

                            @foreach ($Exp as $experience)
                                <div class="form-group col-md-12 col-sm-12">

                                     <label for="name"><b>Poste Occupé:</b></label>{{$experience->titre_job}}
                                    <br>
                                    <label for="email"><b>Entreprise:</b></label> {{$experience->entreprise}}
                                    <br>
                                    <label for="name"><b>Date debut:</b></label>{{$experience->date_debut}}
                                    <br>
                                    <label for="slug"><b>Date fin:</b></label>{{$experience->date_fin}}
                                    <br>
                                    <label for="slug"><b>Taches/missions:</b></label><p>{{$experience->mission}}</p>
                                </div>
                            @endforeach



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
        <!-- data table end -->

        <!-- Dark table end -->
</div>




@endsection


@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('backend/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
