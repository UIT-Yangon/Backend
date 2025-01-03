@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 px-0 mb-3 d-flex justify-content-between">
                <h3 class="text-black"> {{ $conference[0]->name }}</h3>
                <div class="border d-flex justify-content-center align-items-center " style="border-radius: 2px;background-color:#3798A6">
                <a href="{{route("conf#editPage",$conference[0]->id)}}" class=" ms-0 btn btn-sm text-white">Edit</a>
                </div>
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

                    <tr style="border-bottom: 2px solid white">
                        <td>IEEE publication link</td>
                        <td>:</td>

                        <td class="text-white " style="background-color: #3798A6; cursor:pointer"><link href='{{$conference[0]->ieee_link}}'>{{$conference[0]->ieee_link}}</link></td>
                    </tr>


                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <h3 class="text-dark m-3 mb-0"><u>Topics</u></h3>
                <ul class="mt-0 bg-light">
                @if(isset($conference[0]->topics) )
                    
                                    @foreach ($conference[0]->topics as $topic)
                                        <li class="text-dark ">{{ $topic }}</li>
                                    @endforeach
                @endif
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                @if ($chair['general_chair']!= null)
                <div>
                    <h4 class="" style="color:#3798A6">General Chair : </h4>
                    <li class="text-black">{{$chair['general_chair']->rank}} {{$chair['general_chair']->name}}, {{$chair['general_chair']->position}}, {{$chair['general_chair']->university}}, {{$chair['general_chair']->nation}}
                        <a href="{{route("conf#deleteMember",$chair['general_chair']->id)}}" class="btn  btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                        <a href="{{route("conf#editMemberPage",$chair['general_chair']->id)}}" class=" ms-0 btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                    
                    </li>
                </div>
                @endif
                @if ($chair['general_co_chair']!= null)
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">General Co-Chair : </h4>
                    <li class="text-black">{{$chair['general_co_chair']->rank}} {{$chair['general_co_chair']->name}}, {{$chair['general_co_chair']->position}}, {{$chair['general_co_chair']->university}}, {{$chair['general_co_chair']->nation}}
                        <a href="{{route("conf#deleteMember",$chair['general_co_chair']->id)}}" class="btn  btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                        <a href="{{route("conf#editMemberPage",$chair['general_co_chair']->id)}}" class=" ms-0 btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                    
                    </li>
                </div>
                @endif
                @if ($chair['program_chair']!= null)
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">Program Chair : </h4>
                    <li class="text-black">{{$chair['program_chair']->rank}} {{$chair['program_chair']->name}}, {{$chair['program_chair']->position}}, {{$chair['program_chair']->university}}, {{$chair['program_chair']->nation}}
                        <a href="{{route("conf#deleteMember",$chair['program_chair']->id)}}" class="btn  btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                        <a href="{{route("conf#editMemberPage",$chair['program_chair']->id)}}" class=" ms-0 btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                    
                    </li>
                </div>
                @endif
                @if ($keynote)
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">Keynote Speaker </h4>
                    @foreach ($keynote as $k)
                    
                    <li class="text-dark">{{$k->rank}} {{$k->name}}, {{$k->position}}, {{$k->university}}, {{$k->nation}}<a href="{{route("conf#deleteMember",$k->id)}}" class="btn  btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                        <a href="{{route("conf#editMemberPage",$k->id)}}" class=" ms-0 btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                    </li>
                     
                    @endforeach
                </div>
                @endif
                @if ($invited)
                <div class="mt-4">
                    <h4 class="" style="color:#3798A6">Invited Speaker </h4>
                    @foreach ($invited as $i)
                    <li class="text-black">{{$i->rank}} {{$i->name}}, {{$i->position}}, {{$i->university}}, {{$i->nation}}
                    <a href="{{route("conf#deleteMember",$i->id)}}" class="btn  btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                        <a href="{{route("conf#editMemberPage",$i->id)}}" class=" ms-0 btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                    </li>
                    @endforeach
                </div>
                @endif
                
                <a href="{{route('conf#commiteePage',[$conference[0]->id, 'organizing'])}}" class="btn mt-3" style="background-color: #3798A6">Organizing committee</a>
                <a href="{{route('conf#commiteePage',[$conference[0]->id, 'program'])}}" class="btn mt-3" style="background-color: #3798A6">Program committee</a>
                <a href="{{route('conf#sponsorPage',$conference[0]->id)}}" class="btn mt-3" style="background-color: #3798A6">Sponsors</a>
            </div>
        </div>
    </div>


    


    <div class="d-flex justify-content-between align-items-center mt-5">
        <h2 class="text-dark ">Images Used</h2>
        <button type="button"  class="btn btn-primary" id = "toggleFileInputBtn">Add image</button>
    </div>
    <div class="container " id = "fileInput" style="display: none;">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{route('conf#addImage',$conference[0]->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image"  class="form-control bg-white text-dark"  style=" border: 1px solid #3798A6">
                    <button class="btn mt-3" style="background-color: #3798A6">Add</button>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap gap-3 justify-content-center w-full">
        @if ($images)
        @foreach ($images as $i)
        {{-- <h2 class="text-dark">{{$i}}</h2> --}}
           <div class="relative con" style="position:relative;max-width:500px">
            <img style="width:100%;" src="{{asset('storage/conference_images/' . $i)}}" alt="">
            <a href='{{route('conf#deleteImg',[$conference[0]->id,$i])}}' class="bg-danger p-2 m-3 text-decoration-none top-0 deleteBtn" style="position:absolute; top:0;right:0;color:white;cursor:pointer;">Delete</a>
           </div>
        @endforeach
    @endif
    </div>
    <script>
        document.getElementById('toggleFileInputBtn').addEventListener('click', function() {
        const fileInput = document.getElementById('fileInput');
        const button = document.getElementById('toggleFileInputBtn');

        console.log(fileInput);
        if (fileInput.style.display === 'none' || fileInput.style.display === '') {
            fileInput.style.display = 'block';
            button.textContent = 'Close';

        } else {
            fileInput.style.display = 'none';
            button.textContent = 'Add image';

        }
    });
    </script>
    
    
@endsection
