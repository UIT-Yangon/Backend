@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <button onclick="window.history.go(-2)" class="btn " style="background-color: #3798A6">Back</button>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <h3 class="text-center text-dark">Edit Committee member</h3>
                <div class="card bg-white p-3" style="border: 2px solid #3798A6">
                    <form action="{{route('conf#editMember',$member->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <img id="imagePreview" src="{{asset('storage/conference_images/' . $member->image)}}" alt="Selected Image" style=" @if(!$member->image) display: none; @endif max-width: 100%; height: auto; margin-top: 20px;">
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">Image</label>
                            <input type="file" name="image" class="form-control" style="background-color: #3798A6; border: 0px" id="imageInput">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} bg-white text-dark" name="name" style="border:2px solid #3798A6" value="{{ $member->name }}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label text-dark">Rank</label>
                            <select name="rank" id=""  class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }} bg-white text-dark" style="border:2px solid #3798A6">
                                <option value="Daw" >none</option>
                                <option value="Prof" @if($member->rank === 'Prof') selected @endif >Professor</option>
                                <option value="Assoc. Prof" @if($member->rank === 'Assoc. Prof') selected @endif>Associate Professor</option>
                                <option value="Dr" @if($member->rank === 'Dr') selected @endif>Doctor</option>
                            </select>
                            @error('rank')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label text-dark">Postion</label>
                            <input type="text" class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }} bg-white text-dark" name="position" style="border:2px solid #3798A6" value="{{ $member->position }}">
                            @error('position')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label text-dark">University</label>
                            <input type="text" class="form-control {{ $errors->has('university') ? 'is-invalid' : '' }} bg-white text-dark" name="university" style="border:2px solid #3798A6" value="{{ $member->university }}">
                            @error('university')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label text-dark">Nation</label>
                            <input type="text" class="form-control {{ $errors->has('nation') ? 'is-invalid' : '' }} bg-white text-dark" name="nation" style="border:2px solid #3798A6" value="{{ $member->nation }}">
                            @error('nation')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="mt-2">
                            <button class="btn" style="background-color: #3798A6">Update</button>
                            <a href="#" class="btn" style="background-color: #3798A6">Back</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection