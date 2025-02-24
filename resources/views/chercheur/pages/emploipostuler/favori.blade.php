@extends('chercheur.layouts.masterL')


@section('title')

TABLEAU DE BORD
@endsection









@section('admin-content')


<div class="container">

@include('chercheur.layouts.partials.messages')

        <div class="row">

            @foreach ($Emplois_fav as $Emploi_Postuler)


    <div class="job-list">


        <div class="thumb" {{$loop->index+1}}>
            <a href="#">
                <img class="avatar user-thumb" src="{{asset('site/img/logo2.png')}}" width="50px" height="50px" alt="image" style="border-radius: 50%;">

            </a>
        </div>
        <div class="body">
            <div class="content">
                <h4>  <a> {{$Emploi_Postuler->titre_post_emploi}}</a></h4>


            </div>
            <div class="more">
                <div class="buttons">

                    <a href="{{route('chercheur.postemplois.edit',Crypt::encrypt($Emploi_Postuler->id))}}" class="button" style="color: dodgerblue"><i class="ti-eye" style="color: dodgerblue"></i>Consulter l'offre</a>


                </div>
            </div>

        </div>
    </div>
        @endforeach

                  <div>
                    <center>
                        {{--$Emplois_ostuler->links()--}}
                    </center>
                    </div>

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
<script type="text/javascript">


    jQuery('select[name="id_region_post_emploi"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegion/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="id_ville_post_emploi"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="id_ville_post_emploi"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="id_ville_post_emploi"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="id_ville_post_emploi"]').empty();

        }





    });









</script>


@endsection
