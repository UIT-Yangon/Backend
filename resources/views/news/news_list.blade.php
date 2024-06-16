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
                        <h4 class="card-title">Manage News</h4>

                        <div class="d-flex justify-content-between">

                          <a href="{{route('news#create')}}" class="btn" style="background-color: #3798A6; padding-top:10px">+ Add</a>

                        <div >
                          <form method="GET" class="d-flex" action="{{ route('news#list') }}">

                            <input name="search" type="text" placeholder="Search news ..." class="form-control bg-secondary" value="{{ request()->input('search') }}">
                            <button type="submit" class="btn " style="background-color: #3798A6"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color: #3798A6; color:white"> # </th>
                                    <th style="background-color: #3798A6; color:white"> Title </th>
                                    <th style="background-color: #3798A6; color:white"> Type </th>
                                    <th style="background-color: #3798A6; color:white"> Actions </th>
                                    <th style="background-color: #3798A6; color:white"> Created at </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->title }}</td>
                                        <td>
                                            {{ $d->type }}
                                        </td>
                                        <td>
                                            <a href="{{ route('news#detailPage', $d->id) }}" class="btn  "
                                                style="background-color: #3798A6 !important"><i
                                                    class="fa-solid fa-eye text-white"></i>Details</a>
                                            <a href="{{ route('news#deletePage', $d->id) }}" class="btn btn-danger "><i
                                                    class="fa-solid fa-circle-info text-white"></i>Delete</a>
                                        </td>
                                        <td> {{ $d->updated_at }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $data->appends(request()->input())->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
