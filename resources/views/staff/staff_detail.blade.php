@extends('welcome')

@section('content')

            <div class="text-dark">
                <h2 class='mb-3'>{{$data->name}}</h2>
                <h4 class='mb-3'>{{$data->position}}</h4>
                <hr>
                <h6 class="mb-3">Biography</h6>
                <p>{{ $data->biography }}</p>
                <hr>
                <h6 class="mb-3">Educaion</h6>
                <h5>{{ $data->education }}</h5>
                <div class="d-flex justify-content-between mb-3">
                
                </div>
                <hr>
                
                   
                   
                {{-- <div class="d-flex flex-wrap">
                    @foreach ($data->images as $image)
                    <div class="w-50 p-2 border-white " >
                        <img src="{{asset('/storage/'.$image->name)}}" 
                        class="w-100 h" style="height: 300px;width:300px" alt="">
                        {{'storage/' . $image->name}}
                    </div>
                    @endforeach
                   
                </div> --}}


                {{-- <div class="d-flex flex-wrap">
                @if ($data->image)
                            <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid" alt="Staff Image">
                @endif
            </div> --}}
 

                <a href="{{route('staff#edit',$data->id)}}" class="btn btn-dark p-3 mt-3">Edit Staff</a>
            </div>
@endsection