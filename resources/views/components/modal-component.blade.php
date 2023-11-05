{{-- <div class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$idTitle}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-success" data-bs-theme="dark">
                <h1 class="modal-title fs-5 " id="{{$idTitle}}">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{$formAction}}" method="POST">
                @csrf   
                @method($method)
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<div class="modal fade" id="{{$id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$idTitle}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header {{$classHeader}}" > 
          <h1 class="modal-title fs-5" id="{{$idTitle}}">{{$title}}</h1>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white"></button> --}}
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form method="post" action="{{$formAction}}" enctype="multipart/form-data">
            @csrf
            @method($method)
        <div class="modal-body">
              {{$slot}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form> 
      </div>
    </div>
  </div>