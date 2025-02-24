@extends('backend.layouts.master')


@section('title')
Modifier Département | tableau de bords
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
                <h4 class="page-title pull-left">Départemen</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.villes.index')}}">Tous les Départements</a></li>
                <li><span>Modifier Département {{$Villes->nom_ville}}</span></li>
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
                    <h4 class="header-title">Modifier Département</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.villes.update', $Villes->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom Département</label>
                        <input type="text" class="form-control" id="nom_ville" name="nom_ville"   required="on" value="{{$Villes->nom_ville}}">

                        </div>



                    </div>

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">slug Département</label>
                        <input type="text" class="form-control" id="slug_ville" name="slug_ville"   required="on" value="{{$Villes->slug_ville}}">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Région de reference</label>
                            <select name="region_id" id="region_id" class="form-control" required='on'>
                                @foreach ($Region as $region)

                            <option value ="{{$region->id}}">{{$region->nom_region}}</option>

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


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour des informations</button>
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
