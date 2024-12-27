@extends('welcome')

@section('content')
<style>
  .ck-editor__editable_inline:not(.ck-comment__input *) {
    height: 500px;
    overflow-y: auto;
  }
</style>
<div class="container w-50 flex justify-content-center align-items-center" style="border:1px solid black;border-radius:5px">
    <div class="text-black">
        <div class="card-body">
            <h4 class="card-tilte">Edit University Collaboration</h4>
            <form class="forms-sample" method="post" action="{{ route('uni#update', $university->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputName1" class="text-black">University Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control  bg-white" id="exampleInputName1" placeholder="Name"
                name="name" value="{{ old('name', $university->name) }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputName2" class="text-black">Country<span class="text-danger">*</span></label>
                <input type="text" class="form-control  bg-white" id="exampleInputName2" placeholder="Name"
                name="country" value="{{ old('country', $university->country) }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                    @error('country')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputName2" class="text-black">Link <span class="text-danger">*</span></label>
                <input type="url" class="form-control  bg-white" id="exampleInputName2" placeholder="https://example.com"
                name="link" value="{{ old('link', $university->link) }}" style="color:black !important; border:1px solid #3798A6 !important; ">
                    @error('link')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>

            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <button class="btn btn-dark" type="reset">Cancel</button>
            </form>
        </div>
    </div>
</div>
<script>
  ClassicEditor.create(document.querySelector('#question'))
    .catch(error => {
      console.error(error);
    });
  ClassicEditor.create(document.querySelector('#answer'))
    .catch(error => {
      console.error(error);
    });
</script>
@endsection