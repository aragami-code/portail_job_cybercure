@extends('chercheur.layouts.masterL')


@section('title')
Langues | tableau de bords
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
                    <h4><i data-feather="feather"></i>Langues</h4>
                    <div class="progress-group">


                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter</a>


                        <table id="laravel_crud">

                         <tbody id="posts-crud">

                            <p style="color: floralwhite">Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>


                            @foreach($langues as $competence)






                            <div class="progress-item" id="id_{{ $competence->id }}">


                              <div class="progress-head">
                                <p class="progress-on"><b>Langue:</b> {{ $competence->langue }} <br> <b>Niveau:</b> {{ $competence->niveau  }}</p>
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
                         {{ $langues->links() }}


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
                                    <label for="name" class="col-sm-4 control-label">Langue que vous maitrisez</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="langue" name="langue" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Niveau</label>
                                    <select name="niveau" id="niveau" class="form-control" required='on'>
                                        <option value ="Debutant">Débutant</option>
                                        <option value ="Intermediaire">Intermediaire</option>
                                        <option value ="Avancé">Avancé</option>
                                        <option value ="Expert">Expert</option>
                                      </select>
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
                    <li><i data-feather="feather"></i> <a  href="{{route('chercheur.sommaire.index')}}">Competences</a>
                    </li>
                    <li class="active"><i data-feather="plus-square"></i>  <a>Langues parlées</a>
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
          $('#postCrudModal').html("ajouter une Langue");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var langue_id = $(this).data('id');
        $.get('langue/'+langue_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#langue').val(data.langue);
            $('#niveau').val(data.niveau);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var langue_id = $(this).data("id");
          confirm("voulez vous vraiment supprimer cette info? !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('user/langue')}}"+'/'+langue_id,
              success: function (data) {
                  $("#id_" + langue_id).remove();
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
            url: "{{ route('chercheur.langue.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {





                    var langue = '<div id="id_' + data.id + '" class="progress-item">'
                    +'<div class="progress-head"><p class="progress-on"> <b>Langue:</b> <br>'+ data.langue+'<b>Niveau:</b>  '+data.niveau+'</p></div>';
                     langue += '<br><span><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a></span>';
                     langue += '</div>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(langue);
                } else {
                    $("#id_" + data.id).replaceWith(langue);
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
















































