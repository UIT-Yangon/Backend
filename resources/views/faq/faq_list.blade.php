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
                        <h4 class="card-title">Manage FAQs</h4>

                        <div class="d-flex justify-content-between">

                          <a href="{{route('faq#create')}}" class="btn" style="background-color: #3798A6; padding-top:10px">+ Add</a>

                        <div >
                          <form method="GET" class="d-flex" action="{{ route('faq#list') }}">

                            
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color: #3798A6; color:white"> # </th>
                                    <th style="background-color: #3798A6; color:white"> Question </th>
                                    <th style="background-color: #3798A6; color:white"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faq as $f)
                                    <tr>
                                        <td>{{ $f->id }}</td>
                                        <td>{{ $f->question }}</td>
                                        <td>
                                            <div>
                                            <a href="{{ route('faq#detail', $f->id) }}" class="btn  "
                                                style="background-color: #3798A6 !important"><i
                                                    class="fa-solid fa-eye text-white"></i>Details</a>
                                            <a href="{{ route('faq#delete', $f->id) }}" class="btn btn-danger "><i
                                                    class="fa-solid fa-circle-info text-white"></i>Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $faq->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
