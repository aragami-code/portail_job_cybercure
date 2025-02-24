@extends('backend.layouts.master')


@section('title')
Modifier Region | tableau de bords
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
                <h4 class="page-title pull-left">Region</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.regions.index')}}">Tous les Regions</a></li>
                <li><span>Modifier la Region {{$Regions->nom_region}}</span></li>
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
                    <h4 class="header-title">Modifier une Region</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.regions.update', $Regions->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de la Region</label>
                        <input type="text" class="form-control" id="nom_region" name="nom_region"   required="on" value="{{$Regions->nom_region}}">

                        </div>



                    </div>

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">slug Region</label>
                        <input type="text" class="form-control" id="slug_region" name="slug_region"   required="on" value="{{$Regions->slug_region}}">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Etat referent</label>
                            <select name="etat_id" id="etat_id" class="form-control" required='on'>
                                @foreach ($Etat as $etat)

                            <option value ="{{$etat->id}}">{{$etat->nom_etat}}</option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Option</label>
                            <select name="status" id="status" class="form-control">
                                <option value ="1">Activer</option>
                                <option value ="0">Desactiver</option>


                            </select>

                        </div>


                    </div>


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour</button>
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
@endsection
