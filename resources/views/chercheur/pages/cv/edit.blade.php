@extends('chercheur.layouts.master')


@section('title')
Voir une Offre | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('chercheur/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Offre</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Tableau de Bord</a></li>
                     <li><span>Voir CV </span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('chercheur.layouts.partials.logout')


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
                    <h2 class="header-title">Mon Cv </h2>
                    <br><br>
                    @include('chercheur.layouts.partials.messages')


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
   <script src="{{asset('user/js/select2.min.js')}}"></script>

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
