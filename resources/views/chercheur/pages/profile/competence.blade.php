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




                <div class="professonal-skill dashboard-section details-section">
                    <h4><i data-feather="feather"></i>Competences Acquises</h4>
                    <div class="progress-group">


                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter</a>


                        <table class="table table-bordered" id="laravel_crud">

                         <tbody id="posts-crud">

                            <p style="color: floralwhite">Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>


                            @foreach($competences as $competence)






                            <div class="progress-item" id="id_{{ $competence->id }}">


                              <div class="progress-head">
                                <p class="progress-on">{{ $competence->competences_user }} Niveau: {{ $competence->niveau  }}</p>
                              </div>
                              <div class="progress-body">
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="{{$competence->pourcentage}}" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                                </div>
                                </div>
                                <p class="progress-to">{{$competence->pourcentage}}%</p>
                              </div>
                              <br>
                              <span>
                                <a href="javascript:void(0)" id="edit-post" data-id="{{ $competence->id }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" id="delete-post" data-id="{{ $competence->id }}" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a>
                             </span>
                            </div>


                            @endforeach



                         </tbody>
                        </table>
                         {{ $competences->links() }}


                    </div>
















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
                                                <label for="name" class="col-sm-4 control-label">Competence que vous maitriser</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="competences_user" name="competences_user" value="" required="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">niveau</label>
                                                <select name="niveau" id="niveau" class="form-control" required='on'>
                                                    <option value ="Debutant">Débutant</option>
                                                    <option value ="Intermediaire">Intermediaire</option>
                                                    <option value ="Avancé">Avancé</option>
                                                    <option value ="Expert">Expert</option>
                                                  </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">pourcentage de maitrise</label>
                                                <input type="number" max="100" name="pourcentage" id="pourcentage"  class="form-control" required='on'>
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
            <div class="dashboard-sidebar">

              <div class="dashboard-menu">
                <ul>
                    <li><i data-feather="user"></i><a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" aria-selected="true">Generale</a>
                    </li>
                    <li><i data-feather="book"></i> <a href="{{route('chercheur.niveau.index')}}">Formations</a>
                    </li>
                    <li class="active"><i data-feather="feather"></i> <a>Competences</a>
                    </li>
                    <li><i data-feather="plus-square"></i>  <a href="{{route('chercheur.langue.index')}}">Langues parlées</a>
                    </li>
                    <li><i data-feather="briefcase"></i> <a href="{{route('chercheur.experience.index')}}">Experiences</a>
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
          $('#postCrudModal').html("ajouter une Competence");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var competences_id = $(this).data('id');
        $.get('Competence/'+competences_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#competences_user').val(data.competences_user);
            $('#niveau').val(data.niveau);
            $('#pourcentage').val(data.pourcentage);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var competence_id = $(this).data("id");
          confirm("voulez voous vraiment supprimer cette info? !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('user/Competence')}}"+'/'+competence_id,
              success: function (data) {
                  $("#id_" + competence_id).remove();
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
            url: "{{ route('chercheur.sommaire.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


                    var competences = '<div id="id_' + data.id + '" class="progress-item">'
                    +'<div class="progress-head"><p class="progress-on">'+ data.competences_user+'Niveau'+data.niveau+'</p></div>'+
                    '<div class="progress-body"><div class="progress"> <div class="progress-bar" role="progressbar" aria-valuenow="' + data.pourcentage + '" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div></div> <p class="progress-to">' + data.pourcentage + '%</p></div>';
                     competences += '<br><span><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a></span>';
                     competences += '</div>';
































                if (actionType == "create-post") {
                    $('#posts-crud').prepend(competences);
                } else {
                    $("#id_" + data.id).replaceWith(competences);
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
























































