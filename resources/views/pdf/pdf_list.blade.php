@extends('welcome')

@section('content')
    <div class="text-black">
        <div class="col-lg-12 grid-margin">
            <div class="">
                <div class="card-body">
                    @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">Manage PDFs</h4>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('pdf#create') }}" class="btn"
                                style="background-color: #3798A6; padding-top:10px">+ Add</a>

                            {{-- <div >
                      <form method="GET" class="d-flex" action="{{ route('news#list') }}">

                        <input name="search" type="text" placeholder="Search news ..." class="form-control bg-secondary" value="{{ request()->input('search') }}">
                        <button type="submit" class="btn " style="background-color: #3798A6"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                      </form>
                    </div> --}}
                        </div>
                    </div>
                    {{-- <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="background-color: #3798A6; color:white"> # </th>
                                <th style="background-color: #3798A6; color:white"> Title </th>
                                <th style="background-color: #3798A6; color:white"> L </th>
                                <th style="background-color: #3798A6; color:white"> Actions </th>
                                <th style="background-color: #3798A6; color:white"> Date </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->title }}</td>
                                    <td>
                                       @if ($d->type === 'activities/calender')  activity  @else {{$d->type}} @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('news#detailPage', $d->id) }}" class="btn  "
                                            style="background-color: #3798A6 !important"><i
                                                class="fa-solid fa-eye text-white"></i>Details</a>
                                        <a href="{{ route('news#deletePage', $d->id) }}" class="btn btn-danger "><i
                                                class="fa-solid fa-circle-info text-white"></i>Delete</a>
                                    </td>
                                    <td> {{ $d->date ? $d->date : $d->updated_at }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{ $data->appends(request()->input())->links() }}

                </div> --}}
                    <div class="container">
                        <div class="row">
                            @foreach ($data as $d)
                                <div class="col-4">
                                    <div class=" shadow-sm mb-4 p-2 pb-0 ">
                                        <div class=" d-flex align-items-center justify-content-between ">
                                            <div>
                                                <h4><i class="fa-regular fa-hand-point-right me-3"></i>&nbsp; &nbsp;<span
                                                        class="ms-3">{{ $d->name }}</span></h4>

                                            </div>
                                            <div>
                                                <a href="{{ route('pdf#link_create', $d->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i></a>
                                                <a href="{{ route('pdf#delete', $d->id) }}"
                                                    class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="">
                                            @if (count($d->pdfs) > 0)
                                                <ul class="mt-2">
                                                    @foreach ($d->pdfs as $pdf)
                                                        <li class="d-flex justify-content-between align-items-center">
                                                            <a href="{{ route('pdf#view', $pdf->id) }}">
                                                                {{ $pdf->title }}</a>
                                                            <div><a href="{{route('pdf#deletePDF',$pdf->id)}}"><i class="fa-solid fa-trash text-danger"></i></a></div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>- No PDFs</p>
                                            @endif

                                        </div>


                                    </div>


                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
