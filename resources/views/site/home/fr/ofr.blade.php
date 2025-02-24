

<div class="job-filter-result">


    @if ($Emplois_Postuler->isEmpty())

    aucune offre trouver

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


            <p class="deadline"><b style="color: red">Date Limite:{{$Emploi_Postuler->DL}}</b></p>
            <p class="deadline">Posté il y'a {{$diff}}</p>
        </div>
    </div>
</div>
    @endforeach

              <div>
                <center>
                    {{--$Emplois_Postuler->links()--}}
                </center>
                </div>
@endif


</div>

