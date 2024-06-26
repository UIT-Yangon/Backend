@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 px-0">
                <h3 class="text-black"> {{ $conference[0]->name }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2 p-0 px-1" style="border:3px solid #3798A6">
                <table style="color:black;" class=" table table-borderless">
                    <tr style="border-bottom: 2px solid white; border-top: 4px solid white;">
                        <td>ID</td>
                        <td>:</td>
                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->id }}</td>
                    </tr>

                    <tr style="border-bottom: 2px solid white">
                        <td>Status</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->status }}</td>
                    </tr>

                    <tr style="border-bottom: 2px solid white">
                        <td>Accept Notification</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->accept_noti }}</td>
                    </tr>
                    <tr style="border-bottom: 2px solid white">
                        <td>Email</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->email }}</td>
                    </tr>
                    <tr style="border-bottom: 2px solid white">
                        <td>Local Fee</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->local_fee }} MMKS</td>
                    </tr>
                    <tr style="border-bottom: 2px solid white">
                        <td>Foreign Fee</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->foreign_fee }} USD</td>
                    </tr>
                    <tr style="border-bottom: 4px solid white">
                        <td>Conference Date</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6">{{ $conference[0]->conference_date }}</td>
                    </tr>


                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <h3 class="text-dark m-3 mb-0"><u>Topics</u></h3>
                <ul class="mt-0 bg-light">

                    @foreach ($conference[0]->topics as $topic)
                        <li class="text-dark ">{{ $topic }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <div>
                    <h4 class="" style="color:#3798A6">General Chair : </h4>
                    <li class="text-black">{{$chair['general_chair']->rank}}. {{$chair['general_chair']->name}}, {{$chair['general_chair']->position}}, {{$chair['general_chair']->university}}, {{$chair['general_chair']->nation}}</li>
                </div>
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">General Co-Chair : </h4>
                    <li class="text-black">{{$chair['general_co_chair']->rank}}. {{$chair['general_co_chair']->name}}, {{$chair['general_co_chair']->position}}, {{$chair['general_co_chair']->university}}, {{$chair['general_co_chair']->nation}}</li>
                </div>
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">Program Chair : </h4>
                    <li class="text-black">{{$chair['program_chair']->rank}}. {{$chair['program_chair']->name}}, {{$chair['program_chair']->position}}, {{$chair['program_chair']->university}}, {{$chair['program_chair']->nation}}</li>
                </div>
                <a href="{{route('conf#commiteePage',[$conference[0]->id, 'organizing'])}}" class="btn mt-3" style="background-color: #3798A6">Organizing committee</a>
                <a href="{{route('conf#commiteePage',[$conference[0]->id, 'program'])}}" class="btn mt-3" style="background-color: #3798A6">Program committee</a>

            </div>
        </div>
    </div>


    


    <h2 class="text-dark mt-5">Images Used</h2>
    @if ($images)
        @foreach ($images as $i)
        {{-- <h2 class="text-dark">{{$i}}</h2> --}}
           <img style="max-width: 500px" src="{{asset('storage/conference_images/' . $i)}}" alt="">
        @endforeach
    @endif
@endsection
