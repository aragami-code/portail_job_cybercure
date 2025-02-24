@extends('backend.layouts.masterL')


@section('title')

TABLEAU DE BORD
@endsection


@section('admin-content')


<div class="manage-job-container">
    @include('backend.layouts.partials.messages')
    @if(Auth::guard('admin')->user()->can('Post_Emploi.create'))
    <p class="float-right">
    <a class="btn btn-primary text-white" href="{{ route('admin.postemplois.create')}}">Ajouter une Offre d'Emploi</a>
    </p>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th>Deadline</th>
          <th>Status</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
           @foreach ($PostEmplois as $PostEmploi)


           <tr class="job-items">
        <td>{{$loop->index+1}}</td>
          <td class="title">
            <h5><a href="#">{{$PostEmploi->titre_post_emploi}}</a></h5>
            <div class="info">
              <span class="office-location"><a href="#"><i data-feather="map-pin"></i>New Orleans</a></span>
              <span class="job-type full-time"><a href="#"><i data-feather="clock"></i>Full Time</a></span>
            </div>
          </td>






            <td class="action">

                @if(Auth::guard('admin')->user()->can('Post_Emploi.edit'))
                 {{----}}<a class="edit" href="{{ route('admin.postemplois.edit', $PostEmploi->id)}}" ><i data-feather="edit"></i> Modifier </a>

                @endif

                @if(Auth::guard('admin')->user()->can('Post_Emploi.delete'))
                {{----}}
                <a class="remove" href="{{ route('admin.postemplois.destroy', $PostEmploi->id) }}"
                    onclick="event.preventDefault(); document.getElementById('delete-form-{{$PostEmploi->id}}').submit();">
                     <i data-feather="trash-2"></i>Supprimer
                </a>

                <form id="delete-form-{{$PostEmploi->id}}" action="{{ route('admin.postemplois.destroy', $PostEmploi->id) }}" method="POST" style="display: none;">
                    @method('DELETE')
                     @csrf
                 </form>

                @endif


            </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>


</div>





@endsection




