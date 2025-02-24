@extends('site.home.fr.master2L')


@section('name')


<div class="alice-bg section-padding-bottom">
    <div class="container">
        <div class="row no-gutters">
            <div class="col">
                  <div class="filtered-job-listing-wrapper">
                        <div class="job-view-controller-wrapper">
                            <div class="job-view-controller">
                                <div class="controller list active">
                                    <i data-feather="menu"></i>
                                </div>
                                <div class="controller grid">
                                    <i data-feather="grid"></i>
                                </div>

                            </div>


                       <center> <button type="button" class=" button primary-bg search"  data-toggle="modal" data-target="#modal">
                        <i data-feather="search"></i>Recherche avancée
                        </button>  </center> <br>

                            <!--
                            <div class="showing-number">
                                <span>Showing 1–12 of 28 Jobs</span>
                            </div>-->
                        </div>




                        <div class="job-filter-result" id="updateDiv">


                                @if ($Emplois_Postuler->isEmpty())

                                Aucune offre trouvée

                                @else



                                @foreach ($Emplois_Postuler as $Emploi_Postuler)

                            <div class="job-list">


                                <div class="thumb" {{$loop->index+1}}>
                                    <a href="#">
                                        <img src="{{asset('user/images/logo1.png')}}" class="image"   alt="image">
                                    </a>
                                </div>
                                <div class="body">
                                    <div class="content">
                                        <h4>  <a href="{{route('chercheur.postemplois.edit',Crypt::encrypt($Emploi_Postuler->id))}}"> {{$Emploi_Postuler->titre_post_emploi}}</a></h4>

                                        <div class="info">
                                            <span class="office-location"><a href="#"><i data-feather="map-pin"></i>{{$Emploi_Postuler->nom_ville}}</a></span>
                                            <span class="job-type temporary"><a href="#"><i data-feather="clock"></i>{{$Emploi_Postuler->type_empl}} </a></span>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <div class="buttons">

                                            <a href="{{route('carriereinfo',Crypt::encrypt($Emploi_Postuler->id))}}" class="button" style="color: dodgerblue"><i class="ti-eye" style="color: dodgerblue"></i>Consulter l'offre</a>


                                        </div>
                                        <?php
                                        $diff = Carbon\Carbon::setLocale('fr');
                                        $diff = Carbon\Carbon::parse($Emploi_Postuler->created_at)->diffForHumans();
                                        ?>


                                        <p class="deadline"><b style="color: red"> Date limite: {{$Emploi_Postuler->DL}}</b></p>
                                        <p class="deadline">Posté il y'a: {{$diff}}</p>
                                    </div>
                                </div>
                            </div>
                                @endforeach

                                          <div>
                                            <center>
                                                {{$Emplois_Postuler->links()}}
                                            </center>
                                            </div>
                            @endif


                        </div>







                    </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <div class="title">
                <h4 align="center"><i data-feather="search"></i>Recherche avancée</h4>
            </div>
            <div class="content">
                <div class="job-filter-dropdown same-pad category">
                    <b>Categorie</b>
                <div style="position: relative; overflow-y: scroll; width:450px; height:100px">


                    @php
                    $sectas = DB::table('sect_activs')->orderby('nom_secteur','ASC')->get();
                    @endphp

                    @foreach ($sectas as $secteur)
                    <input type="checkbox" class="secteurID" value="{{$secteur->id}}"/><span class="pull-rigth">({{App\Post_Emploi::where('sectas_post_emploi',$secteur->id)->count()}})</span> {{$secteur->nom_secteur}}<br>
                    @endforeach

                </div>

                </div>
                <div class="job-filter-dropdown same-pad location">
                    <b>Département:</b>
                    <div style="position: relative; overflow-y: scroll; width:450px; height:100px">


                        @php
                        $ville = DB::table('villes')->orderby('nom_ville','ASC')->get();
                        @endphp

                        @foreach ($ville as $vil)
                        <li><input type="checkbox" class="villeID" value="{{$vil->id}}"/><span class="pull-rigth">({{App\Post_Emploi::where('id_ville_post_emploi',$vil->id)->count()}})</span> {{$vil->nom_ville}}</li>
                        @endforeach




                     </div>
                </div>
                <div data-id="job-type" class="job-filter job-type same-pad">

                    <b class="option-title">Periode:</b>

                    <div>
                            @php
                            $period = DB::table('typ_emps')->orderby('type_empl','ASC')->get();
                            @endphp

                            <ul>
                                @foreach ($period as $periode)

                            <li class="freelance"><input type="checkbox" class="periodID" value="{{$periode->id}}"/><span class="pull-rigth">({{App\Post_Emploi::where('typemp_post_emploi',$periode->id)->count()}})</span> {{$periode->type_empl}}</li>

                           @endforeach
                        </ul>

                         </div>
                </div>
                <div data-id="experience" class="job-filter experience same-pad">
                    <b class="option-title">Type de contrat:</b>
                    <div style="position: relative; overflow-y: scroll; width:450px; height:100px">

                        @php
                        $contrat = DB::table('contrat_emps')->orderby('contrat_empl','ASC')->get();
                        @endphp

                        @foreach ($contrat as $contratt)
                        <li><input type="checkbox" class="contratID" value="{{$contratt->id}}"/><span class="pull-rigth">({{App\Post_Emploi::where('contrat_post_emploi',$contratt->id)->count()}})</span> {{$contratt->contrat_empl}}</li>
                        @endforeach
                    </div>





                </div>

                     <div class="job-filter same-pad">
                        <b class="option-title">Salaire en k € par an:</b>
                        <div class="price-range-slider" style="width:450px; height:50px">
                            <b> <input type = "text" id ="amount_start" name="start_price" value="0"
                                style = "border:0; color:#2f4eb4; font-weight:bold;" readonly="on">
                               <b style="color: blanchedalmond"> -------------------------</b>
                              <input type = "text" id = "amount_end" name="end_price" value="250"
                                style = "border:0; color:#2f4eb4; font-weight:bold;" readonly="on" style="height:50px"></b>

                          <div id = "slider-3"></div>
                          <div id="showDiv"><div id="showPrice"></div></div>
                        </div>
                      <center>  <button  onclick="send()" class="button primary-bg">Filtrer</button></center>

                      </div>







            </div>
        </div>
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


        <script>
            $(function() {
                var start;
                var end;
            $( "#slider-3" ).slider({
                range:true,
                min: 0,
                max: 250,
                values: [ 0, 250 ],
                slide: function( event, ui ) {
                    $( "#amount_start" ).val(ui.values[ 0 ]);
                    $( "#amount_end" ).val(ui.values[ 1 ]);









                }
            });





            $('.villeID').click(function(){
                var vil=[];
                $('.villeID').each(function(){

                    if($(this).is(":checked")){
                        vil.push($(this).val());
                    }

                });

                FinalVil = vil.toString();
                /**/$.ajax({
                    type: 'get',
                    dataType: 'html',
                    url:'',
                    data: "vil="+FinalVil,

                    success: function(response){

                    console.log(response);
                    $('#updateDiv').html(response);
                    }
                });
            });



            $('.contratID').click(function(){
                var contratt=[];
                $('.contratID').each(function(){

                    if($(this).is(":checked")){
                        contratt.push($(this).val());
                    }

                });

                FinalContrat = contratt.toString();
                /**/$.ajax({
                    type: 'get',
                    dataType: 'html',
                    url:'',
                    data: "contratt="+FinalContrat,

                    success: function(response){

                  //  console.log(response);
                    $('#updateDiv').html(response);
                    }
                });
            });



            $('.secteurID').click(function(){
                var secteur=[];
                $('.secteurID').each(function(){

                    if($(this).is(":checked")){
                        secteur.push($(this).val());
                    }

                });

                FinalSecteur = secteur.toString();
              /**/ $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url:'',
                    data: "secteur="+FinalSecteur,

                    success: function(response){

                    //console.log(response);
                    $('#updateDiv').html(response);
                    }
                });
            });



            $('.periodID').click(function(){
                var periode=[];
                $('.periodID').each(function(){

                    if($(this).is(":checked")){
                        periode.push($(this).val());
                    }

                });

                FinalPeriod = periode.toString();
                /**/$.ajax({
                    type: 'get',
                    dataType: 'html',
                    url:'',
                    data: "periode="+FinalPeriod,

                    success: function(response){

                    console.log(response);
                    $('#updateDiv').html(response);
                    }
                });
            });






            });
        </script>

<script>
    function send(){


 start = $("#amount_start").val();
           end = $("#amount_end").val();


        vil = $(".villeID").val();
        contratt = $(".contratID").val();
        secteur = $(".secteurID").val();
        periode = $(".periodID").val();


    /*
    if(start == 0 && end != null){
    alert("oups");
    }*/

                $.ajax({
                type: 'get',
                dataType: 'html',
                url:'',
                // url:'chercheur.dashboard',
                data: " vil="+FinalVil +"contratt="+FinalContrat+"secteur="+FinalSecteur +"periode="+FinalPeriod,

                success: function(response){

                console.log(response);
                $('#updateDiv').html(response);
                }
            });

    }


    </script>








@endsection
