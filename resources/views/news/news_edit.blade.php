@extends('welcome')

@section('content')
<style>
  .ck-editor__editable_inline:not(.ck-comment__input *) {
  height: 500px;
  overflow-y: auto;
}
</style>
<div class="container w-50 flex justify-content-center align-items-center" style="border:1px solid black;border-radius:5px">
                <div class="text-black">
                  <div class="card-body">
                    <h4 class="card-title">Edit News</h4>
                    <form class="forms-sample" method="post" action="{{route('news#update')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control bg-white text-dark" name='title' id="exampleInputName1" value="{{$data->title}}" placeholder="Name">
                        <input type="hidden" class="form-control bg-white text-dark" name='id' id="exampleInputName1" value="{{$data->id}}" >
                        <input type="hidden" class="form-control bg-white text-dark" name='user_id' id="exampleInputName1" value="{{$data->user_id}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Type</label>
                        <select class="form-control border bg-white" name='type' id="exampleSelectGender">
                          <option value="news"  {{$data->type=='news' ? 'selected' : ''}}>News</option>
                          <option value="activities"  {{$data->type=='activities' ? 'selected' : ''}}>Activity</option>
                          <option value="activities/calender"  {{$data->type=='activities/calender' ? 'selected' : ''}}>Activity/calender</option>
                          <option value="announcement" {{$data->type=='Announcement' ? 'selected' : ''}} >Announcement</option>
                        </select>
                      </div>

                      <div class="w-100 border-white " >
                      @foreach ($data->images as $image)
                        <div class="w-100 py-2 border-white icontainer" >
                            <img src="{{asset('/storage/'.$image->name)}}" 
                            class="w-100" style='height:300px' alt="">
                           
                            <a href="{{route('news#deleteImage',$image->id)}}" class="dbtn"> <i class="fa-solid fa-trash"></i>&nbsp;Delete </a>
                        </div>
                    @endforeach
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1" class="text-black">Date <span class="text-danger"></span></label>
                      <input type="date" class="form-control  bg-white" id="exampleInputName1" placeholder="date" value={{$data->date}}
                          name="date"  style="color:black !important; border:1px solid #3798A6 !important; ">
                      @error('date')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                    <div class="form-group">
                      <label class="text-black">Image upload</label>
                      <input type="file" id="images" class="form-control   bg-white" style="color:black !important; border:1px solid #3798A6 !important; " name="images[]" multiple>
                      @error('images[]')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
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