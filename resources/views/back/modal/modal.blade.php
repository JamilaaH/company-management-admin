<!-- Modal -->
<div class="modal fade" id="exampleModal{{$tache->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$tache->entreprise->nom}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card card-primary">
            <div class="card-body">
              <p>{{$tache->text}}</p>
              <p> Fait le {{$tache->updated_at->format('d/m/Y')}} à {{$tache->updated_at->format('H:i')}}</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          @if ($tache->etat  == 0)
            <a href="{{route('tache.edit', $tache->id)}}" class="btn btn-primary">Edit</a>
          @endif        
        </div>
      </div>
    </div>
  </div>