@extends('backend.layouts.master')


@section('title')
liste des secteurs| Tableau de Bord
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
                    <li><span>Secteur d'Activité</span></li>
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
                    <h4 class="header-title">liste des Secteurs d'Activité</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('sectA.create'))
                    <p class="float-right">
                    <a class="btn btn-primary text-white" href="{{ route('admin.sectas.create')}}">Ajouter un nouveaux secteur d'activité</a>
                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">SI</th>
                                    <th width="20%">Nom</th>
                                    <th width="30%"></th>

                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sect_activs as $Sectas)

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$Sectas->nom_secteur}}</td>
                                    <td></td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('sectA.edit'))
                                         <a class="btn btn-success text-white" href="{{ route('admin.sectas.edit', $Sectas->id)}}" > Modifier </a>

                                        @endif

                                        @if(Auth::guard('admin')->user()->can('sectA.delete'))

                                        <a class="btn btn-danger text-white" href="{{ route('admin.sectas.destroy', $Sectas->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{$Sectas->id}}').submit();">
                                             Supprimer
                                        </a>

                                        <form id="delete-form-{{$Sectas->id}}" action="{{ route('admin.sectas.destroy', $Sectas->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                             @csrf
                                         </form>

                                        @endif


                                    </td>
                                </tr>

                                @endforeach



                            </tbody>
                        </table>
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
