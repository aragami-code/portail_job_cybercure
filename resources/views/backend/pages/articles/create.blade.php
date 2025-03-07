@extends('backend.layouts.master')


@section('title')
Ajouter un Article | tableau de bords
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
                <h4 class="page-title pull-left">Article</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.articles.index')}}">Tous les Articles</a></li>
                    <li><span>Ajouter un Article</span></li>
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
                    <h4 class="header-title">Ajouter un Article</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.articles.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de l'article ou titre</label>
                            <input type="text" class="form-control" id="name_article" name="name_article"  placeholder="Enter le nom d'une categorie qu va contenir le post daans un blog" required="on">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Auteur</label>
                            <input type="hidden" class="form-control" id="id_admin" name="id_admin"  readonly value="{{Auth::guard('admin')->user()->id}}">
                            <input type="text" class="form-control"  readonly value="{{Auth::guard('admin')->user()->name}}">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Sommaire (Description sommaire de l'article)</label>
                            <textarea class="form-control" id="sommaire_article" name="sommaire_article" class="form-group col-md-6 col-sm-12">

                            </textarea>
                        </div>


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Categorie(Theme)</label>
                            <select name="id_categorie" id="id_categorie" class="form-control" required='on'>
                                @foreach ($Bcategory as $categorie)

                            <option value ="{{$categorie->id}}">{{$categorie->name}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Mot cle</label>
                            <input type="text" class="form-control" id="mot_cle_article" name="mot_cle_article"  placeholder="le mot cle" required="on">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Image</label>
                            <input type="file" class="form-control" id="image_article" name="image_article"  placeholder="choisir l'image" required="on">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Description (Contenu)</label>

                            <textarea class="form-control" id="description_article" name="description_article" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                            </textarea>
                        </div>

                    </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Enregistrer et Publier</button>
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
