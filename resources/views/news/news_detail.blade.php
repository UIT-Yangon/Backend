@extends('welcome')

@section('content')

            <div class="text-dark">
                <h2 class='mb-3'>{{$data->title}}</h2>
                <h4 class='mb-3'>{{$data->type}}</h4>
                <div class="d-flex justify-content-between mb-3">
                    <div>John Doe</div>
                    <div class=" text-white p-1 rounded-3" style="background-color: #3798A6">{{$data->created_at->format('j F Y')}}</div>
                </div>
                <hr>
                <p>
                   {{$data->body}}
                <div class="d-flex flex-wrap">
                    @foreach ($data->images as $image)
                    <div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="{{ asset('storage/' . $image->name) }}" 
                        class="w-100 h-100" alt="">
                    </div>
                    @endforeach
                   
                </div>

                <a href="{{route('news#editPage',3)}}" class="btn btn-dark p-3 mt-3">Edit News</a>
            </div>
@endsection