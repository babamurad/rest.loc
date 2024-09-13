<section class="fp__banner" style="background: url({{ asset('assets/images/banner_bg.jpg') }});">
    <div class="fp__banner_overlay">
        <div class="row banner_slider">
            @foreach($sliders as $slider)
                <div class="col-12">
                    <div class="fp__banner_slider">
                        <div class=" container">
                            <div class="row">
                                <div class="col-xl-5 col-md-5 col-lg-5">
                                    <div class="fp__banner_img wow fadeInLeft" data-wow-duration="1s">
                                        <div class="img">
                                            <img src="{{ asset($slider->image) }}" alt="food item" class="img-fluid w-100">
                                            <span> {{ $slider->offer }} off </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-7 col-lg-6">
                                    <div class="fp__banner_text wow fadeInRight" data-wow-duration="1s">
                                        <h1>{{ $slider->title }}</h1>
                                        <h3>{{ $slider->subtitle }}</h3>
                                        <p>{{ $slider->description }}</p>
                                        <ul class="d-flex flex-wrap">
                                            <li><a class="common_btn" href="{{ $slider->button_link }}">shop now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
