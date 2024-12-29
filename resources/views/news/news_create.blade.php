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
                <div class="card  bg-white" style=" border-radius:20px; border: 1px solid #3798A6; border-radius:20px">
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Add News</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('news#store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                                    name="title" value="{{ old('title') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender" class="text-black">Type</label>
                                <select class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  id="exampleSelectGender" name="type">
                                    <option value="news">News</option>
                                    <option value="activities">Activity</option>
                                    <option value="activities/calender">Activity/Calender</option>

                                    <option value="announcement">Announcement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-black">Image upload</label>
                                <input type="file" id="images" class="form-control   bg-white" style="color:black !important; border:1px solid #3798A6 !important; " name="images[]" multiple>
                                @error('images[]')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Date <span class="text-danger"></span></label>
                                <input type="date" class="form-control  bg-white" id="exampleInputName1" placeholder="date"
                                    name="date" value="{{ old('date') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1" class="text-white">Body</label>
                                <textarea id="content"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="body"></textarea>
                                @error('body')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:whote">Add</button>
                            <a href="{{route('news#back')}}"><button type="button" class="btn " style="background: white;  color:#3798A6">Cancel</button></a>
                        </form>
                    </div>
                  
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
