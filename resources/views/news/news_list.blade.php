@extends('welcome')

@section('content')
<div class="text-black">
<div class="col-lg-12 grid-margin">
                <div class="">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title">Manage News</h4>
                    <div class="d-flex">
                        <input type="text" placeholder="Search news ..." class="form-control bg-secondary">
                        <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Type </th>
                            <th> Actions </th>
                            <th> Created at </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td>
                              Test Type
                            </td>
                            <td> 
                                <a href="{{route('news#detailPage',2)}}" class="btn btn-dark "><i class="fa-solid fa-eye text-white"></i>Details</a>
                                <a href="" class="btn btn-danger "><i class="fa-solid fa-circle-info text-white"></i>Delete</a>
                            </td>
                            <td> May 15, 2015 </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endsection