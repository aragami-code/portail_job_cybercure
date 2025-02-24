@extends('backend.layouts.master')


@section('title')
Ajouter Departement | tableau de bords
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
                <h4 class="page-title pull-left">Département</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.villes.index')}}">Toute Les Départments</a></li>
                    <li><span>Ajouter un Département</span></li>
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
                    <h4 class="header-title">Ajouter un Département</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.villes.store')}}" method="POST">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Nom Département</label>
                            <input type="text" class="form-control" id="nom_ville" name="nom_ville"  placeholder="Enter le nom de la ville Ex: Paris" required="on">

                        </div>




                    </div>
                    <div class="form-row">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Slug Département</label>
                            <input type="text" class="form-control" id="slug_ville" name="slug_ville"  placeholder="Enter le nom minuscule Ex: paris" required="on">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Region de reference</label>
                            <select name="region_id" id="region_id" class="form-control" required='on'>
                                @foreach ($Region as $region)

                            <option value ="{{$region->id}}">{{$region->nom_region}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Option</label>
                            <select name="status" id="status" class="form-control">
                                <option value ="1">activer</option>
                                <option value ="0">desactiver</option>


                            </select>

                        </div>


                    </div>


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Ajouter</button>
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
