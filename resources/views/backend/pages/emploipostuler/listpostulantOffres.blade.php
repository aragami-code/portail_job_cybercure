@extends('backend.layouts.master')


@section('title')
liste des Offres | Tableau de Bord
@endsection





@section('styles')
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
--}}
<link rel="stylesheet" href="{{asset('backend/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/responsive.jqueryui.min.css')}}">
@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Tableau de Bord</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Toute les Offres</span></li>
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





            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personnes ayant postulé</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Liste des retenus</a>
                            </div>
                        </nav>
                        <div class="tab-content mt-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


                <div class="card-body">
                    <h4 class="header-title">Personnes ayant postulées </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('Emploi_Postuler.view'))

                    @endif

                    <div class="clearfix"></div>
                    <br>

                              <div class="data-tables">
                                <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th width="2%">SI</th>
                                            <th width="5%">photo</th>
                                            <th width="30%">Nom du postulant</th>
                                            <th width="5%">date postulée</th>
                                            <th width="10%">statut</th>

                                            <th width="40%">Action</th> 

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($Emplois_Postuler as $Emploi_Postuler)

                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td><img class="avatar user-thumb" src="{{asset('user/images/Chercheur')}}/{{$Emploi_Postuler->photo}}" alt="avatar" style="border-radius: 50%; width: 50px; height: 50px;"></td>
                                            <td>{{$Emploi_Postuler->nom_famille}} {{$Emploi_Postuler->prenom}}</td>
                                            <td>{{$Emploi_Postuler->created_at}}</td>
                                            <td>
                                                @if($Emploi_Postuler->is_selected == 0)
                                                <span class="badge badge-pill badge-danger" style="width: 25px; height: 25px;"><b><i class="ti-close"></i></b></span>


                                            @else
                                            <span class="badge badge-pill badge-success"><i class="ti-close"></i>  Selectionner</span>

                                            @endif

                                            </td>

                                            <td>

                                                <div class="form-row">



                                                        @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))
                                                        <br>
                                                        <a href="{{asset("user/images/Cv")}}/{{$Emploi_Postuler->resume_cv}}"><button class="btn btn-primary mt-3 pr-3 pl-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="ti-eye"></i>Consulter profil</button></a>

                                                        

                                                        @endif



                                                        @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))



                                                                @if($Emploi_Postuler->is_selected == 0)

                                                            <form action="{{route('admin.emploispostuler.update', $Emploi_Postuler->user_id)}}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary mt-3 pr-3 pl-3">Selectionner</button>
                                                            </form>

                                                            @else
                                                        <br>
                                                            <form action="{{route('admin.emploispostuler.up1', $Emploi_Postuler->user_id)}}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger mt-3 pr-3 pl-3">Decocher</button>
                                                            </form>

                                                            @endif











                                                        @endif








                                                </div>


                                            </td>
                                        </tr>

                                        @endforeach



                                    </tbody>
                                </table>
                            </div>



                </div>


                            </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


                <div class="card-body">
                  <center> <h4 class="header-title">Personnes retenues</h4></center>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('Emploi_Postuler.view'))

                    @endif

                    <div class="clearfix"></div>
                    <br>

                              <div class="data-tables">
                                <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th width="2%">SI</th>
                                            <th width="5%">photo</th>
                                            <th width="30%">Nom du postulant</th>

                                            <th width="30%">Statut</th>
                                             <th width="40%">Opération</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($Emplois_Postule as $Emploi_Postuler)

                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td><img class="avatar user-thumb" src="{{asset('user/images/Chercheur')}}/{{$Emploi_Postuler->photo}}" alt="avatar" style="border-radius: 50%; width: 50px; height: 50px;"></td>
                                            <td>{{$Emploi_Postuler->nom_famille}} {{$Emploi_Postuler->prenom}}</td>
                                            <td>
                                                @if($Emploi_Postuler->is_selected == 0)
                                                <span class="badge badge-pill badge-danger" style="width: 25px; height: 25px;"><b><i class="ti-close"></i></b></span>


                                            @else
                                            <span class="badge badge-pill badge-success"><i class="ti-close"></i>  Selectionner</span>

                                            @endif

                                            </td>

                                            <td>

                                                <div class="form-row">


                                                    <div class="btn-group mb-xl-3" role="group" aria-label="Basic example">

                                                        @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))
                                                        
                                                        <a href="{{asset("user/images/Cv")}}/{{$Emploi_Postuler->resume_cv}}"><button type="button"  class="btn btn-primary"><i class="ti-eye"></i>Consulter profil</button></a>

                                                        @endif


                                                        @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))

                                                        <a href="tel:{{$Emploi_Postuler->telephone}}"><button type="button"  class="btn btn-primary"> <i class="fa fa-phone"></i>Appeler</button></a>

                                                        @endif

                                                            @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))

                                                            <a href="mailto:{{$Emploi_Postuler->email}}?subject =entretien&body = votre candidature a été retenu pour passer un emploi"><button type="button"  class="btn btn-primary"><i class="ti-email"></i>Envoyer un email</button></a>


                                                            @endif








                                                        @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))



                                                        @if($Emploi_Postuler->is_interviewed == 0)

                                                        <form action="{{route('admin.emploispostuler.upsel', $Emploi_Postuler->user_id)}}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Entretien non effectué</button>
                                                        </form>



                                                    @else
                                                    <form action="{{route('admin.emploispostuler.upsel1', $Emploi_Postuler->user_id)}}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn btn-success">Entretien  effectué</button>
                                                    </form>



                                                    @endif











                                                @endif









                                                    </div>


                                                </div>


                                            </td>
                                        </tr>

                                        @endforeach



                                    </tbody>
                                </table>
                            </div>

                    







                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')

{{--
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>--}}
<script src="{{asset('backend/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/js/dataTable.responsive.min.js')}}"></script>
<script src="{{asset('backend/js/responsive.bootstrap.min.js')}}"></script>
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
