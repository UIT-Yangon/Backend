@extends('welcome')

@section('content')
<div class="">
                <div class="text-black">
                  <div class="card-body">
                    <h4 class="card-title">Add News</h4>
                    <form class="forms-sample" method="POST" action="{{route('news#store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control bg-white" id="exampleInputName1" placeholder="Name" name="title">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Type</label>
                        <select class="form-control border bg-white" id="exampleSelectGender" name="type">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" id="images" class="form-control bg-white" name="images[]"  multiple>

                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Body</label>
                        <textarea class="form-control bg-white" id="exampleTextarea1" rows="4" name="body"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
           
@endsection