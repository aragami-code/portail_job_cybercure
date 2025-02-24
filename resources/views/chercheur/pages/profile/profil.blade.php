@extends('chercheur.layouts.masterL')


@section('title')
Actualiser mes informations | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">

@endsection





@section('admin-content')

<div class="alice-bg section-padding-bottom">
    <div class="container no-gliters">
      <div class="row no-gliters">
        <div class="col">
          <div class="dashboard-container">
            <div class="dashboard-content-wrapper">
                <p style="color: floralwhite">Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>

                <div class="edication-background details-section dashboard-section">

                    <form action="{{route('chercheur.profile.update',Auth::guard('chercheur')->user()->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                    <div class="dashboard-section upload-profile-photo">
                    <div class="update-photo">
                        <img class="image" src="{{asset("user/images/Chercheur/$user->photo")}}" alt="">
                    </div>
                    <div class="file-upload">
                        <input type="hidden" class="form-control" id="photo2" name="photo2" value="{{$user->photo}}">

                        <input type="file" class="file-input" id="photo" name="photo">Changer Avatar
                    </div>
                    </div>
                    <div class="dashboard-section basic-info-input">
                    <h4><i data-feather="user-check"></i>Information Utilisateur</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"for="name">Nom de l'utilisateur</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="username"  placeholder="Enter le nom d'un utilisateur" required="on" value="{{$user->username}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"for="email">Email</label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Enter un email" required="on" value="{{$user->email}}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="password">Mot de passe Utilisateur</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="password_confirmation">Confirmer le Mot de passe</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="confirmer le  mot de passe">

                        </div>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                        <button class="button">Mettre à jour mes informations</button>
                        </div>
                    </div>
                     </form>


                    </div>









            </div>
            <div class="dashboard-sidebar">


              <div class="dashboard-menu">
                <ul>
                    <li><i data-feather="user"></i><a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-selected="true">Generale</a>
                    </li>
                    <li ><i data-feather="book"></i> <a>Formations</a>
                    </li>
                    </li>
                    <li ><i data-feather="feather"></i> <a href="{{route('chercheur.sommaire.index')}}">Competences</a>
                    </li>
                    <li><i class="fas fa-comment"></i>  <a href="{{route('chercheur.langue.index')}}">Langues parlées</a>
                    </li>
                    <li><i data-feather="briefcase"></i> <a>Experiences</a>
                    </li>
                    <li class="active"><i class="fas fa-edit"></i>  <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}">Profil</a>
                    </li>
                    </ul>

              </div>
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
   <script src="{{asset('user/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


<script type="text/javascript">


    jQuery('select[name="region"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: "{{ url('findRegion')}}"+'/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="ville"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="ville"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="ville"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="ville"]').empty();

        }





    });









</script>





@endsection

















