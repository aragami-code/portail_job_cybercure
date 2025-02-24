@extends('chercheur.layouts.masterL')


@section('title')
Experiences | tableau de bords
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

                <div class="edication-background details-section dashboard-section">

                        <div class="col-12">
                            <h4><i data-feather="book"></i>Experiences Professionnelles</h4>

                            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter</a>


                            <table class="table table-bordered" id="laravel_crud">

                             <tbody id="posts-crud">

                                <p style="color: floralwhite">Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>





                                @foreach($experiences as $experience)



                                    <div class="edication-background details-section dashboard-section">


                                        <div class="education-label"  id="id_{{ $experience->id }}">
                                          <span class="study-year">{{ $experience->titre_job  }}</span><br>
                                          <h5>Date de prise de service: {{ $experience->date_debut   }} Date de fin: {{$experience->date_fin  }}</h5>
                                          <h5>Structure:<span>{{ $experience->entreprise }}</span></h5><br>
                                          <h5>Missions/Taches:</h5>
                                         <p>{{ $experience->mission }}</p>

                                    <span>
                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $experience->id }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" id="delete-post" data-id="{{ $experience->id }}" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a>
                                    </span>
                                           </div>

                                        <!-- Button trigger modal -->


                                      </div>



                                @endforeach
                             </tbody>
                            </table>
                            {{ $experiences->links() }}
                         </div>


                         <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="postForm" name="postForm" class="form-horizontal">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::guard('chercheur')->user()->id}}">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Nom du poste</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="titre_job" name="titre_job" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Nom de l'entreprise</label>
                                            <div class="col-sm-12">
                                                <input class="form-control" id="entreprise" name="entreprise" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Date debut</label>
                                            <div class="col-sm-12">
                                                <input type="month" class="form-control" id="date_debut" name="date_debut" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Date fin</label>
                                            <div class="col-sm-12">
                                                <input type="month" class="form-control" id="date_fin" name="date_fin" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Toujours employé dans la structure</label>
                                            <select name="actif" id="actif" class="form-control" required='on'>
                                                <option value ="non">non</option>
                                                <option value ="oui">oui</option>
                                              </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Vos missions/taches effectuées en entreprise</label>

                                        <textarea class="form-control" id="mission" name="mission" class="form-group col-md-6 col-sm-12" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                                        </textarea>

                                        </div>
                                        <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Sauvegarder
                                        </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                            </div>
                        </div>


                    </div>









            </div>
            <div class="dashboard-sidebar">


              <div class="dashboard-menu">
                <ul>
                    <li><i data-feather="user"></i><a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-selected="true">Generale</a>
                    </li>
                    <li ><i data-feather="book"></i><a>Formations</a>
                    </li>
                    </li>
                    <li ><i data-feather="feather"></i> <a href="{{route('chercheur.sommaire.index')}}">Competences</a>
                    </li>
                    <li><i data-feather="plus-square"></i>  <a href="{{route('chercheur.langue.index')}}">Langues parlées</a>
                    </li>
                    <li class="active"><i data-feather="briefcase"></i> <a>Experiences</a>
                    </li>
                    <li><i data-feather="edit"></i>  <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}">Profil</a>
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




<script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#create-new-post').click(function () {
          $('#btn-save').val("create-post");
          $('#postForm').trigger("reset");
          $('#postCrudModal').html("ajouter une Experience");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var post_id = $(this).data('id');
        $.get('experience/'+post_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#titre_job').val(data.titre_job);
            $('#entreprise').val(data.entreprise);
            $('#date_debut').val(data.date_debut);
            $('#date_fin').val(data.date_fin);
            $('#actif').val(data.actif);
            $('#mission').val(data.mission);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var experience_id = $(this).data("id");
          confirm("voulez vous vraiment supprimer cette info? !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('user/experience')}}"+'/'+experience_id,
              success: function (data) {
                  $("#id_" + experience_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });
    });

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');


        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('chercheur.experience.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


                    var experience = '<div id="id_' + data.id + '" class="education-label">'
                    +'<span class="study-year">' + data.titre_job + '</span><br>'+'<h5>Date de prise de service: '
                     + data.date_debut + ' '+'  Date de fin:'+' ' + data.date_fin + '</h5><h5>Missions/Tâches:</h5><br> <p>' + data.mission+ '</p>';
                experience += '<span><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a></span>';
                experience += '</div>';




                if (actionType == "create-post") {
                    $('#posts-crud').prepend(experience);
                } else {
                    $("#id_" + data.id).replaceWith(experience);
                }

                $('#postForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');

            },
            error: function (data) {
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    })
  }


</script>




@endsection






























































