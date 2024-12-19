@extends('welcome')

@section('content')

    <div class="container">
    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
        @endif
        <div class="row text-black">
            <div class="col-6">
                @foreach($publications as $p)
                    <div class=" bg-white shadow-md px-2 py-3 my-1"  style="border: 1px solid #3798A6; border-radius:5px">
                        <div  class="d-flex justify-content-end my-2">
                            <a href="{{route('staff#publications#delete',['id'=>$p->id, 'staffId'=>$p->staff_id])}}"
                            onclick="return confirm('Are you sure you want to delete this publication?')"
                            >
                            <i
                            class="fa-solid fa-trash text-danger border p-2  " style="border-radius: 50%;"></i>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>{{$p->title}}</div>
                            <div>{{$p->date}}</div>
                        </div>
                        <div>{{$p->description}}</div>
                    </div>
                @endforeach
            </div>
            <div class="col-6">
                <div class="card  bg-white" style=" border-radius:20px; border: 1px solid #3798A6; border-radius:20px">
                    <h2 class="card-header pb-2 mb-4 text-center p-3" style="border-bottom: 3px solid white; color:#3798A6; border-radius:20px">Add Lab Publication</h2>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('staff#storePublication') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1" class="text-black">Publication Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Title"
                                    name="title" value="" style="color:black !important; border:1px solid #3798A6 !important; ">
                                    <input type="hidden" class="form-control  bg-white" id="exampleInputName1" placeholder="Title"
                                    name="staff_id" value="{{$id}}" style="color:black !important; border:1px solid #3798A6 !important; ">
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="text-black">Publication Description <span class="text-danger">*</span></label>
                                <textarea class="form-control  bg-white" id="exampleInputName2" placeholder="Link"
                                    name="description" style="color:black !important; border:1px solid #3798A6 !important; ">
                                </textarea>
                                @error('link')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
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
