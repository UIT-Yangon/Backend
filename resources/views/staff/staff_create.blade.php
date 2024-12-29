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
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Add Staff</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('staff#store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                                    name="name" value="{{ old('name') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Uit Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName2" placeholder="Name"
                                    name="email" value="{{ old('email') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName2" placeholder="Position"
                                    name="position" value="{{ old('position') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('position')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-black">Department <span class="text-danger">*</span></label>
                                <select name="department" value="{{ old('department') }}" id="" class="form-control bg-white" style="color:black !important; border:1px solid #3798A6 !important; ">
                                    <option value="Faculty of Computer Science">Faculty of Computer Science</option>
                                </select>
                              
                                @error('department')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea10">Biography <span class="text-danger">*</span></label>
                                <textarea class="form-control bg-white" id="exampleTextarea10" rows="4" placeholder="Biography"
                                name="biography" value="{{ old('biography') }}" style="color:black !important; border:1px solid #3798A6 !important; "></textarea>
                                @error('biography')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName11" class="text-black">Education <span class="text-danger">*</span></label>
                                <textarea class="form-control bg-white" id="exampleTextarea11" rows="4" placeholder=""
                                name="education" value="{{ old('education') }}" style="color:black !important; border:1px solid #3798A6 !important; "></textarea>
                                @error('education')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-black">Image upload</label>
                                <input type="file" id="images" class="form-control   bg-white" style="color:black !important; border:1px solid #3798A6 !important; " name="image">
                                @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea12">Course taught <span class="text-danger">*</span></label>
                                <textarea class="form-control bg-white" id="exampleTextarea12" rows="4" placeholder="Course taught"
                                name="courseTaught" value="{{ old('courseTaught') }}" style="color:black !important; border:1px solid #3798A6 !important; "></textarea>
                                @error('courseTaught')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea10">Research interests <span class="text-danger">*</span></label>
                                <textarea class="form-control bg-white" id="exampleTextarea10" rows="4" placeholder="Research interests"
                                name="researchInterest" value="{{ old('researchInterest') }}" style="color:black !important; border:1px solid #3798A6 !important; "></textarea>
                                @error('researchInterest')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:white">Add</button>
                            <a href="{{route('staff#back')}}"><button type="button" class="btn " style="background: white;  color:#3798A6">Cancel</button></a>
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
