@extends('welcome')

@section('content')
<style>
    .ck-editor__editable_inline:not(.ck-comment__input *) {
    height: 500px;
    overflow-y: auto;
}
</style>
    <div class="container">
        <div class="row text-black">
            <div class="col-8 offset-2">
                <div class="card-body shadow" style="background-color: #3798A6; border-radius:20px">
                    <h2 class="card-title pb-2 mb-4 text-white" style="border-bottom: 3px solid white">Add News</h2>
                    <form class="forms-sample" method="POST" action="{{ route('news#store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName1" class="text-white">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control border-0 bg-white" id="exampleInputName1" placeholder="Name"
                                name="title" value="{{ old('title') }}" style="color:black !important;">
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectGender" class="text-white">Type</label>
                            <select class="form-control border-0 bg-white" id="exampleSelectGender" name="type">
                                <option>News</option>
                                <option>Announcement</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-white">Image upload</label>
                            <input type="file" id="images" class="form-control border-0  bg-white" name="images[]" multiple>
                            @error('images[]')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1" class="text-white">Body</label>
                            <textarea id="content"  class="form-control border-0 bg-white"  rows="10" cols="10" name="body"></textarea>
                            @error('body')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn shadow  mr-2" style="background: #3798A6; border: 5px double white; color:whote">Update</button>
                        <a href="{{route('news#back')}}"><button type="button" class="btn btn-dark" style="background: white; border: 5px double#3798A6; color:#3798A6">Cancel</button></a>
                    </form>
                    {{-- @livewire('sub_news') --}}

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
    </script>

    
@endsection
