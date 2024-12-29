@extends('welcome')

@section('content')
<style>
    .ck-editor__editable_inline:not(.ck-comment__input *) {
    height: 250px;
    overflow-y: auto;
}
</style>
    <div class="container">
        <div class="row text-black">
            <div class="col-8 offset-2">
                <div class="card  bg-white" style=" border-radius:20px; border: 1px solid #3798A6; border-radius:20px">
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Manage Uit's About</h2>
                    <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                       <h2>Manage Uit Timeline</h2>
                        <form class="forms-sample" method="POST" action="{{ route('store#timeline') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control  bg-white" id="exampleInputName1" placeholder=""
                                    name="date" value="{{ old('date') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleTextarea1" class="text-white">Title</label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder=""
                                    name="title" value="{{ old('title') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:whote">Add To Timeline</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  View Timelines
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Uit's Timeline</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       @foreach($timelines as $t)
        <div class="text-white border mb-1">
        <span class="p-1 rounded-lg bg-danger mb-2">{{$t->date}}</span>
        <div class="mt-2">{{$t->title}}</div>
        </div>
       @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                        </form>
<hr class="my-5">
                    @if (session('historysuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('historysuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        <h2>Manage Uit's History, Visions, Missions and Values</h2>
                        @if(!$hvmv)
                        <form class="forms-sample" method="POST" action="{{ route('store#vision#mission') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="mt-2">History</div>
                                <textarea id="content"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="history"></textarea>
                                @error('history')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Vision</div>
                                <textarea id="content1"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="vision"></textarea>
                                @error('vision')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Missions</div>
                                <textarea id="content2"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="mission"></textarea>
                                @error('mission')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Values</div>
                                <textarea id="content3"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="value"></textarea>
                                @error('value')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:whote">Add</button>
                            
                        </form>
                        @endif

                        @if($hvmv)
                        <form class="forms-sample" method="POST" action="{{ route('update#vision#mission') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$hvmv[0]->id}}">
                            <div class="form-group">
                                <div class="mt-2">History</div>
                                <textarea id="content"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="history">
                                    {{$hvmv[0]->history}}
                                </textarea>
                                @error('history')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Vision</div>
                                <textarea id="content1"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="vision">
                                    {{$hvmv[0]->vision}}
                                </textarea>
                                @error('vision')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Missions</div>
                                <textarea id="content2"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="mission">
                                    {{$hvmv[0]->mission}}
                                </textarea>
                                @error('mission')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                            <div class="mt-2">Values</div>
                                <textarea id="content3"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="value">
                                    {{$hvmv[0]->value}}
                                </textarea>
                                @error('value')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:whote">Update</button>
                            
                        </form>
                        @endif

                       
                    </div>
                  


                </div>
            </div>
        </div>
    </div>
    {{-- @livewireScripts --}}
    <script>
        ClassicEditor.create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
            ClassicEditor.create( document.querySelector( '#content1' ) )
            .catch( error => {
                console.error( error );
            } );
            ClassicEditor.create( document.querySelector( '#content2' ) )
            .catch( error => {
                console.error( error );
            } );
            ClassicEditor.create( document.querySelector( '#content3' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    
@endsection
