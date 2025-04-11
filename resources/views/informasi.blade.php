@extends('layouts.front')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Blog</h1>
                    <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                        vulputate velit imperdiet dolor tempor tristique.</p>
                    <p><a href="" class="btn btn-secondary me-2">Shop Now</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap text-lg-end">
                    <img src="{{ asset('front/assets/images/dog.png') }}"
                        style="max-height: 500px; margin-left: 170px; margin-top: -150px" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">

        <div class="row">

            <div class="row">
                @foreach($informasi as $item)
                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img
                                src="{{asset('images/informasi/'.$item->image_informasi)}}" alt="Image"
                                class="img-fluid" style="height: 200px; width: 350px;"></a>
                        <div class="post-content-entry">
                            <h4 style="color: black"><b>{{$item->name_informasi}}</b></h4>
                            <h6>{{$item->desc_informasi}}</h6>
                            <div class="meta">
                                <span>by <a href="#">Admin</a></span> <span>on <a
                                        href="#">{{$item->tgl_informasi}}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- End Blog Section -->




@endsection