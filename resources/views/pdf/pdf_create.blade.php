@extends('welcome')

@section('content')

    <div class="container">
        <div class="row text-black">
            <div class="col-8 offset-2">
                <div class="card  bg-white" style=" border-radius:20px; border: 1px solid #3798A6; border-radius:20px">
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Create Pdf</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('pdf#store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                                    name="name" value="{{ old('name') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName3" placeholder="PDF Title"
                                    name="title" value="{{ old('title') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Path </label>
                                <input type="file" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                                    name="path" value="{{ old('path') }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('path')
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
    

    
@endsection
