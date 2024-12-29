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
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                        @if(!$requirements)
                        <form class="forms-sample" method="POST" action="{{ route('admission#requirement#store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">The Annual Student Intake <span class="text-danger">*</span></label>
                                <input type="number" class="form-control  bg-white" id="exampleInputName1" placeholder=""
                                    name="student_intake" value="{{ old('student_intake') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('student_intake')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleTextarea1" class="text-white">Admission Requirement Details</label>
                                <textarea id="content"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="requirements"></textarea>
                                @error('body')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:whote">Add</button>
                            
                        </form>
                        @endif

                        @if($requirements)
                        <form class="forms-sample" method="POST" action="{{ route('admission#requirement#update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value='{{$requirements->id}}'>
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">The Annual Student Intake <span class="text-danger">*</span></label>
                                <input type="number" class="form-control  bg-white" id="exampleInputName1" placeholder=""
                                    name="student_intake" value="{{$requirements->student_intake}}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('student_intake')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleTextarea1" class="text-white">Admission Requirement Details</label>
                                <textarea id="content"  class="form-control  bg-white" style="color:black !important; border:1px solid #3798A6 !important; "  rows="10" cols="10" name="requirements">
                                    {{$requirements->requirements}}
                                </textarea>
                                @error('body')
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
    </script>

    
@endsection
