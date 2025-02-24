@extends('backend.layouts.master')


@section('title')
Modifier Article | tableau de bords
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
                <h4 class="page-title pull-left">Modifier Evenement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.evenement.index')}}">Tout les Evenements</a></li>
                <li><span>Modifier l'Evenement {{$Evenement->name_evenement}}</span></li>
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
                    <h4 class="header-title">Modifier un article</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.evenement.update', $Evenement->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de l'evenement ou titre</label>
                            <input type="text" class="form-control" id="name_evenement" name="name_evenement"  placeholder="Donner un titre à un evenement" required="on" value="{{$Evenement->name_evenement}}">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">date de l'evenement</label>
                            <input type="date" class="form-control" id="date_evenement" name="date_evenement"  placeholder="choisir la date" required="on" value="{{$Evenement->date_evenement}}">

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Sommaire (Description Sommaire de l'evenement)</label>
                            <textarea class="form-control" id="sommaire_evenement" name="sommaire_evenement" class="form-group col-md-6 col-sm-12" value="{{$Evenement->sommaire_evenement}}">
                                {{$Evenement->sommaire_evenement}}
                            </textarea>
                        </div>




                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Image</label>
                            <input type="file" class="form-control" id="image_evenement" name="image_evenement">

                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug"></label>
                            <img src="{{asset("backend/images/blog/$Evenement->image_evenement")}}" width="30%" >
                            <input type="hidden" class="form-control" id="image_article2" name="image_evenement2" value="{{$Evenement->image_evenement}}">

                        </div>

                    </div>

                   <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Modifier et Publier</button></center>
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
