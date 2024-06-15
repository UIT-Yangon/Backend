@extends('welcome')

@section('content')

            <div class="text-dark">
                <h2 class='mb-3'>Title</h2>
                <h4 class='mb-3'>Category</h4>
                <div class="d-flex justify-content-between mb-3">
                    <div>John Doe</div>
                    <div class="bg-dark text-white p-1 rounded-3">12 Jan 2024</div>
                </div>
                <hr>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam nisi ipsa error architecto distinctio ex vel nostrum quam velit volupta
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam nisi ipsa error architecto distinctio ex vel nostrum quam velit voluptate debitis quas, cum, dolore exercitationem eius consequuntur molestiae omnis doloremque
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam nisi ipsa error architecto distinctio ex vel nostrum quam velit voluptate debitis quas, cum, dolore exercitationem eius consequuntur molestiae omnis doloremque
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam nisi ipsa error architecto distinctio ex vel nostrum quam velit voluptate debitis quas, cum, dolore exercitationem eius consequuntur molestiae omnis doloremquete debitis quas, cum, dolore exercitationem eius consequuntur molestiae omnis doloremque.</p>
            
                <div class="d-flex flex-wrap">
                    <div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="https://e3.365dm.com/24/06/768x432/skynews-vladimir-putin-russia_6581336.jpg?20240614112324"
                         class="w-100 h-100" alt="">
                    </div>
                    <div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="https://e3.365dm.com/24/06/768x432/skynews-vladimir-putin-russia_6581336.jpg?20240614112324"
                         class="w-100 h-100" alt="">
                    </div>
                    <div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="https://e3.365dm.com/24/06/768x432/skynews-vladimir-putin-russia_6581336.jpg?20240614112324"
                         class="w-100 h-100" alt="">
                    </div><div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="https://e3.365dm.com/24/06/768x432/skynews-vladimir-putin-russia_6581336.jpg?20240614112324"
                         class="w-100 h-100" alt="">
                    </div><div class="w-50 bg-danger border-white " style="height:300px;border:3px solid white">
                        <img src="https://e3.365dm.com/24/06/768x432/skynews-vladimir-putin-russia_6581336.jpg?20240614112324"
                         class="w-100 h-100" alt="">
                    </div>
                </div>

                <a href="{{route('news#editPage',3)}}" class="btn btn-dark p-3 mt-3">Edit News</a>
            </div>
@endsection