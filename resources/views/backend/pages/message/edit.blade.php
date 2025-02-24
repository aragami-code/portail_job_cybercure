@extends('backend.layouts.master')


@section('title')
Lire le message | tableau de bords
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
                <h4 class="page-title pull-left">Message</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.contrats.index')}}">Tous les Diplômes</a></li>
                <li><span>Lire le message{{$Message->Name}}</span></li>
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
                    <h4 class="header-title">Message </h4>



                    <div class="form-row">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Nom</label>
                            <input type="hidden" class="form-control" required="on" value="{{$Message->id}}" readonly>

                            <input type="text" class="form-control"  required="on" value="{{$Message->Name}}" readonly>
                        <br>
                        <input type="text" class="form-control"  required="on" value="{{$Message->Email}}" readonly>
                        <br>
                        <input type="text" class="form-control" required="on" value="{{$Message->Objet}}" readonly>
                        <br>

                        <textarea class="form-control" id="sommaire_article" name="sommaire_article" class="form-group col-md-6 col-sm-12" readonly>
                                {{$Message->Message}}
                        </textarea>

                        </div>


                    </div>


                        <a href="{{route('admin.message.index')}}"><button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">retourner aux message</button></a>

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
