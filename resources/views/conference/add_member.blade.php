@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <div class="card bg-white">
                    <div class="card-header  text-center" style="color: #3798A6">
                    <h3 class="mt-2 ">Add Member</h3>
                    <p class="text-dark">{{$confName}}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('conf#addMember',$id)}}" method="POST" enctype="multipart/form-data">
                            @csrf   
                            <div>
                                <img id="imagePreview" src="#" alt="Selected Image" style="  max-width: 100%; height: auto; margin-top: 20px;">
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
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} bg-white text-dark" name="name" style="border:1px solid #3798A6" >
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label text-dark">Rank</label>
                                <select name="rank" id=""  class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }} bg-white text-dark" style="border:1px solid #3798A6">
                                    <option value="Daw" >none</option>
                                    <option value="Prof"  >Professor</option>
                                    <option value="Assoc. Prof" >Associate Professor</option>
                                    <option value="Dr" >Doctor</option>
                                </select>
                                @error('rank')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
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
    </div>
@endsection