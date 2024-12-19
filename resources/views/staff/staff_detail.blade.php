@extends('welcome')

@section('content')

            <div class="text-dark">
                <h2 class='mb-3'>{{$data->name}}</h2>
                <h4 class='mb-3'>{{$data->email}}</h4>
                <h4 class='mb-3'>{{$data->department}}</h4>
                <h4 class='mb-3'>{{$data->position}}</h4>
                <hr>
                <h6 class="mb-3">Biography</h6>
                <p>{{ $data->biography }}</p>
                <hr>
                <h6 class="mb-3">Educaion</h6>
                @foreach ($education as $e)
                    <h5>{{$e}}</h5>
                @endforeach
                
                <hr>

                <h6 class="mb-3">Research interests</h6>
                @foreach ($interests as $i)
                    <h5>{{$i}}</h5>
                @endforeach
                
                <hr>

                <h6 class="mb-3">Courses taught</h6>
                @foreach ($courses as $c)
                    <h5>{{$c}}</h5>
                @endforeach
                
                <hr>
                


                @if ($data->image)
                            <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid" alt="Staff Image">
                @endif
 

                <a href="{{route('staff#edit',$data->id)}}" class="btn btn-dark p-3 mt-3">Edit Staff</a>
            </div>
@endsection