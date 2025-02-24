@extends('site.home.fr.master2L')
@section('name')






		<!-- Page Sub Menu
		============================================= -->








        <!-- Banner -->
        <div class="banner banner-4 banner-4-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-content">
                            <h1>Dénichez en toute quiétude votre emploi</h1>
                            <p> Trouvez des opportunités d'emploi et de carrière</p>

                            <div class="banner-search">
                                <form action="{{route('resultatRecherche')}}" method="GET" enctype="multipart/form-data" class="search-form">
                                    @csrf
                                    <input type="text" class="form-control" id="titre_post_emploi" name="titre_post_emploi"  placeholder="Enter le titre de l'offre" required="on">


                                    <button class="button primary-bg"><i class="fas fa-search"></i>Rechercher</button>
                                </form>
                                <div class="trending-key">
                                    <span>Mots clés les plus utilisés:</span>
                                    <a href="#">Administrateur / Administratrice sécurité</a>
                                    <a href="#">Consultant en cybersécurité</a>
                                    <a href="#">Cryptologue</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Explore Job
        <div class="section-padding-top padding-bottom-90">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section-header">
                            <h2>Trouvez le bon emploi</h2>
                            <p>Quelques informations clés pour trouver facilement un emploi</p>
                        </div>
                    </div>
                </div>
        </div>
        </div>-->
        <!-- Explore Job End -->

        <!-- Jobs -->
        <div class="section-padding alice-bg">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section-header section-header-2 section-header-with-right-content">
                            <h2>Emplois récents</h2>
                            <a href="{{route('rech')}}" class="header-right button"><p style="color: white;">+ Afficher plus</p></a>
                        </div>
                    </div>
                </div>
                <div class="row">


            <div class="col">
                    <div class="job-filter-result" id="updateDiv">


                        @if ($PostEmplois->isEmpty())

                        aucune offre trouver

                        @else



                        @foreach ($PostEmplois as $Emploi_Postuler)

                    <div class="job-list">


                        <div class="thumb" {{$loop->index+1}}>
                            <a href="#">
                                <img src="{{asset('user/images/logo1.png')}}" class="image"   alt="image">
                            </a>
                        </div>
                        <div class="body">
                            <div class="content">
                                <h4>  <a href="{{route('carriereinfo',Crypt::encrypt($Emploi_Postuler->id))}}"> {{$Emploi_Postuler->titre_post_emploi}}</a></h4>

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



                                <p class="deadline">Posté il y'a: {{$diff}}</p>

                            </div>

                        </div>
                    </div>
                        @endforeach

                                  <div>
                                    <center>
                                        {{$PostEmplois->links()}}
                                    </center>
                                    </div>
                    @endif


                </div>

            </div>




{{--

                    <div class="col">
                        @foreach ($PostEmplois as $Jb )

                        <div class="job-list">

                            <div class="thumb">
                                <a href="#">
                                    <img src="images/job/company-logo-1.png" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="body">
                                <div class="content">
                                    <h4><a href="{{--route('carriereinfo',Crypt::encrypt($Jb->id))">--}}{{--}} {!!$Jb->titre_post_emploi!!} H/F</a></h4>
                                    <div class="info">

                                        <?php
                                       // $diff = Carbon\Carbon::setLocale('fr');
                                       // $diff = Carbon\Carbon::parse($Jb->created_at)->diffForHumans();
                                        ?>
                                        <span class="office-location"><a href="#"><i data-feather="map-pin"></i>{!!$Jb->nom_ville!!}</a></span>
                                                                                <span class="job-type full-time"><a href="#"><i data-feather="clock"></i>{!!$Jb->contrat_empl!!}</a></span>


                                        <p class="card-text"><i class="ti-pencil-alt"></i> {{$diff}}

                                     </p>
                                       </div>
                                </div>
                                <div class="more">
                                    <div>
                                        <a  href="{{route('carriereinfo',Crypt::encrypt($Jb->id))}}" class="button">Postuler</a>

                                    </div>
                                    <p class="deadline"></p>

                                     <p class="deadline"></p>
                                    <div class="social-profile">
                                        <label> Partager sur :</label><br>
                                        <a href="https://facebook.com/sharer/sharer.php?u={{route('carriereinfo',Crypt::encrypt($Jb->id))}}" class="sharebox"><i class="fab fa-facebook-f"></i></a>
                                         <a href="http://www.linkedin.com/shareArticle?mini=true&url={{route('carriereinfo',Crypt::encrypt($Jb->id))}}"><i class="fab fa-linkedin-in"></i></a>

                                      </div>

                                </div>
                            </div>

                        </div>
                        @endforeach
                        <div class="pagination-list text-center">
                            <nav class="navigation pagination">
                                <div class="nav-links">
                                    {{$PostEmplois->links()}}
                                </div>
                            </nav>
                        </div>

                    </div>--}}
                </div>
            </div>
        </div>
        <!-- Jobs End -->

        <!-- Fun Facts -->
        <div class="padding-top-90 padding-bottom-60 fact-bg">
            <div class="container">
                <div class="row fact-items">
                    <div class="col-md-4 col-sm-6">
                        <div class="fact">
                            <div class="fact-icon">
                                <i data-feather="briefcase"></i>
                            </div>
                            <p class="fact-number"><span class="count" data-form="0" data-to="2176"></span></p>
                            <p class="fact-name">Emplois disponibles</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="fact">
                            <div class="fact-icon">
                                <i data-feather="users"></i>
                            </div>
                            <p class="fact-number"><span class="count" data-form="0" data-to="562"></span></p>
                            <p class="fact-name">Candidats</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="fact">
                            <div class="fact-icon">
                                <i data-feather="award"></i>
                            </div>
                            <p class="fact-number"><span class="count" data-form="0" data-to="66"></span></p>
                            <p class="fact-name">Entreprises</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="gotoTop" class="icon-angle-up"></div>
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



<script>
    $(function() {




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

            console.log(response);
            $('#updateDiv').html(response);
            }
        });
    });










    });
</script>

<script>
    function send(){




        vil = $(".villeID").val();
        secteur = $(".secteurID").val();


    /*
    if(start == 0 && end != null){
    alert("oups");
    }*/

                $.ajax({
                type: 'get',
                dataType: 'html',
                url:'',
                // url:'chercheur.dashboard',
                data: " vil="+FinalVil +"secteur="+FinalSecteur,

                success: function(response){

                console.log(response);
                $('#updateDiv').html(response);
                }
            });

    }


    </script>


@endsection

