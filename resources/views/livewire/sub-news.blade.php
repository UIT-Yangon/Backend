<div class="container my-3">
    <div class="row">
        @foreach ($subNews as $subNew)
            <div class="col-12 mb-2">
                <div class="card bg-white p-2" style="border: 5px double #3798A6 !important; border-radius:20px">
                   
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                            <h4>{{$subNew->sub_title}}</h4>
                            <div>
                                <button wire:click='delete({{$subNew->id}})' class="btn  text-center ps-1"><h2><i class="fa-solid fa-delete-left text-danger "></i></h2></button>
                            </div>
                        </div>

                            &nbsp; &nbsp;{!! $subNew->sub_body !!}
                        </div>
                        
                    </div>
                    
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-10 offset-1   p-5" style="border: 5px double #3798A6 !important; border-radius:20px">
            <h3>{{$title}}</h3>
            <form wire:submit='save' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Sub Title</label>
                    <input type="text" class="form-control bg-white" id="exampleInputName1"
                        placeholder="Name" name="title" wire:model.live="title">
                </div>
                <div class="form-group">
                    <label>Image For Sub-News</label>
                    <input type="file" id="images" class="form-control bg-white"
                        name="images[]" multiple>
                </div>
                <div class="form-group" wire:ignore>
                    
                    <label for="exampleTextarea1">Sub-News Body <span
                            class="text-danger">*</span></label>
                    <textarea id="sub_body" class="form-control bg-white" id="exampleTextarea1" rows="4" name="body" wire:model.defer="sub_body"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <button class="btn btn-dark">Cancel</button>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#sub_body'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('sub_body', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    
</div>