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
                    <h4 class="card-title">Edit Staff</h4>
                    <form class="forms-sample" method="post" action="{{route('staff#update' , $data->id)}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1" class="text-black">Name</label>
                        <input type="text" class="form-control bg-white text-dark" name='name' id="exampleInputName1" value="{{$data->name}}" placeholder="Name">
                        <input type="hidden" class="form-control bg-white text-dark" name='id' id="exampleInputName1" value="{{$data->id}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName2" class="text-black">Position</label>
                        <input type="text" class="form-control  bg-white text-dark" name='position' id="exampleInputName2" value="{{$data->position}}"  placeholder="Position">
                      </div>

                      {{-- <div class="w-100 border-white " >
                      @foreach ($data->image as $img)
                        <div class="w-100 py-2 border-white icontainer" >
                            <img src="{{asset('/storage/'.$img->name)}}" 
                            class="w-100" style='height:300px' alt="">
                           
                            <a href="{{route('staff#deleteImage',$image->id)}}" class="dbtn"> <i class="fa-solid fa-trash"></i>&nbsp;Delete </a>
                        </div>
                    @endforeach
                    </div> --}}

                    <div class="form-group">
                      <label class="text-black">Image upload</label>
                      <input type="file" id="images" class="form-control   bg-white" style="color:black !important; border:1px solid #3798A6 !important; " name="images[]" multiple>
                      @error('images[]')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1" class="text-black">Biography</label>
                    <textarea class="form-control bg-white" id="exampleTextarea1" rows="4" placeholder="Biography"
                        name="biography" style="color:black !important; border:1px solid #3798A6 !important;">{{$data->biography}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputName3" class="text-black">Education </label>
                    <input type="text" class="form-control  bg-white" id="exampleInputName3" placeholder="Education"
                        name="education" value="{{$data->education}}" style="color:black !important; border:1px solid #3798A6 !important; ">
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