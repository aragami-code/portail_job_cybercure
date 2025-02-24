@extends('backend.layouts.master')


@section('title')
creer une Offre d'emploi| tableau de bords
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
                <h4 class="page-title pull-left">Article</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.postemplois.index')}}">Toutes les Offres</a></li>
                    <li><span>Creer une Offre</span></li>
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
                            <label for="name">Nom de l' offre ou titre de l'offre</label>
                            <input type="text" class="form-control" id="titre_post_emploi" name="titre_post_emploi"  placeholder="Enter le titre de l'offre" required="on">

                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">mot cle</label>
                            <input type="text" class="form-control" id="slug_post_emploi" name="slug_post_emploi"  placeholder="le mot cle" required="on">

                        </div>
                            <input type="hidden" class="form-control" id="id_admin" name="id_admin"  readonly value="{{Auth::guard('admin')->user()->id}}">
                            <input type="hidden" class="form-control"  readonly value="{{Auth::guard('admin')->user()->name}}">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">secteur d'activité</label>
                            <select name="sectas_post_emploi" id="sectas_post_emploi" class="form-control" required='on'>
                                @foreach ($sectas as $sectas)

                            <option value ="{{$sectas->id}}">{{$sectas->nom_secteur}}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">type d'emploi</label>
                            <select name="typemp_post_emploi" id="typemp_post_emploi" class="form-control" required='on'>
                                @foreach ($typemp as $typemp)

                            <option value ="{{$typemp->id}}">{{$typemp->type_empl}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">type de contrat proposé</label>
                            <select name="contrat_post_emploi" id="contrat_post_emploi" class="form-control" required='on'>
                                @foreach ($contratemp as $contratemp)

                            <option value ="{{$contratemp->id}}">{{$contratemp->contrat_empl}}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">description</label>

                            <textarea class="form-control" id="description_post_emploi" name="description_post_emploi" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                            </textarea>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-12">
                            <label for="name">periode de renumeration</label>
                            <select name="mode_de_paie_post_emploi" id="mode_de_paie_post_emploi" class="form-control" required='on'>

                            <option value ="Horaire">Horaire</option>
                            <option value ="Hebdomadaire">Hebdomadaire</option>
                            <option value ="Mensuelle">Mensuelle</option>
                            </select>

                        </div>


                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">salaire minimum</label>
                            <input type="number" class="form-control" id="salaire_min_post_emploi" name="salaire_min_post_emploi" required="on">

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">salaire maximun</label>
                            <input type="number" class="form-control" id="salaire_max_post_emploi" name="salaire_max_post_emploi" required="on">

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">formation</label>
                            <select name="id_formation_post_emploi" id="id_formation_post_emploi" class="form-control" required='on'>
                                @foreach ($formationemp as $formationemp)

                            <option value ="{{$formationemp->id}}">{{$formationemp->formation_empl}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Experience Professionnelle</label>
                            <select name="ex_prof_post_emploi" id="ex_prof_post_emploi" class="form-control">

                            <option value ="minimum"> minimun</option>
                            <option value ="1"> 1</option>
                            <option value ="2"> 2</option>
                            <option value ="3"> 3</option>
                            <option value ="4"> 4</option>
                            <option value ="5"> 5</option>
                            <option value ="6"> 6</option>
                            <option value ="7"> 7</option>
                            <option value ="8"> 8</option>
                            <option value ="9"> 9</option>
                            <option value ="10"> 10</option>
                            <option value ="11"> 11</option>


                            </select>

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">genre</label>
                            <select name="sex_post_emploi" id="sex_post_emploi" class="form-control">

                            <option value ="Homme ou Femme">Homme ou Femme</option>
                            <option value ="Homme"> Homme</option>
                            <option value ="Femme"> Femme</option>



                            </select>

                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nombre de Place</label>
                            <select name="nombre_place_post_emploi" id="nombre_place_post_emploi" class="form-control">

                            <option value ="1"> 1</option>
                            <option value ="2"> 2</option>
                            <option value ="3"> 3</option>
                            <option value ="4"> 4</option>
                            <option value ="5"> 5</option>
                            <option value ="6"> 6</option>
                            <option value ="7"> 7</option>
                            <option value ="8"> 8</option>
                            <option value ="9"> 9</option>
                            <option value ="10"> 10</option>
                            <option value ="11"> 11</option>


                            </select>

                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">taches (mission)</label>

                            <textarea class="form-control" id="tache_post_emploi" name="tache_post_emploi" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                            </textarea>
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="name">Etats</label>
                            <select name="id_etat_post_emploi" id="id_etat_post_emploi" class="form-control" required='on'>
                                <option value ="0">choisir un etat</option>

                                @foreach ($Etat as $etat)

                            <option value ="{{$etat->id}}">{{$etat->nom_etat}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="name">Region ou Province</label>
                            <select name="id_region_post_emploi" id="id_region_post_emploi" class="form-control id_region_post_emploi" required='on'>

                            </select>

                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="name">Villes</label>
                            <select name="id_ville_post_emploi" id="id_ville_post_emploi" class="form-control id_ville_post_emploi" required='on'>

                            </select>

                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="slug">addresse</label>

                            <textarea class="form-control" id="adresse_post_emploi" name="adresse_post_emploi" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                            </textarea>
                        </div>

                    </div>
                       <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">enregistrer</button></center>
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
<script type="text/javascript">


    jQuery('select[name="id_etat_post_emploi"]').on('change',function(){

        var countryID = jQuery(this).val();
        var villeID = jQuery(this).val();
        if(countryID){
            jQuery.ajax({
                url: 'findEtat/'+countryID,
                type: "GET",
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="id_region_post_emploi"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="id_region_post_emploi"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="id_region_post_emploi"]').empty();

            $('select[name="id_ville_post_emploi"]').empty();
                }


                }
            });
        }
        else{

            $('select[name="id_region_post_emploi"]').empty();
            $('select[name="id_ville_post_emploi"]').empty();

        }

    });


    jQuery('select[name="id_region_post_emploi"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegion/'+RegionID,
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
