@extends('welcome')

@section('content')
<div class="">
                <div class="text-black">
                  <div class="card-body">
                    <h4 class="card-title">Edit News</h4>
                    <form class="forms-sample" method="post" action="{{route('news#update')}}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control bg-white text-dark" name='title' id="exampleInputName1" value="{{$data->title}}" placeholder="Name">
                        <input type="hidden" class="form-control bg-white text-dark" name='user_id' id="exampleInputName1" value="{{$data->user_id}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Type</label>
                        <select class="form-control border bg-white" name='type' id="exampleSelectGender">
                          <option value="News"  {{$data->type=='News' ? 'selected' : ''}}>News</option>
                          <option value="Announcement" {{$data->type=='Announcement' ? 'selected' : ''}} >Announcement</option>
                        </select>
                      </div>

                      <div class="w-50 p-2 border-white " >
                      @foreach ($data->images as $image)
                        <div class="w-50 p-2 border-white icontainer" >
                            <img src="{{asset('/storage/'.$image->name)}}" 
                            class="w-100 h" style="height: 300px;width:300px" alt="">
                           
                            <a href="{{route('news#deleteImage',$image->id)}}" class="dbtn"> Delete </a>
                        </div>
                    @endforeach
                    </div>

                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="images[]" class="form-control bg-white" id="">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Body</label>
                        <textarea id="content"  class="form-control border-0 bg-white"  rows="30" cols="10" name="body">

                        {!! $data->body !!}
                        </textarea>
                           
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <button class="btn btn-dark" type='reset'>Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              {{-- @livewireScripts --}}
    <script>
        ClassicEditor.create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    
@endsection