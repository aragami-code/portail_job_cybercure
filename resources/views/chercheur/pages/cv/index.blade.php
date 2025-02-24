@extends('chercheur.layouts.master')


@section('title')
liste des Offres | Tableau de Bord
@endsection





@section('styles')
<link rel="stylesheet" href="{{asset('user/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('user/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('user/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('user/css/responsive.jqueryui.min.css')}}">
@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Tableau de Bord</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Toute les Offres</span></li>
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

        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}">  <button class="btn btn-primary mt-4 pr-4 pl-4">mettre a jour mes informations</button></a>

                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')
<script src="{{asset('user/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('user/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('user/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('user/js/dataTable.responsive.min.js')}}"></script>
<script src="{{asset('user/js/responsive.bootstrap.min.js')}}"></script>
<script>
/*================================
datatable active
==================================*/
if ($('#dataTable').length) {
    $('#dataTable').DataTable({
        responsive: true
    });
}

</script>
<script type="text/javascript">


    jQuery('select[name="pays"]').on('change',function(){

        var countryID = jQuery(this).val();
        var villeID = jQuery(this).val();
        if(countryID){
            jQuery.ajax({
                url: 'findEtat/'+countryID,
                type: "GET",
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="region"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="region"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="region"]').empty();
                }


                }
            });
        }
        else{

            $('select[name="region"]').empty();
            $('select[name="ville"]').empty();

        }

    });


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
