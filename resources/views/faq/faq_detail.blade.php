@extends('welcome')

@section('content')

            <div class="text-dark">
                <h3 class='mb-3'>{{$faq->question}}</h3>
                <p>{!! nl2br(htmlentities($faq->answer)) !!}</p>
                <hr>

                <a href="{{route('faq#edit',$faq->id)}}" class="btn btn-dark p-3 mt-3">Edit Faq</a>
            </div>
@endsection