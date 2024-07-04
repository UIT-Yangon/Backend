@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card bg-white" style="border: 1px solid #3798A6; border-radius:20px">
                    <div class="card-header" style="border-radius:20px"">
                        <h2 class="text-center mt-2 " style="color: #3798A6">Add Conference</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('conf#updateInfo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="form-label text-dark">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} bg-white text-dark" value="{{$conference[0]->name}}" name="name" style="border:1px solid #3798A6" >
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            
                            <div class="mt-2 d-flex">
                               
                                <div class="w-100 px-2">
                                    <label for="" class="form-label text-dark">Accept Notification</label>
                                <input type="date" class="form-control {{ $errors->has('accept_noti') ? 'is-invalid' : '' }} bg-white text-dark" value="{{$conference[0]->accept_noti}}" name="accept_noti" style="border:1px solid #3798A6" >
                                @error('accept_noti')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                            </div>

                            
                             <div class="mt-2 d-flex justify-content-between">
                                <div class="w-80">
                                    <label for="" class="form-label text-dark">Status</label>
                                <select name="status" id=""  class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }} bg-white text-dark" value="{{$conference[0]->status}}" style="border:1px solid #3798A6">
                                    <option value="open">open</option>
                                    <option value="closed">Closed</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-3">
                                    <label for="" class="form-label text-dark">Conference date</label>
                                <input type="date" class="form-control {{ $errors->has('conference_date') ? 'is-invalid' : '' }} bg-white text-dark" name="conference_date" value="{{$conference[0]->conference_date}}" style="border:1px solid #3798A6" >
                                @error('conference_date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Email</label>
                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} bg-white text-dark" name="email" value="{{$conference[0]->email}}" style="border:1px solid #3798A6" >
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                           
                            
                           
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="w-100 px-2 text-dark">
                                    <label for="" class="form-label text-dark">Foreign Fee</label>
                                    <input type="number" class="form-control {{ $errors->has('foreign_fee') ? 'is-invalid' : '' }} bg-white text-dark" value="{{$conference[0]->foreign_fee}}" name="foreign_fee" style="border:1px solid #3798A6" >

                                @error('foreign_fee')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-2">
                                    <label for="" class="form-label text-dark">Local Fee</label>
                                    <input type="number" class="form-control {{ $errors->has('local_fee') ? 'is-invalid' : '' }} bg-white text-dark" value="{{$conference[0]->local_fee}}" name="local_fee" style="border:1px solid #3798A6" >

                                @error('local_fee')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                        
                            
                            <div class="mt-2">
                                <button class="btn" style="background-color: #3798A6">Add</button>
                                <a href="#" class="btn" style="background-color: #3798A6">Back</a>
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection