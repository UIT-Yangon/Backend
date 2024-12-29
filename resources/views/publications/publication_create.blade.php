@extends('welcome')

@section('content')

    <div class="container">
        <div class="row text-black">
            <div class="col-8 offset-2">
                <div class="card  bg-white" style=" border-radius:20px; border: 1px solid #3798A6; border-radius:20px">
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Add Lab Publication</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('publication#store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Publication Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Title"
                                    name="title" value="" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Publication Link <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName2" placeholder="Link"
                                    name="link" value="" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('link')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Lab <span class="text-danger">*</span></label>
                                <select name="lab" class="form-control bg-white" style="color:black !important; border:1px solid #3798A6 !important; ">
                                    <option value="klab">KLab</option>
                                    <option value="hardwarelab">Hardware Lab</option>
                                </select>
                                
                            </div>
                        
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Publication Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control  bg-white" id="exampleInputName2" placeholder="date"
                                    name="date" value="" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn shadow  mr-2" style="background: #3798A6;  color:white">Add</button>
                           
                        </form>
                    </div>
                  
         

                </div>
            </div>
        </div>
    </div>
  
    
@endsection
