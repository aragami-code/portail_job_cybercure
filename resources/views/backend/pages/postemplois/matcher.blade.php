@extends('backend.layouts.master')


@section('title')
Rechercher un profil| tableau de bords
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
                <h4 class="page-title pull-left">Rechercher</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Rechercher profil</span></li>
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
                    <h4 class="header-title">Rechercher des profils</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.postemplois.resultatRecherche')}}" method="GET" enctype="multipart/form-data">
                    {{----}}@csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-6">
                            <label for="name">Nom metier</label>
                        <input type="text" class="form-control"  name="metier">

                        </div>



                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Type de travail</label>
                           <select name="type_emploi_sollicite" id="type_emploi_sollicite" class="form-control select2">
                            
                                
                                @foreach ($typemp as $typem)

                            <option value ="{{$typem->type_empl}}">{{$typem->type_empl}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Contrat proposé</label>
                            <select name="type_contrat_sollicite" id="type_contrat_sollicite" class="form-control select2">
                            
                                @foreach ($contratemp as $contratemp)

                            <option value ="{{$contratemp->contrat_empl}}">{{$contratemp->contrat_empl}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Diplôme</label>
                          <select name="niveau_ecole" id="niveau_ecole" class="form-control select2">
                          
                                @foreach ($formationemp as $formationemp)

                            <option value ="{{$formationemp->formation_empl}}">{{$formationemp->formation_empl}}</option>

                                @endforeach
                            </select>

                        </div>

                       



                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-12">
                            <label for="age">AGE</label>
                            <input type="number" class="form-control" name="age">
                        </div>



                        
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Rayon de recherche</label>
                            <select name="distance_minimum" id="distance_minimum" class="form-control select2">
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




                        <div class="form-group col-md-3 col-sm-6">
                            <label for="name">Experience Professionnelle</label>
                            <select name="experience" id="experience" class="form-control select2">
                           <option value ="Aucune experience"> Aucune experience requise</option>
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

                       
                        


                       


                        <div class="form-group col-md-4 col-sm-12">
                            <label for="name">Région</label>
                            <select name="region"  class="form-control" required='on'>
                                <option value ="0">choisir une region</option>

                                @foreach ($Region as $region)

                            <option value ="{{$region->id}}">{{$region->nom_region}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="name">Département</label>
                            <select name="ville"  class="form-control">

                            </select>

                        </div>








                    </div>
                       <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Rechercher</button></center>
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


    jQuery('select[name="region"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegion/'+RegionID,
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
