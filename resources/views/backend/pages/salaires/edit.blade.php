@extends('backend.layouts.master')


@section('title')
Editer une Plage Salariale | tableau de bords
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
                <h4 class="page-title pull-left">Plage Salariale</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.salaires.index')}}">Toute les Plages Salariale</a></li>
                <li><span>Editer la Plage Salariale {{$Salaire->plage_salaire}}</span></li>
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
                    <h4 class="header-title">Editer une Plage Salariale</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.salaires.update', $Salaire->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Plage Salaire</label>
                        <input type="text" class="form-control" id="plage_salaire" name="plage_salaire"  placeholder="Enter le nom de plage salariale Ex: 1000 - 20000" required="on" value="{{$ContratEmps->contrat_empl}}">

                        </div>


                    </div>


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">enregistrer</button>
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
