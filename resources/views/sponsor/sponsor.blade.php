@extends('welcome')
@section('content')
    <div class="container text-dark">
    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
        @endif
        <form action="{{route('store#sponsor')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="conf_id" value="{{$id}}">
            <div class="d-flex items-center" style="">
            <div class="ms-3">
            <div>Sponsor image</div>
            <input type="file" name="image" id="" class="form-control p-2 bg-secondary">
            </div>
            <div class="ms-3">
            <div>Link</div>
            <input type="text" name="link" id="" class="border p-2 form-control bg-white" style="width:300px">
            </div class="ms-3">
            <div>
                <div>.</div>
                <button type="submit" class="btn ms-5" style="background-color: #3798A6;width:200px;padding:10px">Submit</button>
            </div>
            </div>
            <hr>
            <div class="mt-5 d-flex flex-wrap justify-content-between gap-1">
                @foreach($sponsors as $s)
                <div class="w-25" style="height:250px">
                    <div class="w-100 h-75 " style="position:relative">
                        <img src="{{asset('/storage/'.$s->image)}}" class="w-100 h-100" alt="">
                        <div class=" top-0" style="position:absolute">
                            <a href="{{route('sponsor#delete',$s->id)}}" class="bg-danger text-white p-2">Delete</a>
                        </div>
                    </div>
                    <div class="h-25">
                        <a href="{{$s->link}}">{{$s->link}}</a>
                    </div>

                </div>
                @endforeach
                

               
            </div>
            
           
        </form>
    </div>
@endsection

