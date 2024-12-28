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
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Add Collaborated Organization</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('org#store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Organization Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                                    name="name" value="{{ old('name') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Country<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName2" placeholder="Name"
                                    name="country" value="{{ old('country') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('country')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Link <span class="text-danger">*</span></label>
                                <input type="url" class="form-control  bg-white" id="exampleInputName2" placeholder="https://example.com"
                                    name="link" value="{{ old('link') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('link')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                          
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:white">Add</button>
                            <a href="{{route('org#list')}}"><button type="button" class="btn " style="background: white;  color:#3798A6">Cancel</button></a>
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
