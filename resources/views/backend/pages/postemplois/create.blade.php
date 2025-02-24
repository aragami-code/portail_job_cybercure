@extends('backend.layouts.master')


@section('title')
Creer une Offre| tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
<style>
section {
    width: 100%;
    margin: auto;
    text-align: left;
  }
</style>

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Offres</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.postemplois.index')}}">Listes Offres</a></li>
                    <li><span>Ajouter une Offre</span></li>
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
    <div class="row">
        <!-- data table start -->

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Ajouter une Offre</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.postemplois.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de l' offre ou titre de l'offre*</label>
                            <input type="text" class="form-control" id="titre_post_emploi" name="titre_post_emploi"  placeholder="Enter le titre de l'offre" required="on">

                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Mot(s) clé(s) (separer les mots avec des virgules ex: JAVA,PHP,C#)</label>
                            <input type="text" class="form-control" id="slug_post_emploi" name="slug_post_emploi"  placeholder="le mot cle" required="on">

                        </div>
                            <input type="hidden" class="form-control" id="id_admin" name="id_admin"  readonly value="{{Auth::guard('admin')->user()->id}}">
                            <input type="hidden" class="form-control"  readonly value="{{Auth::guard('admin')->user()->name}}">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Secteur d'activité*</label>
                            <select name="sectas_post_emploi" id="sectas_post_emploi" class="form-control" required='on'>
                                @foreach ($sectas as $sectas)

                            <option value ="{{$sectas->id}}">{{$sectas->nom_secteur}}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Type de travail*</label>
                            <select name="typemp_post_emploi" id="typemp_post_emploi" class="form-control" required='on'>
                                @foreach ($typemp as $typemp)

                            <option value ="{{$typemp->id}}">{{$typemp->type_empl}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Contrat proposé*</label>
                            <select name="contrat_post_emploi" id="contrat_post_emploi" class="form-control" required='on'>
                                @foreach ($contratemp as $contratemp)

                            <option value ="{{$contratemp->id}}">{{$contratemp->contrat_empl}}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">Description de l'entreprise*</label>


                                <textarea id='edit' style="margin-top: 30px;" placeholder="Type some text" name="description_post_emploi">

                              </textarea>

                        </div>

                    </div>
                    <div class="form-row">



                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Salaire minimum brut annuel en K €*</label>
                            <input type="number" class="form-control" id="salaire_min_post_emploi" name="salaire_min_post_emploi" required="on">

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Salaire maximun brut annuel en K €*</label>
                            <input type="number" class="form-control" id="salaire_max_post_emploi" name="salaire_max_post_emploi" required="on">

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Diplôme*</label>
                            <select name="id_formation_post_emploi" id="id_formation_post_emploi" class="form-control" required='on'>
                                @foreach ($formationemp as $formationemp)

                            <option value ="{{$formationemp->id}}">{{$formationemp->formation_empl}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label for="name">Experience Professionnelle*</label>
                            <select name="ex_prof_post_emploi" id="ex_prof_post_emploi" class="form-control">

                                <option value ="debutant">Débutant</option>
                                <option value ="1 an"> 1 an</option>
                                <option value ="2 ans"> 2 ans</option>
                                <option value ="3 ans"> 3 ans</option>
                                <option value ="4 ans"> 4 ans</option>
                                <option value ="5 ans"> 5 ans</option>
                                <option value ="6 ans"> 6 ans</option>
                                <option value ="7 ans"> 7 ans</option>
                                <option value ="8 ans"> 8 ans</option>
                                <option value ="9 ans"> 9 ans</option>
                                <option value ="10 ans"> 10 ans</option>
                                <option value ="plus de 10 ans"> plus de 10 ans</option>



                            </select>

                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">Missions*</label>


                              <textarea id='edit' style="margin-top: 30px;" placeholder="Type some text" name="tache_post_emploi">

                              </textarea>
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="name">Region*</label>
                            <select name="id_region_post_emploi" id="id_region_post_emploi" class="form-control" required='on'>
                                <option value ="0">Choisir une région</option>

                                @foreach ($Region as $region)

                            <option value ="{{$region->id}}">{{$region->nom_region}}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-4 col-sm-12">
                            <label for="name">Département*</label>
                            <select name="id_ville_post_emploi" id="id_ville_post_emploi" class="form-control" required='on'>

                            </select>

                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="name">Date limite de l'offre*</label>
                            <input type="date" name="DL" id="DL" class="form-control">



                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">Description du profil*</label>


                              <textarea id='edit' style="margin-top: 30px;" placeholder="Type some text"  name="profil_post_emploi">

                            </textarea>
                        </div>

                    </div>
                       <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Enregistrer & Publier</button></center>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
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


<script>
    (function () {
      new FroalaEditor("#edit", {
        theme: 'royal'
      })
    })()
  </script>



<script type="text/javascript">


    jQuery('select[name="id_region_post_emploi"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegions/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="id_ville_post_emploi"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="id_ville_post_emploi"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="id_ville_post_emploi"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="id_ville_post_emploi"]').empty();

        }





    });









</script>


@endsection
