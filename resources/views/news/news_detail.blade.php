@extends('welcome')

@section('content')

            <div class="text-dark">
                <h2 class='mb-3'>{{$data->title}}</h2>
                <h4 class='mb-3'>{{$data->type}}</h4>
                <div class="d-flex justify-content-between mb-3">
                    <div>John Doe</div>
                    @if($data->created_at)
                    <div class=" text-white p-1 rounded-3" style="background-color: #3798A6">{{$data->created_at->format('j F Y')}}</div>
                    @endif
                </div>
                <hr>
                <p>
                   {!! $data->body !!}
                </p>
                   
                   
                {{-- <div class="d-flex flex-wrap">
                    @foreach ($data->images as $image)
                    <div class="w-50 p-2 border-white " >
                        <img src="{{asset('/storage/'.$image->name)}}" 
                        class="w-100 h" style="height: 300px;width:300px" alt="">
                        {{'storage/' . $image->name}}
                    </div>
                    @endforeach
                   
                </div> --}}

                <a href="{{route('news#editPage',$data->id)}}" class="btn btn-dark p-3 mt-3">Edit News</a>
            </div>
@endsection