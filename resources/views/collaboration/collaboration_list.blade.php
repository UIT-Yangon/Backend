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
                        <h4 class="card-title">Collaboration</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><h4>University Collaboration</h4></td>
                                    <td><a href="{{ route('uni#list') }}" class="btn btn-success">
                                    <i class="mdi mdi-playlist-check"></i> List
                                    </a></td> 
                                </tr>
                                <tr>
                                    <td><h4>Industry Collaboration</h4></td>
                                    <td><a href="{{ route('ind#list') }}" class="btn btn-success">
                                    <i class="mdi mdi-playlist-check"></i> List
                                    </a></td> 
                                </tr>
                                <tr>
                                    <td><h4>Collaboration with Organizations</h4></td>
                                    <td><a href="{{ route('org#list') }}" class="btn btn-success">
                                    <i class="mdi mdi-playlist-check"></i> List
                                    </a></td> 
                                </tr>
                            </tbody>
                        </table>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
