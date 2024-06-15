@extends('welcome')

@section('content')
<div class="">
                <div class="text-black">
                  <div class="card-body">
                    <h4 class="card-title">Edit News</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control bg-white" id="exampleInputName1" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Type</label>
                        <select class="form-control border bg-white" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="" class="form-control bg-white" id="">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Body</label>
                        <textarea class="form-control bg-white" id="exampleTextarea1" rows="4"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
           
@endsection