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
      <h4 class="card-title">Edit FAQ</h4>
      <form class="forms-sample" method="post" action="{{ route('faq#update', $faq->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleTextarea1" class="text-black">Question <span class="text-danger">*</span></label>
                <textarea class="form-control bg-white" id="exampleTextarea1" rows="6" cols="20" placeholder=""
                name="question" style="color:black !important; border:1px solid #3798A6 !important;">{{ old('question', $faq->question) }}</textarea>
                @error('question')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>

        <div class="form-group">
            <label for="exampleTextarea11" class="text-black">Answer <span class="text-danger">*</span></label>
                <textarea class="form-control bg-white" id="exampleTextarea11" rows="10" cols="20" placeholder=""
                name="answer" style="color:black !important; border:1px solid #3798A6 !important;">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <small class="text-danger">{{ $message }}</small>
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
