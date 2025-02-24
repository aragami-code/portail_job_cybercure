@extends('chercheur.layouts.masterL')


@section('title')
Formation | tableau de bords
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
                            <h4><i data-feather="book"></i>Cursus Academique/Formation</h4>

                            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter formation</a>


                            <table class="table table-bordered" id="laravel_crud">

                             <tbody id="posts-crud">

                                <p style="color: floralwhite">Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage</p>

                                @foreach($posts as $post)

                                    <div class="edication-background details-section dashboard-section">


                                        <div class="education-label"  id="id_{{ $post->id }}">
                                          <span class="study-year">{{ $post->annee  }}</span><br>
                                          <h5>{{ $post->titre_niveau  }} Option: {{ $post->option  }}</h5>
                                          <h5>Ecole/Institut/Centre de Formation:<span>{{ $post->institution }}</span></h5><br>
                                          <h5>Description:</h5>
                                         <p>{{ $post->description }}</p>

                                    <span>
                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $post->id }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" id="delete-post" data-id="{{ $post->id }}" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a>
                                    </span>
                                           </div>

                                        <!-- Button trigger modal -->


                                      </div>



                                @endforeach
                             </tbody>
                            </table>
                            {{ $posts->links() }}
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
                                            <label for="name" class="col-sm-4 control-label">Titre Diplomes</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="titre_niveau" name="titre_niveau" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Option (Specialité)</label>
                                            <div class="col-sm-12">
                                                <input class="form-control" id="option" name="option" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Institution/Ecole/Centre de formation</label>
                                            <div class="col-sm-12">
                                                <input class="form-control" id="institution" name="institution" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Description</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="description" name="description" value="" required="">
                                                    </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Annee d'obtention</label>
                                            <div class="col-sm-12">
                                                <input type="month" class="form-control" id="annee" name="annee" value="" required="">
                                            </div>
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
                    <li class="active"><i data-feather="book"></i> <a>Formations</a>
                    </li>
                    </li>
                    <li ><i data-feather="feather"></i> <a href="{{route('chercheur.sommaire.index')}}">Competences</a>
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
          $('#postCrudModal').html("Ajouter une formation");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var post_id = $(this).data('id');
        $.get('Niveau/'+post_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#titre_niveau').val(data.titre_niveau);
            $('#option').val(data.option);
            $('#institution').val(data.institution);
            $('#description').val(data.description);
            $('#annee').val(data.annee);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var post_id = $(this).data("id");
          confirm("Etes-vous sur de vouloir faire cette supression ?");


                $.ajax({
              type: "DELETE",
              url: "{{ url('user/Niveau')}}"+'/'+post_id,
              success: function (data) {
                  $("#id_" + post_id).remove();
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
            url: "{{ route('chercheur.niveau.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


                var post = '<div id="id_' + data.id + '" class="education-label">'
                    +'<span class="study-year">' + data.annee + '</span><br>'+'<h5>'
                     + data.titre_niveau + ' '+' Option:'+' ' + data.option + '</h5><h5>Ecole/Institut/Centre de Formation:<span>' + data.institution+ '</span></h5><br><h5>Description:</h5>'
                     +'<p>'+data.description+'</p>';
                post += '<span><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post"><i class="fa fa-trash"></i></a></span>';
                post += '</div>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(post);
                } else {
                    $("#id_" + data.id).replaceWith(post);
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
























































