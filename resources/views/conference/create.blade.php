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
                        <form action="{{route('conf#create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="form-label text-dark">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} bg-white text-dark" name="name" style="border:1px solid #3798A6" >
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Call for paper</label>
                                <textarea cols="10" rows="10"  class="form-control {{ $errors->has('paperCall') ? 'is-invalid' : '' }} bg-white text-dark" name="paperCall" style="border:1px solid #3798A6" >
                                </textarea>
                                @error('paperCall')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2 d-flex">
                                <div class="w-100 px-2">
                                    <label for="" class="form-label text-dark">Deadline</label>
                                <input type="date" class="form-control {{ $errors->has('original_deadline') ? 'is-invalid' : '' }} bg-white text-dark" name="original_deadline" style="border:1px solid #3798A6" >
                                @error('original_deadline')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="w-100 px-2">
                                    <label for="" class="form-label text-dark">Accept Notification</label>
                                <input type="date" class="form-control {{ $errors->has('accept_noti') ? 'is-invalid' : '' }} bg-white text-dark" name="accept_noti" style="border:1px solid #3798A6" >
                                @error('accept_noti')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                            </div>

                            
                             <div class="mt-2 d-flex justify-content-between">
                                <div class="w-80">
                                    <label for="" class="form-label text-dark">Status</label>
                                <select name="status" id=""  class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }} bg-white text-dark" style="border:1px solid #3798A6">
                                    <option value="open">open</option>
                                    <option value="closed">Closed</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-3">
                                    <label for="" class="form-label text-dark">Conference date</label>
                                <input type="date" class="form-control {{ $errors->has('conference_date') ? 'is-invalid' : '' }} bg-white text-dark" name="conference_date" style="border:1px solid #3798A6" >
                                @error('conference_date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Email</label>
                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} bg-white text-dark" name="email" style="border:1px solid #3798A6" >
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="w-100 px-2">
                                    <label for="" class="form-label text-dark">Book</label>
                                    <input type="file" class="form-control {{ $errors->has('book') ? 'is-invalid' : '' }} bg-white text-dark" name="book" style="border:1px solid #3798A6" >

                                @error('book')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-2">
                                    <label for="" class="form-label text-dark">Brochure</label>
                                    <input type="file" class="form-control {{ $errors->has('brochure') ? 'is-invalid' : '' }} bg-white text-dark" name="brochure" style="border:1px solid #3798A6" >

                                @error('brochure')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                            
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="w-100 px-2 text-dark">
                                    <label for="" class="form-label text-dark">Paper Format</label>
                                    <input type="file" class="form-control {{ $errors->has('paper_format') ? 'is-invalid' : '' }} bg-white text-dark" name="paper_format" style="border:1px solid #3798A6" >

                                @error('paper_format')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-2">
                                    <label for="" class="form-label text-dark">Camera Ready</label>
                                    <input type="date" class="form-control {{ $errors->has('camera_ready') ? 'is-invalid' : '' }} bg-white text-dark" name="camera_ready" style="border:1px solid #3798A6" >

                                @error('camera_ready')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="w-100 px-2 text-dark">
                                    <label for="" class="form-label text-dark">Foreign Fee</label>
                                    <input type="number" class="form-control {{ $errors->has('foreign_fee') ? 'is-invalid' : '' }} bg-white text-dark" name="foreign_fee" style="border:1px solid #3798A6" >

                                @error('foreign_fee')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="text-dark w-100 px-2">
                                    <label for="" class="form-label text-dark">Local Fee</label>
                                    <input type="number" class="form-control {{ $errors->has('local_fee') ? 'is-invalid' : '' }} bg-white text-dark" name="local_fee" style="border:1px solid #3798A6" >

                                @error('local_fee')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                
                            </div>
                            {{--
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Postion</label>
                                <input type="text" class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }} bg-white text-dark" name="position" style="border:1px solid #3798A6" >
                                @error('position')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">University</label>
                                <input type="text" class="form-control {{ $errors->has('university') ? 'is-invalid' : '' }} bg-white text-dark" name="university" style="border:1px solid #3798A6" >
                                @error('university')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Nation</label>
                                <input type="text" class="form-control {{ $errors->has('nation') ? 'is-invalid' : '' }} bg-white text-dark" name="nation" style="border:1px solid #3798A6" >
                                @error('nation')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Speaker Type</label>
                                <select name="speaker_type" id=""  class="form-control {{ $errors->has('speaker_type') ? 'is-invalid' : '' }} bg-white text-dark" style="border:1px solid #3798A6">
                                    <option value="none" >none</option>
                                    <option value="keynote"  >Keynote</option>
                                    <option value="invited" >Invited</option>
                                </select>
                                @error('speaker_type')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Member Type</label>
                                <select name="member_type" id=""  class="form-control {{ $errors->has('member_type') ? 'is-invalid' : '' }} bg-white text-dark" style="border:1px solid #3798A6">
                                    <option value="none" >none</option>
                                    <option value="organizing"  >Organizing</option>
                                    <option value="committee" >Committee</option>
                                </select>
                                @error('member_type')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Chair Type</label>
                                <select name="chair_type" id=""  class="form-control {{ $errors->has('chair_type') ? 'is-invalid' : '' }} bg-white text-dark" style="border:1px solid #3798A6">
                                    <option value="none" >none</option>
                                    <option value="general chair"  >General Chair</option>
                                    <option value="general co-chair" >General Co-Chairr</option>
                                    <option value="program chair" >Program Chair</option>
                                </select>
                                @error('chair_type')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div> --}}
                            
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