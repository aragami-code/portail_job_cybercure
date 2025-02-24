@extends('chercheur.layouts.master')


@section('title')
Liste des Offres d'emploi | Tableau de Bord
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
                    <li><span>Toute les Offres d'emplois</span></li>
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

        <!-- data table end -->

        <!-- Dark table end -->




        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Liste des  offres</h4>
                    <div class="clearfix"></div>
                    <br>

                              @foreach ($Emplois_Postuler as $Emploi_Postuler)


                                <div class="col-lg-12 col-md-6"{{$loop->index+1}}>

                                        <img class="card-img-top img-fluid" src="{{asset('backend/images/job/1603139919.jpeg')}}" alt="image" style="border-radius: 50%; width: 50px; height: 50px;">

                                        <h5 class="title"><i class="ti-briefcase"></i><b>Titre de l'offre:{{$Emploi_Postuler->titre_post_emploi}}</b></h5>
                                        <br>
                                        <p><i class="ti-new-window"></i>Ti:{{$Emploi_Postuler->type_empl}} <i class="ti-pencil-alt"></i>{{$Emploi_Postuler->contrat_empl}}<i class="ti-pencil-alt"></i>{{--$diff = Carbon\Carbon::parse($Emploi_Postuler->created_at)->diffForHumans()--}}
                                        </p>
                                        <p class="card-text">

                                        </p>

                                           <p class="card-text">
                                        </p>



                                  {{-- --}}      <a href="{{route('chercheur.postemplois.edit',Crypt::encrypt($Emploi_Postuler->id))}}" class="btn btn-primary"><i class="ti-eye"></i> Consulter</a>

                                </div>

                                @endforeach
                            {{--$Emplois_Postuler->links()--}}





                </div>
            </div>
        </div>

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
@endsection
