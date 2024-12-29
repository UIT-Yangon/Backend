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
                        <h4 class="card-title">Organization Collaboration</h4>

                        <div class="d-flex justify-content-between">

                          <a href="{{route('org#create')}}" class="btn" style="background-color: #3798A6; padding-top:10px">+ Add</a>

                        <div >
                          <form method="GET" class="d-flex" action="{{ route('org#list') }}">

                            
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color: #3798A6; color:white"> # </th>
                                    <th style="background-color: #3798A6; color:white"> Organization </th>
                                    <th style="background-color: #3798A6; color:white"> Country </th>
                                    <th style="background-color: #3798A6; color:white"> Link </th>
                                    <th style="background-color: #3798A6;color:white">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organization as $org)
                                    <tr>
                                        <td>{{ $org->id }}</td>
                                        <td>{{ $org->name }}</td>
                                        <td>{{ $org->country}}</td>
                                        <td>
                                        @if($org->link)
                                            <a href="{{ $org->link }}" target="_blank">{{ $org->link }}</a>
                                        @else
                                            N/A
                                        @endif
                                        </td>
                                        
                                        <td>
                                            <div>
                                            <a href="{{ route('org#delete', $org->id) }}" class="btn btn-danger">
                                            <i class="fa-solid fa-circle-info text-white"></i> Delete
                                            </a>
                                            </div>
                                            <div>
                                            <a href="{{ route('org#edit', $org->id) }}" class="btn btn-info mt-2"><i class="mdi mdi-credit-card"></i>Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $organization->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
