@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <a href="{{ route('conf#detailPage', $id) }}" class="btn mb-3 btn-sm" style="background-color: #3798A6">Back</a>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <p class="text-danger mb-0">@if(session('member')->rank){{session('member')->rank}}@endif . {{session('member')->name}},@if(session('member')->postion) {{session('member')->position}}@endif, {{session('member')->university}}, {{session('member')->nation}}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                <form action="{{ route('conf#commiteePage', [$id, $type]) }}" method="get" class="mb-3">
                    @csrf
                    <div class="d-flex w-50">
                        <input type="text" class="form-control form-control-sm bg-white w-100 text-black"
                            style="border: 1px sodivd #3798A6" placeholder="Search..." name="search">
                        <button class="btn" style="background-color: #3798A6">Search</button>
                    </div>

                </form>
                <h3 class="text-dark">
                    <u>{{ ucFirst($type) }} Committee</u>
                </h3>
                @if (count($members) > 0)
                    @foreach ($members as $member)
                        {{-- <h1 class="text-danger">{{$member->id}}</h1> --}}
                        @if($member->position && $member->rank)
                        <div class="text-dark ">
                            <div class="d-flex justify-content-between">
                                <div>{{ $member->rank }}, {{ $member->name }}, {{ $member->position }},
                                    {{ $member->university }}, {{ $member->nation }}</div>
                                <div> <a href="{{route("conf#deleteMember",$member->id)}}" class="btn btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                                    <a href="{{route("conf#editMemberPage",$member->id)}}" class="btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                                </div>
                            </div>

                        </div>
                        @elseif (!$member->rank)
                            <div class="text-dark ">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $member->name }}, {{ $member->position }}, {{ $member->university }},
                                        {{ $member->nation }}</div>
                                    <div> 
                                        <a href="{{route("conf#deleteMember",$member->id)}}" class="btn btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                                        <a href="{{route("conf#editMemberPage",$member->id)}}" class="btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                                    </div>
                                </div>

                            </div>
                        @elseif(!$member->position)
                            <div class="text-dark ">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $member->rank }}, {{ $member->name }}, {{ $member->university }},
                                        {{ $member->nation }}</div>
                                    <div><a href="{{route("conf#deleteMember",$member->id)}}" class="btn btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                                        <a href="{{route("conf#editMemberPage",$member->id)}}" class="btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                                    </div>

                                </div>

                            </div>
                        @elseif(!$member->position && !$member->rank)
                            <div class="text-dark ">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $member->name }}, {{ $member->university }}, {{ $member->nation }}</div>
                                    <div><a href="{{route("conf#deleteMember",$member->id)}}" class="btn btn-sm text-danger"><i class="fa-solid fa-eraser"></i></a>
                                        <a href="{{route("conf#editMemberPage",$member->id)}}" class="btn btn-sm text-warning"><i class="fa-solid fa-pencil"></i></a>
                                    </div>
                                </div>

                            </div>
                       
                            
                        @endif
                        
                    @endforeach
                @else
                    <p class="text-dark">No member found</p>
                @endif

            </div>
        </div>
    </div>
@endsection
